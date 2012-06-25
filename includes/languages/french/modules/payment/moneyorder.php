<?php
/*
  $Id: moneyorder.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Paiement par chèque');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Etablir le chèque à l\'ordre de :&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br><br>Envoyer à :<br>' . nl2br(STORE_NAME_ADDRESS) . '<br><br>' . 'Votre commande ne sera traitée qu\'à réception du règlement.');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', 'Etablir le chèque à l\'ordre de : ' . MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\n" .'Envoyer à :' . "\n" .nl2br(STORE_NAME_ADDRESS) . "\n\n" . 'Votre commande ne sera traitée qu\'à réception du règlement.');
?>
