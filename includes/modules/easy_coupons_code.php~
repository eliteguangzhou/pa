<?php
include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_EASY_COUPONS);
// easy discount installed

// configuration details extraction
$ec_config  = split('d',EASY_COUPONS); // split table from config
$ec_table   = $ec_config[1];
$ec_config  = split(';',$ec_config[0]); // split config values
$ec_active  = $ec_config[0]; // EC active
$ec_auto    = $ec_config[1]; // EC Automatic
$ec_email   = $ec_config[4]; // Print on email
$ec_expire  = $ec_config[5]; // Expires
$ec_days    = $ec_config[6]; // days to expiration
$ec_dtype   = $ec_config[7]; // discount table type (money/percent)
$ec_mf      = $ec_config[8]; // discount table value (max/fixed)
$ec_clth    = $ec_config[9]; // length of coupon codes in characters
$ec_reset   = $ec_config[10]; // show button reset
$messageStack->reset();
     

if (ACTIVATE_DISCOUNT) {
  // coupons enabled
  if ($ec_active) {
    $discounts = $easy_discount->get_all();
    if (!tep_session_is_registered('couponcode')) $couponcode = array();
    if (isset($_POST['coupon_code']) && $_POST['coupon_code'] != '') {
      // fetch the coupon code from the database
      $coupon_query = tep_db_query("select code, discount, type, enddate, email, generated_by
                                    from coupons
                                    where code = '" . strtoupper($_POST['coupon_code']) . "'
                                      and (enddate > now() || enddate is null)
                                      and used = 0 ");
      $coupon = tep_db_fetch_array($coupon_query);
    }
    // cart not empty
	if (isset($coupon)) {
		if ($cart->count_contents(false) >= 0 || in_array($coupon['generated_by'], array('coupon_packs', 'produit_reduc', 'first_order'))) {
		  // coupon code input given
		  if ($_POST['coupon_code'] != '') {
			// concatenate the input fields
			$inputcouponcode = strtoupper($_POST['coupon_code']);
			// coupon reset code
			$already_in_use = false;
			$have_avoir_cadeau = false;
			$have_packreduc = false;
			$have_produit_cadeau = false;
			$have_customer_service = false;
			$min_cart_total = $cart_total;
			foreach ($discounts as $discount) {
				if (stripos($discount['description'], $inputcouponcode) !== false)
					$already_in_use = true;
				elseif (in_array($discount['generated_by'], array('avoir_cadeau', 'neta')))
					$have_avoir_cadeau = true;
				elseif ($discount['generated_by'] == 'packreduc')
					$have_packreduc = true;
				elseif ($discount['generated_by'] == 'customer_service')
					$have_customer_service = true;
				$min_cart_total -= $discount['amount'];
			}

			if ($already_in_use) {
				$messageStack->add_session('cart',EC_IN_USE,'error');
				$messageStack->add('cart',EC_IN_USE,'error');
			}
			elseif ($inputcouponcode != 'RESET') {

			  foreach ($cart->contents as $key => $value)
				if (stristr($key, 'gift_reduc_'))
					$have_produit_cadeau = true;

			  //Si coupon service client mais pas authentifier, on affiche une erreur
			  if (!empty($coupon['email']) && !isset($customer_id)) {
				$messageStack->add_session('cart',EC_NEED_TO_LOG,'error');
				$messageStack->add('cart',EC_NEED_TO_LOG,'error');
			  }
			  //Si pas premiere commande, on ne peut pas utiliser le coupon service client
			  elseif ($coupon['generated_by'] == 'customer_service' && !$cart->first_order()) {
				$messageStack->add_session('cart',EC_NOT_FIRST_ORDER,'error');
				$messageStack->add('cart',EC_NOT_FIRST_ORDER,'error');
			  }
			  //Si reduction grace a un coupon du service client, on verifie que la commande comporte au moins 2 produits
			  elseif ($coupon['generated_by'] == 'customer_service' && $cart->count_contents(false) < 2) {
				$messageStack->add_session('cart',EC_MIN_PRODUCTS_UNREACHED,'error');
				$messageStack->add('cart',EC_MIN_PRODUCTS_UNREACHED,'error');
			  }
			  elseif ($coupon['generated_by'] == 'first_order' && !$cart->first_order()) {
				$messageStack->add_session('cart',EC_NOT_FIRST_ORDER,'error');
				$messageStack->add('cart',EC_NOT_FIRST_ORDER,'error');
			  }
			  //On verifie s'il n'y a pas deja un coupon packreduc ou un avoir venant d'un cadeau manquant
			  elseif ($coupon['generated_by'] == 'packreduc' && $have_packreduc
				|| in_array($coupon['generated_by'], array('avoir_cadeau', 'neta')) && $have_avoir_cadeau
				|| $coupon['generated_by'] == 'customer_service' && $have_customer_service) {
				$messageStack->add_session('cart',EC_CANT_USE,'error');
				$messageStack->add('cart',EC_CANT_USE,'error');
			  }
			  //Sinon on verifie s'il n'y a pas deja un produit cadeau offert (hors cadeau hugo a partir de 2 produits)
			  elseif ($coupon['generated_by'] == 'produit_cadeau' && $have_produit_cadeau) {
				$messageStack->add_session('cart',EC_ALREADY_PRODUCT,'error');
				$messageStack->add('cart',EC_ALREADY_PRODUCT,'error');
			  }
			  elseif (!empty($coupon['email']) && $coupon['email'] != $customer_email_address){
				// give message
				$messageStack->add_session('cart',EC_BAD_EMAIL,'error');
				$messageStack->add('cart',EC_BAD_EMAIL,'error');
			  }
			  // valid and available coupon code found
			  elseif ($coupon['code']) {

				//S'il s'agit d'un pack produit cadeau, on l'ajoute si dispo
				if ($coupon['generated_by'] == 'coupon_packs') {
				
					$products = array_keys($cart->contents);
					$error = false;
					foreach ($products as $id)
						if (strpos($id, 'gift_') !== false) {
							$messageStack->add_session('cart',EC_ALREADY_PRODUCT,'error');
							$messageStack->add('cart',EC_ALREADY_PRODUCT,'error');
							$error = true;
							break;
						}
					if (!$error) {
						
					  //if ($cart->code_already_used($coupon['code'], 'code')) {
						//$messageStack->add_session('cart',EC_CODE_ALREADY_USED,'error');
						//$messageStack->add('cart',EC_CODE_ALREADY_USED,'error');
					//  }
					  /*
					  if (!$cart->first_order()) {
						  $messageStack->add_session('cart',EC_FIRST_ORDER_ONLY,'error');
						  $messageStack->add('cart',EC_FIRST_ORDER_ONLY,'error');
					  }if (!$cart->has_card()) {
						  $messageStack->add_session('cart',EC_CARD_REQUIRED,'error');
						  $messageStack->add('cart',EC_CARD_REQUIRED,'error');
					  }*/
						if ($cart->count_contents(false) < 2) {
							$messageStack->add_session('cart',EC_TWO_PRODUCTS_MIN,'error');
							$messageStack->add('cart',EC_TWO_PRODUCTS_MIN,'error');
						}
					  else {
						$query = 'SELECT p.products_id, p.products_quantity, p.products_status from products p, coupon_packs cp where cp.code = "'.$coupon['code'].'" AND cp.products_model = p.products_model';
						$result = tep_db_query($query);
						$error = false;
						$products = array();
						while($rs = tep_db_fetch_array($result)) {
						  if (!$error && ($rs['products_quantity'] <= 0 || $rs['products_status'] == 0)) {
							  $messageStack->add_session('cart',EC_OOS,'error');
							  $messageStack->add('cart',EC_OOS,'error');
							  $error = true;
						  }
						  $products[] = $rs['products_id'];
						}

						if ($error == false) {
							foreach ($products as $id){
							  $cart->add_cart($id, 1, '', false, 'reducpack');
							}
							$messageStack->add_session('cart',EC_PRODUCTS_ADDED,'success');
							$messageStack->add('cart',EC_PRODUCTS_ADDED,'success');
						}
					  }
					}
				}
				//S'il s'agit d'un produit cadeau, on l'ajoute si dispo
				elseif ($coupon['generated_by'] == 'produit_cadeau') {
					$query = 'SELECT products_id, products_quantity, products_status from products where products_model = '.$coupon['code'];
					$result = tep_db_query($query);
					$rs = tep_db_fetch_array($result);
					
					if ($rs['products_quantity'] <= 0 || $rs['products_status'] == 0) {
						$messageStack->add_session('cart',EC_OOS,'error');
						$messageStack->add('cart',EC_OOS,'error');
					}
					else {
						$cart->add_cart($rs['products_id'], 1, '', false, 'reduc');
						$messageStack->add_session('cart',EC_PRODUCT_ADDED,'success');
						$messageStack->add('cart',EC_PRODUCT_ADDED,'success');
					}
				}
				//S'il s'agit d'un produit en reduction, on l'ajoute si dispo et pas deja un produit similaire dans le panier
				elseif ($coupon['generated_by'] == 'produit_reduc') {
					$query = 'SELECT products_id, products_quantity, products_status from products where products_model = '.$coupon['code'];
					$result = tep_db_query($query);
					$rs = tep_db_fetch_array($result);

					if ($rs['products_quantity'] <= 0 || $rs['products_status'] == 0) {
						$messageStack->add_session('cart',EC_OOS,'error');
						$messageStack->add('cart',EC_OOS,'error');
					}
					else {
						$cart->add_cart($rs['products_id'], 1, '', false, 'promo', $coupon['discount']);
						$messageStack->add_session('cart',EC_PRODUCT_ADDED,'success');
						$messageStack->add('cart',EC_PRODUCT_ADDED,'success');
					}
				}
				//S'il s'agit d'un produit cadeau pour 2 produits mini, on l'ajoute si dispo
				elseif ($coupon['generated_by'] == 'produit_cadeau_2') {
					$products = array_keys($cart->contents);
					$error = false;
					foreach ($products as $id)
						if (strpos($id, 'gift_') !== false) {
							$messageStack->add_session('cart',EC_ALREADY_PRODUCT,'error');
							$messageStack->add('cart',EC_ALREADY_PRODUCT,'error');
							$error = true;
							break;
						}

					if (!$error)
						if ($cart->count_contents(false) < 2) {
							$messageStack->add_session('cart',EC_TWO_PRODUCTS_MIN,'error');
							$messageStack->add('cart',EC_TWO_PRODUCTS_MIN,'error');
						}
						else {
							$query = 'SELECT products_id, products_quantity, products_status from products where products_model = '.$coupon['code'];
							$result = tep_db_query($query);
							$rs = tep_db_fetch_array($result);

							if ($rs['products_quantity'] <= 0 || $rs['products_status'] == 0) {
								$messageStack->add_session('cart',EC_OOS,'error');
								$messageStack->add('cart',EC_OOS,'error');
							}
							else {
								foreach ($cart->contents as $index => $content)
								  if (strpos($index, 'gift_nb_') !== false)
									$cart->remove($index, false);
								$cart->add_cart($rs['products_id'], 1, '', false, 'min2');
								$messageStack->add_session('cart',EC_PRODUCT_ADDED,'success');
								$messageStack->add('cart',EC_PRODUCT_ADDED,'success');
							}
						}
				}
				//S'il s'agit d'un produit cadeau pour 3 produits mini, on l'ajoute si dispo
				elseif ($coupon['generated_by'] == 'produit_cadeau_3') {
					$products = array_keys($cart->contents);
					$error = false;
					foreach ($products as $id)
						if (strpos($id, 'gift_min3_') !== false) {
							$messageStack->add_session('cart',EC_ALREADY_PRODUCT,'error');
							$messageStack->add('cart',EC_ALREADY_PRODUCT,'error');
							$error = true;
							break;
						}
					
					if (!$error)
						if ($cart->count_contents(false) < 3) {
							$messageStack->add_session('cart',EC_THREE_PRODUCTS_MIN,'error');
							$messageStack->add('cart',EC_THREE_PRODUCTS_MIN,'error');
						}
						else {
							$query = 'SELECT products_id, products_quantity, products_status from products where products_model = '.$coupon['code'];
							$result = tep_db_query($query);
							$rs = tep_db_fetch_array($result);

							if ($rs['products_quantity'] <= 0 || $rs['products_status'] == 0) {
								$messageStack->add_session('cart',EC_OOS,'error');
								$messageStack->add('cart',EC_OOS,'error');
							}
							else {
								$cart->add_cart($rs['products_id'], 1, '', false, 'min3');
								$messageStack->add_session('cart',EC_PRODUCT_ADDED,'success');
								$messageStack->add('cart',EC_PRODUCT_ADDED,'success');
							}
						}
				}
				elseif ($coupon['generated_by'] == 'card6') {
                                        $products = array_keys($cart->contents);
                                        $error = false;
                                        if (!$is_member && !$cart->has_card()){
                                                    header('LOCATION:members.php?action=buy_card&products_id=card6');
                                        }
                                        elseif ($is_member) {
                                                    $buy_card_error = ALREADY_MEMBER;
                                                    tep_session_register('buy_card_error');
                                        }
                                        elseif ($cart->has_card()) {
                                                    $buy_card_error = ALREADY_HAVE_CARD;
                                                    tep_session_register('buy_card_error');
                                        }
                                }
				elseif ($coupon['generated_by'] == 'card1') {
                                        $products = array_keys($cart->contents);
                                        $error = false;
                                        if (!$is_member && !$cart->has_card()){
                                                    header('LOCATION:members.php?action=buy_card&products_id=card1');
                                        }
                                        elseif ($is_member) {
                                                    $buy_card_error = ALREADY_MEMBER;
                                                    tep_session_register('buy_card_error');
                                        }
                                        elseif ($cart->has_card()) {
                                                    $buy_card_error = ALREADY_HAVE_CARD;
                                                    tep_session_register('buy_card_error');
                                        }
                                }
				else {
					$couponcode[] = array('generated_by' => $coupon['generated_by'], 'email' => $coupon['email'], 'code' => $coupon['code'], 'discount' => $coupon['discount'], 'type' => $coupon['type']);

					if (!tep_session_is_registered('couponcode')) tep_session_register('couponcode');
					// give message
					$messageStack->add_session('cart',EC_PROCESSED,'success');
					$messageStack->add('cart',EC_PROCESSED,'success');

					  // process coupon discount using easy discount
					  if (tep_session_is_registered('couponcode')) {
						$c_coupon = $couponcode[sizeof($couponcode) - 1];
						$n_coupon = sizeof($couponcode);
						$c_coupon = $c_coupon + array('name' => 'COUPON'.$n_coupon, 'description' => 'Coupon ('.$c_coupon['code'].')', 'amount' => $c_coupon['type'] == 'p' ? $cart_total*$c_coupon['discount']/100 : $c_coupon['discount']);
						$easy_discount->set($c_coupon);
					  }
				}

			  } else {
				// give message
				$messageStack->add_session('cart',EC_UNKNOWN,'error');
				$messageStack->add('cart',EC_UNKNOWN,'error');
			  }
			} else {
			  $messageStack->add_session('cart',EC_RESET,'success');
			  $messageStack->add('cart',EC_RESET,'success');
			  tep_session_unregister('couponcode');
			  foreach ($discounts as $discount)
				if ($discount['generated_by'] == 'coupon_packs')
					$cart->remove('gift_reducpack_'.$discount['code']);
				elseif ($discount['generated_by'] == 'produit_cadeau')
					$cart->remove('gift_reduc_'.$discount['code']);
				elseif ($discount['generated_by'] == 'produit_cadeau_3')
					$cart->remove('gift_min3_'.$discount['code']);
			  $easy_discount->discounts = array();
			  tep_session_register('easy_discount');
			}
		  } elseif ((isset($_POST['coupon_code']))) {
			$messageStack->add_session('cart',EC_EMPTY,'error');
			$messageStack->add('cart',EC_EMPTY,'error');
		  }
		} 
	}
    elseif ($cart->count_contents(false) == 0) {
	  // clear discount if cart goes empty
	  $nb_coupon = sizeof($couponcode);
	  foreach ($discounts as $discount)
		if (in_array($discount['generated_by'], array('produit_cadeau', 'produit_cadeau_3')))
			$cart->remove('gift_reduc_'.$discount['code']);

	  for ($i = 1; $i <= $nb_coupon; $i++)
		if (!$cart->card_only() || $cart->card_only() && $easy_discount->discounts['COUPON'.$i]['generated_by'] != 'first_order')
			$easy_discount->clear('COUPON'.$i);
			
	  if (isset($_POST['coupon_code']) && $_POST['coupon_code'] != '' && $coupon['generated_by'] == 'produit_cadeau_3') {
		$cart_error = EC_THREE_PRODUCTS_MIN;
	  }
	  elseif ((isset($_POST['coupon_code']) && $_POST['coupon_code'] != '') || !empty($_GET['g'])) {
		$cart_error = ERROR_PRODUCT_REQUIRED;
	  }
	}
    // clear the input fields
    $coupon_code = '';
  }
}
?>