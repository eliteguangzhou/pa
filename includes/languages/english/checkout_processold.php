<?php
/*
  $Id: checkout_process.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('EMAIL_TEXT_SUBJECT', 'Order Process');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number: ');

define('EMAIL_TEXT_NAME','Name');
define('EMAIL_TEXT_PRICE','Price');
define('EMAIL_TEXT_QTY','Quantity');
define('EMAIL_TEXT_TOTAL','Total');	
define('EMAIL_TEXT_SUB_TOTAL','Sub-Total');
define('EMAIL_TEXT_TAX','Sales Tax');	
define('EMAIL_TEXT_ORDER_TOTAL','Order Total');	



define('EMAIL_TEXT_CONTENT_LESS','Thank you, your order was successful and payment has been made! Your goods will be dispached as soon as possible. Please visit again soon.<br> ');
define('EMAIL_TEXT_CONTENT_HIGH','Dear  %s, <br>Thank you for your order %s placed on %s The transaction was successful and we will ship your goods at the first possible opportunity. 
<br><br>You may check the status of your order at any given time by logging into your personal account at: <br> <a href=\"http://www.perfumewholesale.com\">http://www.perfumewholesale.com
</a><br>e-mail: %s<br>
');
define('EMAIL_TEXT_CONTENT', 'Your order was successful sent ! We will review it and send you an email to confirm the order. If all looks good, 
	we will then contact you within 24 hours by phone to confirm your shipment. <br> Your goods will be dispached as soon as possible. ');

define('EMAIL_TEXT_TITRE','<br><b>VIEW YOUR ORDER RECEIPT BELOW</b><br>');

define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_PRODUCTS', 'Products');
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Total:');
define('EMAIL_TEXT_TAX', 'Tax:        ');
define('EMAIL_TEXT_SHIPPING', 'Shipping: ');
define('EMAIL_TEXT_TOTAL', 'Total:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');
?>