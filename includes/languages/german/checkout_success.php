<?php
/*
  $Id: checkout_success.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Kasse');
define('NAVBAR_TITLE_2', 'Erfolg');

define('HEADING_TITLE', '<p><b>Glückwunsch !</b></p>
  <p>
  Ihre Bestellung wurde uns korrekt zugesandt. </p>
  <p>Wenn Ihre Bestellung keine Unstimmigkeiten enthält, werden Ihnen Ihre Produkte innerhalb von 12 Tagen geliefert.</p>

  <p>
  Eine Auftragsbestätigung ist Ihre E-Mail-Box gesendet. Wenn Sie sie nicht erhalten zu haben innerhalb von 10 Minuten, können Sie auf Ihre Auftragsbestätigung mit diesem Link:<br />
  <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
  </p>
<br /><br />
  <p><b>
  Bitte beachten Sie auch genießen Sie Ihre Kenntnisse über einen Gutschein im Wert von %s, indem Sie ihre E-Mail in den folgenden Bereichen:</b><br />
  <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
  <table cellpadding="0" cellspacing="5" style="width:220px;">
  <tr><td>E-Mail-Adresse 1 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>E-Mail-Adresse 2 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>E-Mail-Adresse 3 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td align="center">'.tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE).'</td></tr>
  </table>
  </form>
  </p>');

define('TEXT_SUCCESS', 'Ihre Bestellung ist eingegangen und wird bearbeitet! Die Lieferung erfolgt innerhalb von ca. 2-5 Werktagen.');
define('TEXT_NOTIFY_PRODUCTS', 'Bitte benachrichtigen Sie mich &uuml;ber Aktuelles zu folgenden Produkten:');
define('TEXT_SEE_ORDERS', 'Sie k&ouml;nnen Ihre Bestellung(en) auf der Seite <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '"><u>\'Ihr Konto\'</a></u> jederzeit einsehen und sich dort auch Ihre <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>\'Bestell&uuml;bersicht\'</u></a> anzeigen lassen.');
define('TEXT_CONTACT_STORE_OWNER', 'Falls Sie Fragen bez&uuml;glich Ihrer Bestellung haben, wenden Sie sich an unseren <a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>Vertrieb</u></a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Wir danken Ihnen f&uuml;r Ihren Online-Einkauf!');

define('TABLE_HEADING_DOWNLOAD_DATE', 'herunterladen m&ouml;glich bis:');
define('TABLE_HEADING_DOWNLOAD_COUNT', 'max. Anz. Downloads');
define('HEADING_DOWNLOAD', 'Artikel herunterladen:');
define('FOOTER_DOWNLOAD', 'Sie k&ouml;nnen Ihre Artikel auch sp&auml;ter unter \'%s\' herunterladen');

define('BAD_FRIEND_EMAIL', 'Ungültige E-Mail');

define('MAIL_SENT', 'Eine E-Mail wurde an Ihre Kontakte mit den Rabatt-Code geschickt!');

define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s bietet einen Gutschein '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hallo ,

Ihre Freundin %s will %s Rabatt für Ihre Bestellungen bieten <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Nutzen Sie dieses Angebot in 48 Stunden gültig, indem Sie den folgenden Code "%s" bei der Bestellung.

Wenn Sie noch nicht Vertragspartei zu den privilegierten Kreis der Mitglieder '.STORE_NAME.', können Sie sich jetzt registrieren, indem Sie auf den folgenden Link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

Bis bald.
Jede Mannschaft '.STORE_NAME.'.
');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Sie haben bereits ein Papier, das an dieser Freund vor');
?>