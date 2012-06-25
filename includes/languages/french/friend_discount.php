<?php
define('FRIEND_DISCOUNT_TITLE', 'Coupons de réductions pour 3 de vos amis !');
define('FRIEND_DISCOUNT_INTRO', 'Faites profitez vos connaissances d\'un bon de réduction d\'une valeur de %s en entrant leurs emails dans les champs suivants :<br />');
define('ERROR_BAD_ORDER', 'Commande invalide ou déjà traitée');
define('ERROR_BAD_FRIEND_EMAIL', 'Email invalide');
define('ERROR_ALREADY_FRIEND_EMAIL', 'Cet ami a déjà profité d\'une réduction pour cette commande');
define('ERROR_MAX_FRIENDS', 'Vous avez atteint le nombre maximal de réductions autorisées pour cette commande');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Vous avez déjà envoyé un bon de réduction à cet(te) ami(e) auparavant');
define('ERROR_MAX_FRIENDS_REACHED', 'Vous avez dépassé le nombre maximal de réductions autorisées pour cette commande (%s restant(s))');
define('MAIL_SENT', 'Un email a été envoyé à vos contacts avec le code de réduction !');


define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vous offre un bon de réduction '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s souhaite vous offrir %s de réduction à valoir sur l\'une de vos commandes <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette réduction valable durant 48h en entrant le code suivant "%s" lors de votre commande.

Si vous ne faites pas encore parti du cercle privilégié des membres de '.STORE_NAME.', vous pouvez dès à présent vous inscrire en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

A très bientôt nous l\'espérons.
Toute l\'équipe '.STORE_NAME.'. ');
?>