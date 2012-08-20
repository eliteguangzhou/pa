<?php
    function easy_discount_display() {
      global $currencies, $easy_discount;
      $discount = '';
      if ($easy_discount->count() > 0) {
        $easy_discounts = $easy_discount->get_all();
        $n = sizeof($easy_discounts);
        for ($i=0;$i < $n; $i++) {
           $discount .= '<tr><td align="right">'.$easy_discounts[$i]['description'].':</td><td align="right"><font color="red">- ' . $currencies->format($easy_discounts[$i]['amount']).'</font></td></tr>';
        }
      }
      return $discount;
    }
?>