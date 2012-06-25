<?php
define('FRIEND_DISCOUNT_TITLE', 'Coupons de r�ductions pour 3 de vos amis !');
define('FRIEND_DISCOUNT_INTRO', 'Faites profitez vos connaissances d\'un bon de r�duction d\'une valeur de %s en entrant leurs emails dans les champs suivants :<br />');
define('ERROR_BAD_ORDER', 'Commande invalide ou d�j� trait�e');
define('ERROR_BAD_FRIEND_EMAIL', 'Email invalide');
define('ERROR_ALREADY_FRIEND_EMAIL', 'Cet ami a d�j� profit� d\'une r�duction pour cette commande');
define('ERROR_MAX_FRIENDS', 'Vous avez atteint le nombre maximal de r�ductions autoris�es pour cette commande');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Vous avez d�j� envoy� un bon de r�duction � cet(te) ami(e) auparavant');
define('ERROR_MAX_FRIENDS_REACHED', 'Vous avez d�pass� le nombre maximal de r�ductions autoris�es pour cette commande (%s restant(s))');
define('MAIL_SENT', 'Un email a �t� envoy� � vos contacts avec le code de r�duction !');


define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vous offre un bon de r�duction '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s souhaite vous offrir %s de r�duction � valoir sur l\'une de vos commandes <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette r�duction valable durant 48h en entrant le code suivant "%s" lors de votre commande.

Si vous ne faites pas encore parti du cercle privil�gi� des membres de '.STORE_NAME.', vous pouvez d�s � pr�sent vous inscrire en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

A tr�s bient�t nous l\'esp�rons.
Toute l\'�quipe '.STORE_NAME.'. ');
?>