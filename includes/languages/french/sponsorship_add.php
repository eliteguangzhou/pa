<?php
define('SPONSORSHIP_INTRODUCTION_TEXT', '2 bonnes raisons de parrainer vos amis !

1. C\'est simple !
Pour parrainer vos amis, il vous suffit d\'entrer leurs emails<sup>(1)</sup> dans les champs ci-dessous. Un email leur sera envoyé les informant de votre invitation.

2. Ca rapporte des euros !
'.STORE_NAME.' vous offre une rémunération exceptionnelle déclinée sur 3 niveaux qui vous permet de gagner des euros<sup>(2)</sup> :

- %s sur les %s premières commandes de vos filleuls direct
- %s sur les %s premières commandes des filleuls de vos filleuls
- %s sur les %s premières commandes des filleuls de vos filleuls de vos filleuls

<img src="images/parrain_schema.gif" />

Vous pouvez parrainer jusqu\'à 100 filleuls et gagner jusqu\'à 700 euros de bons d\'achats sur vos filleuls directs et donc beaucoup plus avec les filleuls de vos filleuls etc.
Relancez les via l\'espace "Parrainage" dans votre compte pour multiplier vos gains !

Inscrivez vous vite chez '.STORE_NAME.' et profitez du parrainage pour gagner des euros !

<i><sup>(1)</sup> : Email qu\'ils devront utiliser lors de leur inscription chez '.STORE_NAME.'
<sup>(2)</sup> : Les gains réalisés seront émis via des codes de réductions valables 1 an chez '.STORE_NAME.'
</i>');

define('SPONSORSHIP_TYPE_EMAILS', 'Saisissez les emails des amis que vous souhaitez parrainer :');
define('SPONSORSHIP_SUBMIT_BUTTON', 'Parrainer');

define('ENTRY_QUOTA_GODCHILD', 'Vous avez dépassé votre quota de filleuls (%s restant(s))');

define('ENTRY_EMAIL_ERROR', 'L\'email suivant n\'est pas valide : <br />- %s');
define('ENTRY_EMAIL_ERRORS', 'Les emails suivants ne sont pas valides : <br />- %s');

define('ENTRY_STORED_EMAIL_ERROR', 'L\'email suivant est déjà client '.STORE_NAME.' : <br />- %s');
define('ENTRY_STORED_EMAIL_ERRORS', 'Les emails suivants sont déjà clients '.STORE_NAME.' : <br />- %s');

define('ENTRY_SPONSORED_EMAIL_ERROR', 'L\'email suivant est déjà en attente de parrainage : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERRORS', 'Les emails suivants sont déjà en attente de parrainage : <br />- %s');
define('SPONSORSHIP_TITLE', 'Parrainer un ami');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s souhaite vous faire découvrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s a eu envie de vous faire découvrir notre site <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> et nous en sommes très heureux.

Nous sommes très heureux de vous offrir %s de réduction à valoir sur l\'une de vos commandes pour commencer sans plus attendre votre shopping sur <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette réduction valable durant 1 mois en entrant le code suivant "%s" lors de votre commande.

Pour entrer à votre tour dans le cercle privilégié des membres de '.STORE_NAME.', il vous suffit d\'accepter l\'invitation de %s en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A très bientôt nous l\'espérons.
Toute l\'équipe '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Félicitations !

Vos ami(e)s ont été averti(e)s par email de votre invitation.

Vous profiterez de bons de réduction dès leur premier achat, mais également lors des achats de leurs filleuls et de leurs petit-filleuls ! Ces bons de réductions vous seront transmis par email et seront également accessibles sur ce lien :

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">Mes réductions</a>

Vous pouvez également afficher le suivi de vos parrainages en cliquant sur le lien suivant :

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_list.php">Mes filleuls</a>

Cordialement,
Toute l\'équipe '.STORE_NAME);
?>