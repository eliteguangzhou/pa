<?php
  class ot_nb_products_discount {
    var $title, $output;

    function ot_nb_products_discount() {
      $this->code = 'ot_nb_products_discount';
      $this->title = MODULE_NB_PRODUCTS_DISCOUNT_TITLE;
      $this->description = MODULE_NB_PRODUCTS_DISCOUNT_DESCRIPTION;
      $this->enabled = ((MODULE_NB_PRODUCTS_DISCOUNT_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_NB_PRODUCTS_DISCOUNT_SORT_ORDER;
      $this->output = array();
    }

    function process() {
        global $order, $currencies, $ot_subtotal, $cart, $nb_products_discount;
        $od_amount = 0;
        $od_amount = $nb_products_discount->total();
        $order->info['total'] = $order->info['total'] - $od_amount;
        if ($this->sort_order < $ot_subtotal->sort_order) $order->info['subtotal'] = $order->info['subtotal'] - $od_amount;
    }

    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_NB_PRODUCTS_DISCOUNT_STATUS'");
        $this->check = mysql_num_rows($check_query);
      }
      return $this->check;
    }

    function keys() {
      return array('MAX_NB_PRODUCTS_DISCOUNT', 'MODULE_NB_PRODUCTS_DISCOUNT_STATUS', 'MODULE_NB_PRODUCTS_DISCOUNT_SORT_ORDER');
    }

    function install() {
      tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " ( `configuration_title` , `configuration_key` , `configuration_value` , `configuration_description` , `configuration_group_id` , `sort_order` , `date_added` ) VALUES
        ('R&eacute;duction nb produits', 'MAX_NB_PRODUCTS_DISCOUNT', '2:4-3:20-4:26.666666', 'R&eacute;duction suivant le nombre de produits dans le panier.', '3', '21', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values
        ('Activer r&eacute;ductions nb produits', 'MODULE_NB_PRODUCTS_DISCOUNT_STATUS', 'true', 'Activer les r&eacute;ductions suivant le nombre de produits', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values
        ('Sort Order', 'MODULE_NB_PRODUCTS_DISCOUNT_SORT_ORDER', '3', 'Sort order of display.', '6', '2', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>