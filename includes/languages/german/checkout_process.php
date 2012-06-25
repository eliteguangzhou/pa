<?php
/*
  $Id: checkout_process.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('EMAIL_TEXT_SUBJECT', 'Bestellung');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');

define('EMAIL_TEXT_NAME','Name');
define('EMAIL_TEXT_PRICE','Preis');
define('EMAIL_TEXT_QTY','Menge');
define('EMAIL_TEXT_TOTAL','Summe');
define('EMAIL_TEXT_SUB_TOTAL','Teilsumme');
define('EMAIL_TEXT_TAX','MwSt');
define('EMAIL_TEXT_ORDER_TOTAL','Order Total');



define('EMAIL_TEXT_CONTENT_HIGH','Sehr geehrter Herr / geehrte Frau %s,
<br><br>
Vielen Dank für Ihre Bestellung %s vom %s
<br><br>
Wenn Ihre Bestellung keine Unstimmigkeiten aufweist, werden Ihre Produkte binnen 12 Tagen geliefert.
<br><br>
Sie können den Status Ihrer Bestellung überprüfen, indem Sie sich innerhalb 72 Stunden auf Ihr Konto einwählen:
<br><br>
<a href=\"http://www.'.strtolower(STORE_NAME).'\">http://www.'.strtolower(STORE_NAME).'</a><br>
e-mail: %s<br>
Password: %s');
define('EMAIL_TEXT_CONTENT', 'Ihre Bestellung wurde uns korrekt zugesandt.
<br><br>
Wenn Ihre Bestellung keine Unstimmigkeiten aufweist, werden Ihre Produkte binnen 12 Tagen geliefert.');
define('EMAIL_TEXT_CONTENT_LESS',EMAIL_TEXT_CONTENT_HIGH);

define('EMAIL_TEXT_TITRE','<br><b>Ihre Bestellung</b><br>');

define('EMAIL_TEXT_INVOICE_URL', 'Detailierte Bestell&uuml;bersicht:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_PRODUCTS', 'Artikel');
define('EMAIL_TEXT_SUBTOTAL', 'Zwischensumme:');
define('EMAIL_TEXT_TAX', 'MwSt.');
define('EMAIL_TEXT_SHIPPING', 'Versandkosten:');
define('EMAIL_TEXT_TOTAL', 'Summe:        ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferanschrift');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsanschrift');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsweise');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'durch');

define('SPONSORSHIP_EMAIL_SUBJECT', 'Neue Rabatt-Code '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Hallo ,

Wir freuen uns, Ihnen die folgenden Rabatt-Code: "%s" im Wert von %s gültig %s Monate nach Bestellung Ihrer %s Patenkind %s.

Sie können Ihre Liste der Kürzungen im Logging auf unserer Website unter folgendem Link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php</a>

Mit besten Grüßen,
Jede Mannschaft '.STORE_NAME.'. ');

define('STR_GODCHILD_1', '');
define('STR_GODCHILD_2', 'kleines ');
define('STR_GODCHILD_3', 'kleines kleines ');

define('EMAIL_TEXT_DISCOUNT_SUBJECT', '%s Rabatt für Freunde !');


define('EMAIL_FRIEND_DISCOUNT', 'Hallo %s,

Nach Ihrer Bestellung können Sie Ihre Freunde mit profitieren Sie von einer Reduktion von %s.

Klicken Sie auf, unverzüglich auf den Link unten, um den Gutschein an Ihre Freunde schicken:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s">http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s</a>

Mit besten Grüßen,
Jede Mannschaft '.STORE_NAME.'.
');
?>
