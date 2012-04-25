<?php
/*
  $Id: create_account.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Konto erstellen');

define('HEADING_TITLE', 'Informationen zu Ihrem Kundenkonto');


define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>ACHTUNG:</b></font></small> Wenn Sie bereits ein Konto besitzen, so melden Sie sich bitte <a href="%s"><u><b>hier</b></u></a> an.');

define('EMAIL_SUBJECT', 'Willkommen zu ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrte ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");

define('EMAIL_WELCOME', '
Glückwunsch! Ihr persönliches Konto ist nun angelegt.

Sie können nun unsere Parfums kaufen, indem Sie auf: "zum Korb hinzufügen" klicken

Die Angaben für den Zugang zu Ihrem Konto sind folgende:

Nutzer: vloggin
Passwort: vpass'. "\n\n");

define('EMAIL_TEXT', '');
define('EMAIL_CONTACT', 'Wenn Sie Hilfe benötigen, wollen Sie bitte per Telefon oder per Email mit uns Kontakt aufnehmen unter <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'" target="_blank">'.STORE_OWNER_EMAIL_ADDRESS.'</a>.

  Einen schönen Besuch!

  SAMY
  Team Kundenservice
  <a href="http://www.'.strtolower(STORE_NAME).'/" target="_blank">www.'.strtolower(STORE_NAME).'</a>');
  
define('EMAIL_WARNING', '<b>Achtung:</b> Diese eMail-Adresse wurde uns von einem Kunden bekannt gegeben. Falls Sie sich nicht angemeldet haben, senden Sie bitte eine eMail an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('ENTRY_EMAIL_ADDRESS_SPONSORSHIP_ERROR', 'Die Adresse des Sponsoring ist anders als die von Ihnen eingegeben.');

define('SPONSORSHIP_GODFATHER', 'Ihr Sponsor ist: ');
define('SPONSORSHIP_GODFATHER_UNKNOWN', 'Der Schlüssel und die E-Mail ist nicht gleich wie jeder Sponsoring.');
?>
