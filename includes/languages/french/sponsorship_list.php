<?php

define('SPONSORSHIP_TITLE', 'Mes filleuls');
define('SPONSORSHIP_FIRSTNAME', 'Prénom');
define('SPONSORSHIP_LASTNAME', 'Nom');
define('SPONSORSHIP_EMAIL', 'Email');
define('SPONSORSHIP_SUBSCRIBED', 'Inscrit');
define('SPONSORSHIP_RETRY', 'Relancer');
define('SPONSORSHIP_NO_GODCHILD', 'Aucun filleul');
define('SPONSORSHIP_YES', '<span style="color:green">Oui</span>');
define('SPONSORSHIP_NO', '<span style="color:red">Non</span>');

define('SPONSORSHIP_RETRY_LATER', '1 relance par jour maximum');

define('SPONSORSHIP_EMAIL_ERROR', 'Des emails à relancer ne sont pas valides.');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s souhaite vous faire découvrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Votre ami(e) %s a eu envie de vous faire découvrir notre site <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> et nous en sommes très heureux.

Nous sommes très heureux de vous offrir %s de réduction à valoir sur l\'une de vos commandes pour commencer sans plus attendre votre shopping sur <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Profitez de cette réduction valable durant 1 mois en entrant le code suivant "%s" lors de votre commande.

Pour entrer à votre tour dans le cercle privilégié des membres de '.STORE_NAME.', il vous suffit d\'accepter l\'invitation de %s en cliquant sur le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A très bientôt nous l\'espérons.
Toute l\'équipe '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Vos ami(e)s ont été relancé(e)s par email.');
?>