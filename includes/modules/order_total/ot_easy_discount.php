<?php
  class ot_easy_discount {
    var $title, $output;

    function ot_easy_discount() {
      $this->code = 'ot_easy_discount';
      $this->title = MODULE_EASY_DISCOUNT_TITLE;
      $this->description = MODULE_EASY_DISCOUNT_DESCRIPTION;
      $this->enabled = ((MODULE_EASY_DISCOUNT_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_EASY_DISCOUNT_SORT_ORDER;
      $this->output = array();
    }
    
    function process() {
      global $order, $currencies, $ot_subtotal, $cart, $easy_discount;
      $od_amount = 0;
      if ($easy_discount->count() > 0) {
        $easy_discounts = $easy_discount->get_all();
        $n = sizeof($easy_discounts);
        for ($i=0;$i < $n; $i++) {
           $this->output[] = array('title' => $easy_discounts[$i]['description'].': ',
                                   'text' => '<font color="red">-' . $currencies->format($easy_discounts[$i]['amount']).'</font>',
                                   'value' => $easy_discounts[$i]['amount']);
           $od_amount = $od_amount + $easy_discounts[$i]['amount'];
        }
        $this->deduction = $od_amount;
	  $order->info['total'] = $order->info['total'] - $od_amount;
        if ($this->sort_order < $ot_subtotal->sort_order) $order->info['subtotal'] = $order->info['subtotal'] - $od_amount;
      }
    }
  
    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EASY_DISCOUNT_STATUS'");
        $this->check = mysql_num_rows($check_query);
      }
      return $this->check;
    }

    function keys() {
      return array('MODULE_EASY_DISCOUNT_STATUS', 'MODULE_EASY_DISCOUNT_SORT_ORDER');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values 
    ('Activate Easy Discount', 'MODULE_EASY_DISCOUNT_STATUS', 'true', 'Do you want to enable the Easy discount module?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values 
    ('Sort Order', 'MODULE_EASY_DISCOUNT_SORT_ORDER', '2', 'Sort order of display.', '6', '2', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>