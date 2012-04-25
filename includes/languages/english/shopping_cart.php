<?php
define('NAVBAR_TITLE', 'Cart Contents');
define('HEADING_TITLE', 'What\'s In My Cart?');
define('TABLE_HEADING_REMOVE', 'Remove');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Product(s)');
define('TABLE_HEADING_TOTAL', 'Total');
define('TEXT_CART_EMPTY', 'Your Shopping Cart is empty!');
define('SUB_TITLE_SUB_TOTAL', 'Sub-Total:');
define('SUB_TITLE_TOTAL', 'Total:');
define('SUB_TITLE_FRAIS_PORT', 'Shipping cost :');
define('SUB_TITLE_NB_PRODUCTS_DISCOUNT', 'Discount :');
define('OUT_OF_STOCK_CANT_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' dont exist in desired quantity in our stock.<br>Please alter the quantity of products marked with (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '), Thank you');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' dont exist in desired quantity in our stock.<br>You can buy them anyway and check the quantity we have in stock for immediate deliver in the checkout process.');
define('STR_GIFT', 'Your gift offered');
define('TEXT_MIN_PRODUCTS1', '<span class="red">You must add 2 products to your cart to be able to order.</span>');
define('TEXT_MAX_PRODUCTS', '<span class="red">You have reached the maximum number of products allowed on one order.</span>');
define('SUB_TITLE_SUB_TOTAL_PRODUCTS', 'Total products :');
define('TEXT_MIN_PRODUCTS2', '<span class="red">You must add 1 product to your cart to be able to order.</span>');
define('USE_CODE', '');
define('SPECIAL_PROMO', '<br /><b>Table of current offers:</b><br />
<table cellpadding="2" cellspacing="0" class="special_promo" style="text-align:center;margin:5px 0;" align="center" border="1">
<tr class="header" style="font-weight:bold;">
  <td>Nb products<br />purchased</td><td>Shipping</td>
</tr>%s</table>
');
define('SPECIAL_PROMO1', 'Buy 2 items and pay only '.$currencies->currencies[$currency]['symbol_left'].round(7 / $currencies->currencies["EUR"]['value'] * $currencies->currencies[$currency]['value']).$currencies->currencies[$currency]['symbol_right'].' shipping.');
define('SPECIAL_PROMO2', 'For 3 products bought, free shipping !');
?>