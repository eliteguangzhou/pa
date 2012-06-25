<?php
define('SPONSORSHIP_INTRODUCTION_TEXT', '2 bonnes raisons de parrainer vos amis !

1. C\'est simple !
Pour parrainer vos amis, il vous suffit d\'entrer leurs emails<sup>(1)</sup> dans les champs ci-dessous. Un email leur sera envoy� les informant de votre invitation.

2. Ca rapporte des euros !
'.STORE_NAME.' vous offre une r�mun�ration exceptionnelle d�clin�e sur 3 niveaux qui vous permet de gagner des euros<sup>(2)</sup> :

- %s sur les %s premi�res commandes de vos filleuls direct
- %s sur les %s premi�res commandes des filleuls de vos filleuls
- %s sur les %s premi�res commandes des filleuls de vos filleuls de vos filleuls

<img src="images/parrain_schema.gif" />

Vous pouvez parrainer jusqu\'� 100 filleuls et gagner jusqu\'� 700 euros de bons d\'achats sur vos filleuls directs et donc beaucoup plus avec les filleuls de vos filleuls etc.
Relancez les via l\'espace "Parrainage" dans votre compte pour multiplier vos gains !

Inscrivez vous vite chez '.STORE_NAME.' et profitez du parrainage pour gagner des euros !

<i><sup>(1)</sup> : Email qu\'ils devront utiliser lors de leur inscription chez '.STORE_NAME.'
<sup>(2)</sup> : Les gains r�alis�s seront �mis via des codes de r�ductions valables 1 an chez '.STORE_NAME.'
</i>');

define('SPONSORSHIP_TYPE_EMAILS', 'Saisissez les emails des amis que vous souhaitez parrainer :');
define('SPONSORSHIP_SUBMIT_BUTTON', 'Parrainer');

define('ENTRY_QUOTA_GODCHILD', 'Vous avez d�pass� votre quota de filleuls (%s restant(s))');

define('ENTRY_EMAIL_ERROR', 'L\'email suivant n\'est pas valide : <br />- %s');
define('ENTRY_EMAIL_ERRORS', 'Les emails suivants ne sont pas valides : <br />- %s');

define('ENTRY_STORED_EMAIL_ERROR', 'L\'email suivant est d�j� client '.STORE_NAME.' : <br />- %s');
define('ENTRY_STORED_EMAIL_ERRORS', 'Les emails suivants sont d�j� clients '.STORE_NAME.' : <br />- %s');

define('ENTRY_SPONSORED_EMAIL_ERROR', 'L\'email suivant est d�j� en attente de parrainage : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERRORS', 'Les emails suivants sont d�j� en attente de parrainage : <br />- %s');
define('SPONSORSHIP_TITLE', 'Parrainer un ami');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s souhaite vous faire d�couvrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s a eu envie de vous faire d�couvrir notre site <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> et nous en sommes tr�s heureux.

Nous sommes tr�s heureux de vous offrir %s de r�duction � valoir sur l\'une de vos commandes pour commencer sans plus attendre votre shopping sur <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette r�duction valable durant 1 mois en entrant le code suivant "%s" lors de votre commande.

Pour entrer � votre tour dans le cercle privil�gi� des membres de '.STORE_NAME.', il vous suffit d\'accepter l\'invitation de %s en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A tr�s bient�t nous l\'esp�rons.
Toute l\'�quipe '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'F�licitations !

Vos ami(e)s ont �t� averti(e)s par email de votre invitation.

Vous profiterez de bons de r�duction d�s leur premier achat, mais �galement lors des achats de leurs filleuls et de leurs petit-filleuls ! Ces bons de r�ductions vous seront transmis par email et seront �galement accessibles sur ce lien :

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">Mes r�ductions</a>

Vous pouvez �galement afficher le suivi de vos parrainages en cliquant sur le lien suivant :

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_list.php">Mes filleuls</a>

Cordialement,
Toute l\'�quipe '.STORE_NAME);
?>