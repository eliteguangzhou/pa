<?php

define('SPONSORSHIP_TITLE', 'Mentore');
define('SPONSORSHIP_FIRSTNAME', 'Nome');
define('SPONSORSHIP_LASTNAME', 'Cognome');
define('SPONSORSHIP_EMAIL', 'E-mail');
define('SPONSORSHIP_SUBSCRIBED', 'Iscritto');
define('SPONSORSHIP_RETRY', 'Rilanciare');
define('SPONSORSHIP_NO_GODCHILD', 'Nessun figlioccio');
define('SPONSORSHIP_YES', '<span style="color:green">Sì</span>');
define('SPONSORSHIP_NO', '<span style="color:red">No</span>');

define('SPONSORSHIP_RETRY_LATER', '1 rilancio al giorno massimo');

define('SPONSORSHIP_EMAIL_ERROR', 'Emails da rilanciare non sono validi. ');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s desidera farvi scoprire '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Buongiorno ,

Il vostro amico %s ha avuto voglia di farvi scoprire il nostro sito <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> e ne siamo molto felici.

Siamo molto felici di offrirvi %s di riduzione da valere su una delle vostre ordinazioni per cominciare senza più attendere il vostro shopping su <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Approfittate di questa riduzione valida durante 1 mese che entra nel codice seguente "%s" in occasione della vostra ordinazione.

Per entrare al vostro giro nel cerchio privilegiato dei membri di '.STORE_NAME.', vi basta accettare l\'invito di %s premendo sul legame seguente:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A molto presto lo speriamo.
Tutto il Team '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'I vostri amici sono stati rilanciati da e-mail.');
?>