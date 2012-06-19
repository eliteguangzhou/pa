<?php
  class easy_discount {
    var $discounts;

    function easy_discount () {
      $this->discounts = array();
    }

    function reset() {
      $this->discounts = array();
    }

    function set($array) {
      $this->discounts[$array['name']] = $array;
    }

    function add($array) { // obsolete
      $this->discounts[$array['name']] = $array;
    }

    function clear($type) {
      if (isset($this->discounts[$type])) unset($this->discounts[$type]);
    }

    function remove_type($type) { // obsolete
      if (isset($this->discounts[$type])) unset($this->discounts[$type]);
    }

    function count() {
      return sizeof($this->discounts);
    }

    function get($type) {
      return $this->discounts[$type];
    }

    function total() {
      reset($this->discounts);
      $total = 0;
      while (list($type, ) = each($this->discounts)) {
       $total = $total + $this->discounts[$type]['amount'];
      }
      return $total;
    }

    function get_all() {
      $discounts_array = array();
      reset($this->discounts);
      while (list($type, $array) = each($this->discounts)) {
          $discounts_array[] = $array;
      }
      return $discounts_array;
    }

    function recalculate() {
      global $cart, $is_member;
      $total = $cart->count_contents(false);
      if (!$cart->in_cart('gift_reduc_999999') && $cart->count_contents(false) != 0){
        $cart->add_cart(999999, 1, '', false, 'reduc');
      }
      reset($this->discounts);
      
      while (list($type, $infos) = each($this->discounts)) {
          if ($infos['type'] == 'p') {
            $this->discounts[$type]['amount'] = $cart->show_total()*$infos['discount']/100;
          }
          elseif ($infos['generated_by'] == 'customer_service' && $total < 2
            || $infos['generated_by'] == 'neta' && !$cart->has_card('gold')) {
            unset($this->discounts[$type]);
            $temp = $this->discounts;
            $this->discounts = array();
            $i = 0;
            foreach ($temp as $key => $value) {
                $value['name'] = 'COUPON'.$i;
                $this->discounts['COUPON'.$i] = $value;
                $i++;
            }
          }
          elseif ($infos['generated_by'] == 'first_order' && !$cart->first_order()) {
            unset($this->discounts[$type]);
            $temp = $this->discounts;
            $this->discounts = array();
            $i = 0;
            foreach ($temp as $key => $value) {
                $value['name'] = 'COUPON'.$i;
                $this->discounts['COUPON'.$i] = $value;
                $i++;
            }
          }
      }
    }
  }
?>