<?php
/*
  $Id: checkout_success.php,v 1.12 2003/04/15 17:47:42 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Commande');
define('NAVBAR_TITLE_2', 'Succ&egrave;s');

define('HEADING_TITLE', '<p><b>F&eacute;licitation !</b></p>
  <p>
  Votre commande nous a &eacute;t&eacute; correctement envoy&eacute;e. </p>
  <p>Si votre commande ne comporte aucune anomalie, vos produits vous seront livr&eacute;s dans 12 jours ouvrables.</p>

  <p>
  Une confirmation de commande a &eacute;t&eacute; envoy&eacute;e sur votre boite email. Si vous n\'avez rien re&ccedil;u d\'ici 10 minutes, vous pouvez acc&eacute;der &agrave; votre confirmation de commande avec ce lien :<br />
  <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
  </p>

  <p>
  Les vacances approchent, nous vous invitons &agrave; suivre l\'&eacute;tat de livraison de votre colis via le tracking mentionn&eacute; sur www.bpostinternational.com, en cas d\'absence, le colis reste en poste pendant une p&eacute;riode al&eacute;atoire de 5 &agrave; 15 jours, au dela de ce d&eacute;lai, votre colis nous sera retourn&eacute;.<br />
  Vous pouvez donner procuration &agrave; un ami ou &agrave; un voisin avec la copie de votre pi&egrave;ce d\'identit&eacute; pour &eacute;viter que votre colis nous soit retourn&eacute;.
  </p>
<br />');

define('HEADING_TITLE2', '<br />
  <p><b>
  Faites &eacute;galement profitez vos connaissances d\'un bon de r&eacute;duction d\'une valeur de %s en entrant leurs emails dans les champs suivants :</b><br />
  <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
  <table cellpadding="0" cellspacing="5" style="width:220px;">
  <tr><td>Adresse email 1 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Adresse email 2 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Adresse email 3 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td align="center">'.tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE).'</td></tr>
  </table>
  </form>
  </p>');

define('TEXT_NOTIFY_PRODUCTS', 'Veuillez m\'informer des mises &agrave; jour des produits que j\'ai choisis ci-dessous :');
define('TEXT_SEE_ORDERS', 'Vous pouvez voir l\'historique de votre commande en allant &agrave; la page <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mon compte\'</a> et en cliquant sur <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Historique\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Veuillez poser toutes les questions directement au <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">propri&eacute;taire du magasin</a>.');

define('TABLE_HEADING_COMMENTS', 'Ecrivez un commentaire pour la commande pass&eacute;e;');

define('TABLE_HEADING_DOWNLOAD_DATE', 'date d\'expiration : ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' t&eacute;l&eacute;chargements restant');
define('HEADING_DOWNLOAD', 'T&eacute;l&eacute;chargez vos produits ici :');
define('FOOTER_DOWNLOAD', 'Vous pouvez aussi t&eacute;l&eacute;charger vos produits plus tard &agrave; \'%s\'');

define('BAD_FRIEND_EMAIL', 'Email invalide');

define('MAIL_SENT', 'Un email a &eacute;t&eacute; envoy&eacute; &agrave; vos contacts avec le code de r&eacute;duction !');

define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vous offre un bon de r&eacute;duction '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s souhaite vous offrir %s de réduction à valoir sur l\'une de vos commandes <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette réduction valable durant 48h en entrant le code suivant "%s" lors de votre commande.

Si vous ne faites pas encore parti du cercle privilégié des membres de '.STORE_NAME.', vous pouvez dès à présent vous inscrire en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

A très bientot.
L\'équipe '.STORE_NAME.'.
Tél : 0970 465 068');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Vous avez d&eacute;j&agrave; envoy&eacute; un bon de r&eacute;duction &agrave; cet(te) ami(e) auparavant');
?>
