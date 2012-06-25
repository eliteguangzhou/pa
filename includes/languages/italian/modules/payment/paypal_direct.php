<?php
/*
  $Id: paypal_direct.php 1801 2008-01-11 16:49:20Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_DIRECT_TEXT_TITLE', 'PayPal Paiements Direct');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_TEXT_PUBLIC_TITLE', 'Carte de cr&eacute;dit (S&eacute;curis&eacute; par Paypal)');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_TEXT_DESCRIPTION', '<b>Note: PayPal requires the PayPal Express Checkout payment module to be enabled if this module is activated.</b><br /><br /><img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.paypal.com/mrb/pal=PS2X9Q773CKG4" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit PayPal Website</a>&nbsp;<a href="javascript:toggleDivBlock(\'paypalDirectInfo\');">(info)</a><span id="paypalDirectInfo" style="display: none;"><br><i>Using the above link to signup at PayPal grants osCommerce a small financial bonus for referring a customer.</i></span>');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_OWNER', 'Propri&eacute;taire de la carte : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_TYPE', 'Type de carte : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_NUMBER', 'Num&eacute;ro de carte : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_VALID_FROM', 'Date de d&eacute;but de validit&eacute; : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_VALID_FROM_INFO', '(si disponible)');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_EXPIRES', 'Date d\'expiration : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_CVC', 'Code de s&eacute;curit&eacute; (CVV2) : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_ISSUE_NUMBER', 'Num&eacute; de d&eacute; de carte : ');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_CARD_ISSUE_NUMBER_INFO', '(pour cartes Maestro and Solo seulement)');
  define('MODULE_PAYMENT_PAYPAL_DIRECT_ERROR_ALL_FIELDS_REQUIRED', 'Erreur: Tous les champs requis ne sont pas remplis.');
?>
