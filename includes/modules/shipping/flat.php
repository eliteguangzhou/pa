<?php
/*
  $Id: flat.php,v 1.40 2003/02/05 22:41:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class flat {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function flat() {
      global $order;

      $this->code = 'flat';
      $this->title = MODULE_SHIPPING_FLAT_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_FLAT_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_FLAT_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_FLAT_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_FLAT_STATUS == 'true') ? true : false);// la valeur de test 'true' ou 'false' est convertie dans application_top depuis 'Oui' ou 'Non' ! laisser le test sur la valeur 'true'
	  $this->values = array(
		1 => 14,
		2 => 7,
		3 => 0,
	  );


      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_FLAT_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_FLAT_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

// class methods
    function quote($method = '') {
      global $order, $cart, $is_member, $check_server, $currencies, $currency;
	  
	  if ($cart->card_only()) 
		$cost = 0;
	  elseif ($check_server == 'en')
		$cost = 5.95 / $currencies->currencies[$currency]['value'];
	  elseif ($is_member || $cart->has_card())
		$cost = 15;
	  else
		$cost = $this->get_cost($cart->count_contents(false));

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_FLAT_TEXT_TITLE,
							'tax' => 0,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => MODULE_SHIPPING_FLAT_TEXT_WAY,
                                                     'cost' => $cost //MODULE_SHIPPING_FLAT_COST
													 )));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FLAT_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Utiliser ce mode de livraison', 'MODULE_SHIPPING_FLAT_STATUS', 'Oui', 'Voulez-vous proposer ce mode de livraison ?', '6', '0', 'tep_cfg_select_option(array(\'Oui\', \'Non\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Coût de la livraison', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'Le montant forfaitaire de livraison pour toute commande utilisant cette méthode.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('TVA applicable', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Sélectionnez la TVA applicable sur le montant de la livraison.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone de livraison', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'Si une zone est sélectionnée, elle sera la seule à proposer ce mode de livraison.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordre d\'affichage', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Ordre de tri de l\'affichage dans la liste des modules.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_FLAT_STATUS', 'MODULE_SHIPPING_FLAT_COST', 'MODULE_SHIPPING_FLAT_TAX_CLASS', 'MODULE_SHIPPING_FLAT_ZONE', 'MODULE_SHIPPING_FLAT_SORT_ORDER');
    }
	
	function get_cost($qty) {
	  global $currencies;
	  while (!isset($this->values[$qty]) && $qty > 0)
		$qty--;
	  if ($qty == 0)
		return MODULE_SHIPPING_FLAT_COST / $currencies->currencies["EUR"]['value'];
	  else
        return $this->values[$qty] / $currencies->currencies["EUR"]['value'];
	}
	
	function get_promo($qty) {
	  global $currencies;
	  $promos = array();
	  $list = explode('-', MAX_NB_PRODUCTS_DISCOUNT);
	  foreach ($list as $l) {
		$l = explode(':', $l);
		$promos[$l[0]] = $l[1]; 
	  }
	  while (!isset($promos[$qty]) && $qty > 0)
		$qty--;
	  if ($qty == 0)
		return 0;
	  else
        return $promos[$qty] / $currencies->currencies["EUR"]['value'];
	}
	
	function get_offers() {
	  global $currencies, $currency;
	  
	  $promos = array();
	  $list = explode('-', MAX_NB_PRODUCTS_DISCOUNT);
	  foreach ($list as $l) {
		$l = explode(':', $l);
		$promos[$l[0]] = $l[1]; 
	  }
	  $max = array_merge(array_keys($promos), array_keys($this->values));
	  sort($max);
	  $max = max($max);
	  
	  $str = '';
	  for ($i = 1; $i <= $max; $i ++) {
		  $str .= '<tr class="'.($i%2?'second':'').'">
			<td>'.$i.'</td>
			<td>'.(($cost = $this->get_cost($i)) > 0 ? $currencies->currencies[$currency]['symbol_left'].round($cost * $currencies->currencies[$currency]['value']).$currencies->currencies[$currency]['symbol_right'] : FREE_SHIPPING_COST).'</td>
		  </tr>';
	  }
	  return $str;
	}
  }
?>
