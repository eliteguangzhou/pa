<?php
/*
 $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

 osCommerce, Open Source E-Commerce Solutions
 http://www.oscommerce.com

 Copyright (c) 2003 osCommerce

 Released under the GNU General Public License
 */

class shoppingCart {
	var $contents, $total, $weight, $cartID, $content_type;

	function shoppingCart() {
		$this->reset();
	}

	function restore_contents() {
		global $customer_id;

		if (!tep_session_is_registered('customer_id')) return false;

		// insert current cart contents in database
		if (is_array($this->contents)) {
			reset($this->contents);
			while (list($products_id, ) = each($this->contents)) {
				$qty = $this->contents[$products_id]['qty'];
				$product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
				if (!tep_db_num_rows($product_query)) {
					tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . tep_db_input($qty) . "', '" . date('Ymd') . "')");
					if (isset($this->contents[$products_id]['attributes'])) {
						reset($this->contents[$products_id]['attributes']);
						while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
							tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
						}
					}
				} else {
					tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . tep_db_input($qty) . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
				}
			}
		}

		// reset per-session cart contents, but not the database contents
		$this->reset(false);

		$products_query = tep_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
		while ($products = tep_db_fetch_array($products_query)) {
			$this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
			// attributes
			$attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products['products_id']) . "'");
			while ($attributes = tep_db_fetch_array($attributes_query)) {
				$this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
			}
		}

		$this->cleanup();
	}

	function reset($reset_database = false) {
		global $customer_id;

		$this->contents = array();
		$this->total = 0;
		$this->weight = 0;
		$this->content_type = false;

		if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
			tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
			tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
		}

		unset($this->cartID);
		if (tep_session_is_registered('cartID')) tep_session_unregister('cartID');
	}

	function add_cart($products_id, $qty = '1', $attributes = '', $notify = true, $gift = false) {
		global $new_products_id_in_cart, $customer_id, $easy_discount, $is_member;
		/*
		 if ($this->has_card())
		 return PRODUCTS_NOT_TOGETHER1;*/
		$max = MAX_DAILY_LIMIT_NOT_MEMBER;//$is_member || $this->has_card() ? MAX_DAILY_LIMIT : MAX_DAILY_LIMIT_NOT_MEMBER;
		if (
		(
		$max > 0 &&
		(
		isset($this->contents[$products_id]['qty']) &&
		$this->contents[$products_id]['qty'] < $qty
		|| !isset($this->contents[$products_id])
		) &&
		$this->count_contents(false) >= $max
		) && !$gift){
			return;
		}

		$products_id_string = tep_get_uprid($products_id, $attributes);
		$products_id = tep_get_prid($products_id_string);
		$products_id_string = ($gift ? 'gift_'.$gift.'_' : '').$products_id_string;

		if ($max > 0 && (int)$qty > $max) {
			$qty = $max;
		}

		$attributes_pass_check = true;

		if (is_array($attributes)) {
			reset($attributes);
			while (list($option, $value) = each($attributes)) {
				if (!is_numeric($option) || !is_numeric($value)) {
					$attributes_pass_check = false;
					break;
				}
			}
		}
		if (is_numeric($products_id) && is_numeric($qty) && ($attributes_pass_check == true)) {
			$check_product_query = tep_db_query("select products_status, products_price, buy_price from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
			$check_product = tep_db_fetch_array($check_product_query);
			$check_product['products_price'] = $is_member || $this->has_card() ? get_price($check_product['products_price']) : get_reduced_price($check_product['buy_price']);

			if (($check_product !== false) && ($check_product['products_status'] == '1')) {
				if ($notify == true) {
					$new_products_id_in_cart = $products_id;
					tep_session_register('new_products_id_in_cart');
				}

				if ($this->in_cart($products_id_string)) {
					$this->update_quantity($products_id_string, $qty, $attributes);
				} else {
					$this->contents[$products_id_string] = array('buy_price' => $check_product['buy_price'], 'qty' => (int)$qty, 'price' => $check_product['products_price']);
					// insert into database
					if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$qty . "', '" . date('Ymd') . "')");

					if (is_array($attributes)) {
						reset($attributes);
						while (list($option, $value) = each($attributes)) {
							$this->contents[$products_id_string]['attributes'][$option] = $value;
							// insert into database
							if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$option . "', '" . (int)$value . "')");
						}
					}
				}
				$this->cleanup();

				// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
				$this->cartID = $this->generate_cart_id();
			}
			$this->gift();
			$easy_discount->recalculate();
		}
	}

	function update_quantity($products_id, $quantity = '', $attributes = '') {
		global $customer_id, $easy_discount, $is_member;

		$products_id_string = tep_get_uprid($products_id, $attributes);
		$products_id = tep_get_prid($products_id_string);

		$max = MAX_DAILY_LIMIT_NOT_MEMBER;//$is_member || $this->has_card() ? MAX_DAILY_LIMIT : MAX_DAILY_LIMIT_NOT_MEMBER;
		if (
		$max > 0 &&
		(
		isset($this->contents[$products_id]['qty']) &&
		$this->contents[$products_id]['qty'] < $quantity
		|| !isset($this->contents[$products_id])
		) &&
		$this->count_contents(false) >= $max
		) {
			return;
		}

		$attributes_pass_check = true;

		if (is_array($attributes)) {
			reset($attributes);
			while (list($option, $value) = each($attributes)) {
				if (!is_numeric($option) || !is_numeric($value)) {
					$attributes_pass_check = false;
					break;
				}
			}
		}
		 
		if (is_numeric($products_id) && isset($this->contents[$products_id_string]) && is_numeric($quantity) && ($attributes_pass_check == true)) {
			$this->contents[$products_id_string]['qty'] = (int)$quantity;
			// update database
			if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . (int)$quantity . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "'");

			if (is_array($attributes)) {
				reset($attributes);
				while (list($option, $value) = each($attributes)) {
					$this->contents[$products_id_string]['attributes'][$option] = $value;
					// update database
					if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "' and products_options_id = '" . (int)$option . "'");
				}
			}
			$this->gift();
			$easy_discount->recalculate();
		}
	}

	function cleanup() {
		global $customer_id;

		reset($this->contents);
		while (list($key,) = each($this->contents)) {
			if ($this->contents[$key]['qty'] < 1) {
				unset($this->contents[$key]);
				// remove from database
				if (tep_session_is_registered('customer_id')) {
					tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
					tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
				}
			}
		}
	}

	function count_contents($include_gifts = true) {  // get total number of items in cart
		$total_items = 0;
		if (is_array($this->contents)) {
			reset($this->contents);
			while (list($products_id, ) = each($this->contents)) {
				if ($include_gifts || !$include_gifts && !(strpos($products_id, 'gift_') !== false) && !(strpos($products_id, 'card') !== false))
				$total_items += $this->get_quantity($products_id);
			}
		}

		return $total_items;
	}

	function get_quantity($products_id) {
		if (isset($this->contents[$products_id])) {
			return $this->contents[$products_id]['qty'];
		} else {
			return 0;
		}
	}

	function in_cart($products_id) {
		if (isset($this->contents[$products_id])) {
			return true;
		} else {
			return false;
		}
	}

	function remove($products_id, $check_gift = true) {
		global $customer_id, $easy_discount;

		unset($this->contents[$products_id]);
		// remove from database
		if (tep_session_is_registered('customer_id')) {
			tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
			tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
		}

		// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
		$this->cartID = $this->generate_cart_id();
		if ($check_gift)
		$this->gift();
		$easy_discount->recalculate();
	}

	function remove_all() {
		$this->reset();
	}

	function get_product_id_list() {
		$product_id_list = '';
		if (is_array($this->contents)) {
			reset($this->contents);
			while (list($products_id, ) = each($this->contents)) {
				$product_id_list .= ', ' . $products_id;
			}
		}

		return substr($product_id_list, 2);
	}

	function calculate($special_discount = true) {
		global $currencies, $is_member, $cards;

		$this->total = 0;
		$this->weight = 0;
		if (!is_array($this->contents)) return 0;

		$timer = 1;
		if ($special_discount)
		if (is_promo_date())
		$timer *= get_promo();

		reset($this->contents);
		while (list($products_id, ) = each($this->contents)) {
			if (!$this->is_card($products_id)) {
				$is_gift = false;
				$products_id_int = $products_id;
				if (strpos($products_id, 'gift_') !== false) {
					$is_gift = true;
					$products_id_int = substr($products_id, strrpos('gift_', $products_id) + 1);
				}
				$qty = $this->contents[$products_id]['qty'];

				// products price
				$product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight, buy_price, products_id as temp from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id_int . "'");
				if ($product = tep_db_fetch_array($product_query)) {
					$prid = $product['products_id'];
					$products_tax = tep_get_tax_rate($product['products_tax_class_id']);
					$products_price = ($is_gift ? 0 : ($is_member || $this->has_card() ? get_price($product['products_price']) : get_reduced_price($product['buy_price']))) * $timer;
					$products_weight = $product['products_weight'];

					/*$specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
					 if (tep_db_num_rows ($specials_query)) {
					 $specials = tep_db_fetch_array($specials_query);
					 $products_price = get_price($specials['specials_new_products_price']);
					 }*/

					$this->total += $currencies->calculate_price($products_price, $products_tax, $qty);
					$this->weight += ($qty * $products_weight);
				}

				// attributes price
				if (isset($this->contents[$products_id]['attributes'])) {
					reset($this->contents[$products_id]['attributes']);
					while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
						$attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
						$attribute_price = tep_db_fetch_array($attribute_price_query);
						if ($attribute_price['price_prefix'] == '+') {
							$this->total += $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
						} else {
							$this->total -= $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
						}
					}
				}
			}
			else {
				$qty = $this->contents[$products_id]['qty'];
				$this->total += $currencies->calculate_price($cards->list[$products_id]['price'], 0, $qty);
			}
		}
	}

	function attributes_price($products_id) {
		$attributes_price = 0;

		if (isset($this->contents[$products_id]['attributes'])) {
			reset($this->contents[$products_id]['attributes']);
			while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
				$attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
				$attribute_price = tep_db_fetch_array($attribute_price_query);
				if ($attribute_price['price_prefix'] == '+') {
					$attributes_price += $attribute_price['options_values_price'];
				} else {
					$attributes_price -= $attribute_price['options_values_price'];
				}
			}
		}

		return $attributes_price;
	}

	function get_products() {
		global $languages_id, $is_member, $cards;

		if (!is_array($this->contents)) return false;

		$products_array = array();
		reset($this->contents);
		while (list($products_id, ) = each($this->contents)) {
			if (!$this->is_card($products_id)) {
				$is_gift = false;
				$products_id_int = $products_id;
				if (strpos($products_id, 'gift_') !== false) {
					$is_gift = true;
					$products_id_int = substr($products_id, strrpos($products_id, '_') + 1);
				}

				$products_query = tep_db_query("select p.products_id, pd.products_description, pd.products_name, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_tax_class_id, p.buy_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$products_id_int . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
				if ($products = tep_db_fetch_array($products_query)) {
					$prid = $products['products_id'];
					$products_price = $is_gift ? 0 : ($is_member || $this->has_card() ? get_price($products['products_price']) : get_reduced_price($products['buy_price']));

					/*if (!$is_gift) {
					 $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
					 if (tep_db_num_rows($specials_query)) {
					 $specials = tep_db_fetch_array($specials_query);
					 $products_price = get_price($specials['specials_new_products_price']);
					 }
					 }*/

					$products_array[] = array('id' => $products_id_int,
                                        'gift' => $is_gift,
                                        'name' => $products['products_name'],
                                        'products_description' => $products['products_description'],
                                        'model' => $products['products_model'],
                                        'image' => $products['products_image'],
                                        'price' => $products_price,
                                        'quantity' => $this->contents[$products_id]['qty'],
                                        'weight' => $products['products_weight'],
                                        'final_price' => ($products_price + $this->attributes_price($products_id)),
                                        'tax_class_id' => $products['products_tax_class_id'],
                                        'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''),
                                        'buy_price' => $this->contents[$products_id]['buy_price']);
				}
			}
			else {
				$products = $cards->list[$products_id];
				$products_id_upper = strtoupper($products_id);
				$products_array[] = array('id' => $products_id,
									'name' => constant('CARD_NAME_'.$products_id_upper),
									'products_description' => constant('CARD_DESC_'.$products_id_upper),
									'model' => $products_id,
									'image' => $products_id.'.gif',
									'price' => $products['price'],
									'quantity' => 1,
									'weight' => 0,
									'final_price' => $products['price'],
									'tax_class_id' => 0,
									'attributes' => '',
									'buy_price' => 0,
									'duration' => $products['duration']);
			}
		}

		return $products_array;
	}

	function show_total($special_price = true) {
		$this->calculate($special_price);

		return $this->total;
	}

	function show_weight() {
		$this->calculate();

		return $this->weight;
	}

	function generate_cart_id($length = 5) {
		return tep_create_random_value($length, 'digits');
	}

	function get_content_type() {
		$this->content_type = false;

		if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
			reset($this->contents);
			while (list($products_id, ) = each($this->contents)) {
				$is_gift = false;
				$products_id_int = $products_id;
				if (strpos($products_id, 'gift_') !== false) {
					$is_gift = true;
					$products_id_int = substr($products_id, strrpos($products_id, '_') + 1);
				}
				if (isset($this->contents[$products_id]['attributes'])) {
					reset($this->contents[$products_id]['attributes']);
					while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
						$virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id_int . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
						$virtual_check = tep_db_fetch_array($virtual_check_query);

						if ($virtual_check['total'] > 0) {
							switch ($this->content_type) {
								case 'physical':
									$this->content_type = 'mixed';

									return $this->content_type;
									break;
								default:
									$this->content_type = 'virtual';
									break;
							}
						} else {
							switch ($this->content_type) {
								case 'virtual':
									$this->content_type = 'mixed';

									return $this->content_type;
									break;
								default:
									$this->content_type = 'physical';
									break;
							}
						}
					}
				} else {
					switch ($this->content_type) {
						case 'virtual':
							$this->content_type = 'mixed';

							return $this->content_type;
							break;
						default:
							$this->content_type = 'physical';
							break;
					}
				}
			}
		} else {
			$this->content_type = 'physical';
		}

		return $this->content_type;
	}

	function unserialize($broken) {
		for(reset($broken);$kv=each($broken);) {
			$key=$kv['key'];
			if (gettype($this->$key)!="user function")
			$this->$key=$kv['value'];
		}
	}

	function gift() {
		if (ENABLE_GIFT) {

			$total = 0;
			$packs = array();
			$check_min2 = array();
			$check_min3 = array();
			$reduc_packs = array();
			$already_gift = array();
			$pack_indexes = array();
			$all_gift = array();
			$gift_nb = 0;
			//On compte le total de produit dans le panier qui ne sont pas des produits
			//On verifie aussi si il y a un cadeau pack, non cumulable avec le cadeau hugo boss
			foreach ($this->contents as $index => $content) {
				if (strpos($index, 'gift_') === false || strpos($index, 'gift_promo') !== false)
				$total += $content['qty'];
				else {
					$all_gift[] = $index;
					if (strpos($index, 'gift_pack') !== false) {
						$temp = str_replace('gift_pack_', '', $index);
						$packs[] = substr($temp, 0, strpos($temp, '_'));
						$pack_indexes[] = $index;
					}
					elseif (strpos($index, 'gift_min3_') !== false)
					$check_min3[] = $index;
					elseif (strpos($index, 'gift_min2_') !== false)
					$check_min2[] = $index;
					elseif (strpos($index, 'gift_nb_') !== false) {
						$already_gift[] = $index;
						$gift_nb += $content['qty'];
					}
					elseif (strpos($index, 'gift_reducpack_') !== false)
					$reduc_packs[] = $index;
				}
			}
				
			if ($total == 0 && !($this->card_only && !empty($reduc_packs))) {
				reset($all_gift);
				while(list(,$index) = each($all_gift)){
					$this->remove($index, false);
				}
			}
			//Si pack, on verifie que les produits du packs sont tjrs dans le panier
			elseif (count($packs) > 0) {
				while(list($index, $pack) = each($packs)) {
					$have_all_pack = true;
					$check_product_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, ".TABLE_PACKS." pa where p.products_model = pa.products_model AND p.products_status = 1 AND p.products_quantity > 2 AND pa.is_gift = 0 AND pa.pack_num  = ".$pack);
					while($check_product = tep_db_fetch_array($check_product_query))
					if (!isset($this->contents[$check_product['products_id']]))
					$have_all_pack = false;

					if (!$have_all_pack) {
						reset($pack_indexes);
						while(list(,$index) = each($pack_indexes)){
							$this->remove($index, false);
						}
						unset($packs[$index]);
					}
				}
			}
			//if there is less than 2 products, remove coupon pack.
			if (!empty($already_gift) && ($total < 2 || count($packs) > 0)) {
				reset($already_gift);
				while(list(,$index) = each($already_gift)){
					$this->remove($index, false);
				}
			}
			//Si on a des cadeaux via coupon utilisables sur la premiere commande seulement
			/*elseif (!empty($reduc_packs) && $this->code_already_used(str_replace('gift_reducpack_', '', $reduc_packs[0]), 'id')) {
			reset($reduc_packs);
			while(list(,$index) = each($reduc_packs))
			{              $this->remove($index, false);
			error_log('*************************4');       }
			}*/
			elseif (!empty($reduc_packs) && $total < 2) {
			reset($reduc_packs);
			while(list(,$index) = each($reduc_packs))
			{              $this->remove($index, false);
			error_log('*************************4');       }
			}
			//Si nb produit = 2, on enleve 1 produit cadeau s'il y en a NB_GIFT_FOR_3
			elseif (!empty($already_gift) && $total < 3 && $gift_nb == NB_GIFT_FOR_3) {
				reset($already_gift);
				while(list(,$index) = each($already_gift)) {
					$this->remove($index, false);
				}
			}

			//On retire les cadeaux coupons necessitant 3 produits mini si il y a mois de 3 produits dans le panier
			if (!empty($check_min3) && $total < 3) {
				reset($check_min3);
				while(list(,$index) = each($check_min3))
				{              $this->remove($index, false);
				}
			}
			//On retire les cadeaux coupons necessitant 2 produits mini si il y a mois de 2 produits dans le panier
			if (!empty($check_min2) && $total < 2) {
				reset($check_min2);
				while(list(,$index) = each($check_min2))
				{              $this->remove($index, false);
				}
			}
		}
	}

	function add_card($card_code) {
		global $new_products_id_in_cart, $customer_id, $cards;

		if (in_array($card_code, array_keys($cards->list)) && !$this->in_cart($card_code)) {
			$this->contents[$card_code] = array('qty' => 1, 'price' => $cards->list[$card_code]['price'], 'duration' => $cards->list[$card_code]['duration']);

			$this->cleanup();

			// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
			$this->cartID = $this->generate_cart_id();
			$this->gift();
		}
	}

	function is_card($id) {
		return strpos($id, 'card') !== false;
	}

	function card_only() {
		if (count($this->contents) == 1)
		foreach ($this->contents as $id => $value)
		return $this->is_card($id);
		return false;
	}

	function has_card($type = false) {
		$content = $this->contents;
		foreach ($content as $id => $value)
		if ($this->is_card($id) && ($type === false || $type !== false && $type == $id))
		return true;
		return false;
	}

	function check_daily_limit($customer_id) {
		global $is_member;

		if (MAX_DAILY_LIMIT == 0) return true;

		$query = 'SELECT SUM(op.products_quantity), '.$this->count_contents(false).', IFNULL(SUM(op.products_quantity), 0) + '.$this->count_contents(false).' <= '.($is_member || $this->has_card() ? MAX_DAILY_LIMIT : MAX_DAILY_LIMIT_NOT_MEMBER).' as limite
        FROM orders o, orders_products op
        WHERE o.customers_id = '.$customer_id.'
        AND o.orders_id = op.orders_id
        AND ADDTIME(o.date_purchased, "08:00:00") > CONCAT(DATE(ADDTIME(NOW(), "08:00:00")), " 00:00:00")
        AND op.products_model != "0"
        AND op.products_price > 0
        AND op.products_model NOT LIKE "card%"';
		$rs = tep_db_query($query);
		$rs = mysql_fetch_assoc($rs);
		return $rs['limite'] == "1";
	}

	function check_weekly_limit($customer_id) {
		if (MAX_WEEKLY_LIMIT == 0) return true;

		$query = 'SELECT SUM(op.products_price * op.products_quantity), '.$this->show_total().', IFNULL(SUM(op.products_price), 0) + '.$this->show_total().' <= '.MAX_WEEKLY_LIMIT.' as limite
        FROM orders o, orders_products op
        WHERE o.customers_id = '.$customer_id.'
        AND o.orders_id = op.orders_id
        AND ADDTIME(o.date_purchased, "08:00:00") > SUBDATE(ADDTIME(NOW(), "08:00:00"), INTERVAL 1 WEEK)
        AND op.products_model != "0"
        AND op.products_price > 0
        AND op.products_model NOT LIKE "card%"';
		$rs = tep_db_query($query);
		$rs = mysql_fetch_assoc($rs);
		return $rs['limite'] == "1";
	}

	function can_buy($number) {
		global $is_member, $check_server;
		return /*$check_server != 'en' && */ ($is_member || $this->has_card() /*&& !$this->card_only()*/) && $this->count_contents(false) < $number;
	}

	function first_order() {
		global $customer_id;
		if (!empty($customer_id)) {
			$query = 'SELECT orders_id FROM '.TABLE_ORDERS.' WHERE customers_id = '.$customer_id;
			$rs = tep_db_query($query);
			return mysql_num_rows($rs) == 0;
		}
		return true;
	}

	function code_already_used($var, $type) {
		global $customer_id;
		if (!empty($customer_id)) {
			if ($type == 'code')
			$query = 'SELECT o.orders_id
					FROM '.TABLE_ORDERS.' o, '.TABLE_ORDERS_PRODUCTS.' op , coupon_packs cp
					WHERE o.customers_id = '.$customer_id.' 
					AND o.orders_id = op.orders_id 
					AND cp.code LIKE "'.$var.'"
					AND cp.products_model = op.products_model
					AND op.products_price = 0';
			elseif ($type = 'id')
			$query = 'SELECT o.orders_id
					FROM '.TABLE_ORDERS.' o, '.TABLE_ORDERS_PRODUCTS.' op
					WHERE o.customers_id = '.$customer_id.' 
					AND o.orders_id = op.orders_id 
					AND op.products_id = '.$var.'
					AND op.products_price = 0';
			$rs = tep_db_query($query);
			return mysql_num_rows($rs) >= 1;
		}
		return false;
	}
}
?>
