<?php

define('SPONSORSHIP_TITLE', 'Meine Patenkinder');
define('SPONSORSHIP_FIRSTNAME', 'Vorname');
define('SPONSORSHIP_LASTNAME', 'Name');
define('SPONSORSHIP_EMAIL', 'E-Mail');
define('SPONSORSHIP_SUBSCRIBED', 'Beitritt');
define('SPONSORSHIP_RETRY', 'Starten');
define('SPONSORSHIP_NO_GODCHILD', 'Nr. Patenkind');
define('SPONSORSHIP_YES', '<span style="color:green">Ja</span>');
define('SPONSORSHIP_NO', '<span style="color:red">Nein</span>');

define('SPONSORSHIP_RETRY_LATER', '1 Tag maximaler R�ckgewinnung');

define('SPONSORSHIP_EMAIL_ERROR', 'E-Mails zu einem Neustart sind nicht g�ltig.');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s m�chte, dass Sie zu entdecken '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Hallo ,

Ihr Freund wollte, Sie auf unserer Website <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> einzuf�hren und wir sind sehr gl�cklich.

Wir sind sehr erfreut zu %s Erm��igung auf Rechnung eines Ihrer Befehle bieten einen Vorsprung bei Ihren Eink�ufen <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> erhalten. Genie�en Sie diesen Vorzugspreis f�r 1 Monat nach der Eingabe des Codes "%s" bei der Bestellung.

Um die Wende in den Kreis der Privilegierten '.STORE_NAME.', Sie hierzu einfach die Einladung anzunehmen %s, indem Sie auf den unten stehenden Link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

Wir sehen uns hoffentlich bald.
Jede Mannschaft '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Ihre Freunde wurden per E-Mail wieder auf.');
?>