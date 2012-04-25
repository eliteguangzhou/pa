<?php
/*
  $Id: checkout_success.php,v 1.12 2003/04/15 17:47:42 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Commande');
define('NAVBAR_TITLE_2', 'Succ�s');

define('HEADING_TITLE', '<p><b>F�licitation !</b></p>
  <p>
  Votre commande nous a �t� correctement envoy�e. </p>
  <p>Si votre commande ne comporte aucune anomalie, vos produits vous seront livr�s dans 12 jours ouvrables.</p>

  <p>
  Une confirmation de commande a �t� envoy�e sur votre bo�te email. Si vous n\'avez rien re�u d\'ici 10 minutes, vous pouvez acc�der � votre confirmation de commande avec ce lien :<br />
  <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
  </p>

  <p>
  Les vacances approchent, nous vous invitons � suivre l\'�tat de livraison de votre colis via le tracking mentionn� sur www.bpostinternational.com, en cas d\'absence, le colis reste en poste pendant une p�riode al�atoire de 5 � 15 jours, au dela de ce d�lai, votre colis nous sera retourn�.<br />
  Vous pouvez donner procuration � un ami ou � un voisin avec la copie de votre pi�ce d\'identit� pour �viter que votre colis nous soit retourn�.
  </p>');

define('TEXT_NOTIFY_PRODUCTS', 'Veuillez m\'informer des mises � jour des produits que j\'ai choisis ci-dessous :');
define('TEXT_SEE_ORDERS', 'Vous pouvez voir l\'historique de votre commande en allant � la page <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mon compte\'</a> et en cliquant sur <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Historique\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Veuillez poser toutes les questions directement au <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">propri�taire du magasin</a>.');

define('TABLE_HEADING_COMMENTS', 'Ecrivez un commentaire pour la commande pass�e;');

define('TABLE_HEADING_DOWNLOAD_DATE', 'date d\'expiration : ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' t�l�chargements restant');
define('HEADING_DOWNLOAD', 'T�l�chargez vos produits ici :');
define('FOOTER_DOWNLOAD', 'Vous pouvez aussi t�l�charger vos produits plus tard � \'%s\'');

define('BAD_FRIEND_EMAIL', 'Email invalide');

define('MAIL_SENT', 'Un email a �t� envoy� � vos contacts avec le code de r�duction !');

define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vous offre un bon de r�duction '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s souhaite vous offrir %s de r�duction � valoir sur l\'une de vos commandes <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette r�duction valable durant 48h en entrant le code suivant "%s" lors de votre commande.

Si vous ne faites pas encore parti du cercle privil�gi� des membres de '.STORE_NAME.', vous pouvez d�s � pr�sent vous inscrire en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

A tr�s bient�t.
L\'�quipe '.STORE_NAME.'.
T�l : 0970 465 068');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Vous avez d�j� envoy� un bon de r�duction � cet(te) ami(e) auparavant');
?>
