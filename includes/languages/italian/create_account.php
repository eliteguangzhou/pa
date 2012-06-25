<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE', 'Crea un Account');

define('HEADING_TITLE', 'Informazioni account');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTA:</b></font></small> Se tu hai gia un account, vai alla pagina <a href="%s"><u>login</u></a>.');

define('EMAIL_SUBJECT', 'Benvenuto in ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Caro Mr. vnom,' . "\n\n");
define('EMAIL_GREET_MS', 'Cara Ms. vnom,' . "\n\n");
define('EMAIL_GREET_NONE', 'Caro vnom' . "\n\n");
define('EMAIL_WELCOME', '
Congratulazioni! Il tuo account personale è stato correttamente creato.

Adesso puoi acquistare i nostri profumi facendo clic su: “Aggiungi al carrello”

Le credenziali per accedere all’account sono le seguenti:

Utente : vloggin
Password: vpass'. "\n\n");
define('EMAIL_TEXT', '');
define('EMAIL_CONTACT', 'Se hai bisogno di aiuto, ti invitiamo a contattarci per e-mail all\'indirizzo: <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'" target="_blank">'.STORE_OWNER_EMAIL_ADDRESS.'</a>.

Ti auguriamo un’ottima navigazione,

SAMY
Il team per l’assistenza ai clienti
<a href="http://www.'.strtolower(STORE_NAME).'/" target="_blank">www.'.strtolower(STORE_NAME).'</a>');
define('EMAIL_WARNING', '<b>Note:</b> Questo indirizzo email è stato utilizzato da un nostro cliente. Se non hai scelto tu di iscriverti, per piacere contattaci all\'indirizzo ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('ENTRY_EMAIL_ADDRESS_SPONSORSHIP_ERROR', 'L\'indirizzo di sponsorizzazione è diverso da quello che hai inserito.');

define('SPONSORSHIP_GODFATHER', 'Il tuo sponsor è:');
define('SPONSORSHIP_GODFATHER_UNKNOWN', 'La chiave e l\'e-mail inserito non corrisponde ad alcuna sponsorizzazione.');
?>