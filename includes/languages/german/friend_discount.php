<?php
define('FRIEND_DISCOUNT_TITLE', 'Rabatt-Coupons f�r 3 Ihrer Freunde!');
define('FRIEND_DISCOUNT_INTRO', 'Genie�en Sie Ihr Wissen �ber einen Gutschein im Wert von %s, indem Sie ihre E-Mail in den folgenden Bereichen:<br />');
define('ERROR_BAD_ORDER', 'Auftrag ung�ltig oder bereits verarbeitet');
define('ERROR_BAD_FRIEND_EMAIL', 'Ung�ltige E-Mail');
define('ERROR_ALREADY_FRIEND_EMAIL', 'Dieser Freund hat bereits eine Erm��igung f�r diesen Auftrag profitiert');
define('ERROR_MAX_FRIENDS', 'Sie haben die maximale Anzahl der Schnitte f�r diesen Befehl erlaubt erreicht');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Vous avez d�j� envoy� un bon de r�duction � cet(te) ami(e) auparavant');
define('ERROR_MAX_FRIENDS_REACHED', 'Vous avez d�pass� le nombre maximal de r�ductions autoris�es pour cette commande (%s restant(s))');
define('MAIL_SENT', 'Eine E-Mail wurde an Ihre Kontakte mit den Rabatt-Code geschickt!');


define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vous bietet einen Gutschein '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hallo ,

Ihre Freundin %s will %s Rabatt f�r Ihre Bestellungen bieten <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Nutzen Sie dieses Angebot in 48 Stunden g�ltig, indem Sie den folgenden Code "%s" bei der Bestellung.

Wenn Sie noch nicht Vertragspartei zu den privilegierten Kreis der Mitglieder '.STORE_NAME.', k�nnen Sie sich jetzt registrieren, indem Sie auf den folgenden Link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

Bis bald.
Jede Mannschaft '.STORE_NAME.'.
');
?>