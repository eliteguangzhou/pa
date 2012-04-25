<?php
/*
  $Id: ipayment.php,v 1.4 2002/11/01 05:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

  define('MODULE_PAYMENT_IPAYMENT_TEXT_TITLE', 'iPayment');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_DESCRIPTION', 'Test Info Carta di Credito:<br><br>CC#: 4111111111111111<br>Scadenza: Qualsiasi');
  define('IPAYMENT_ERROR_HEADING', 'Si è verificato un errore nel procedimento di controllo della tua Carta di Credito');
  define('IPAYMENT_ERROR_MESSAGE', 'Controlla i dettagli della tu Carta di Credito!');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_OWNER', 'Proprietario Carta di Credito:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_NUMBER', 'Numero Carta di Credito:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_EXPIRES', 'Data di Scadenza Carta di Credito:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER', 'Carta di Credito Checknumber:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(si trova dietro la Carta di Credito)');

  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_OWNER', '* Il nome del proprietario della Carta di Credito deve contenere almeno ' . CC_OWNER_MIN_LENGTH . ' caratteri.\n');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_NUMBER', '* Il Numero della Carta di Credito deve contenere almeno ' . CC_NUMBER_MIN_LENGTH . ' caratteri.\n');
?>