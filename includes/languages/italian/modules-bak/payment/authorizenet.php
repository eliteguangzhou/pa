<?php
/*
  $Id: authorizenet.php,v 1.13 2003/01/03 17:25:43 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Test Info carta di Credito:<br><br>CC#: 4111111111111111<br>Scadenza: Qualsiasi');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Tipo:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Proprietario Carta di Credito:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Numero Carta di Credito:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Data di Scadenza Carta di Credito:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* Il nome del proprietario della carta di credito deve contenere almeno ' . CC_OWNER_MIN_LENGTH . ' caratteri.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* Il Numero della Carta di Credito deve contenere almeno ' . CC_NUMBER_MIN_LENGTH . ' caratteri.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'Si è verificato un errore nel procedimento di controllo della carta di credito, riprova.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'La tua carta di credito non è valida. Prova con un\'altra carta oppure contatta la tua banca per ulteriori informazioni.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Errore carta di credito!');
?>