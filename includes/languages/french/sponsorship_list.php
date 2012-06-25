<?php

define('SPONSORSHIP_TITLE', 'Mes filleuls');
define('SPONSORSHIP_FIRSTNAME', 'Pr�nom');
define('SPONSORSHIP_LASTNAME', 'Nom');
define('SPONSORSHIP_EMAIL', 'Email');
define('SPONSORSHIP_SUBSCRIBED', 'Inscrit');
define('SPONSORSHIP_RETRY', 'Relancer');
define('SPONSORSHIP_NO_GODCHILD', 'Aucun filleul');
define('SPONSORSHIP_YES', '<span style="color:green">Oui</span>');
define('SPONSORSHIP_NO', '<span style="color:red">Non</span>');

define('SPONSORSHIP_RETRY_LATER', '1 relance par jour maximum');

define('SPONSORSHIP_EMAIL_ERROR', 'Des emails � relancer ne sont pas valides.');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s souhaite vous faire d�couvrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s a eu envie de vous faire d�couvrir notre site <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> et nous en sommes tr�s heureux.

Nous sommes tr�s heureux de vous offrir %s de r�duction � valoir sur l\'une de vos commandes pour commencer sans plus attendre votre shopping sur <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette r�duction valable durant 1 mois en entrant le code suivant "%s" lors de votre commande.

Pour entrer � votre tour dans le cercle privil�gi� des membres de '.STORE_NAME.', il vous suffit d\'accepter l\'invitation de %s en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A tr�s bient�t nous l\'esp�rons.
Toute l\'�quipe '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Vos ami(e)s ont �t� relanc�(e)s par email.');
?>