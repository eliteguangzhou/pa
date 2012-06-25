<?php
define('FRIEND_DISCOUNT_TITLE', 'Buoni di riduzioni per 3 dei vostri amici  !');
define('FRIEND_DISCOUNT_INTRO', 'Fatte approfittate le vostre conoscenze di un buono di sconto di un valore di %s che entra nei loro emails nei campi seguenti: <br />');
define('ERROR_BAD_ORDER', 'Ordine non valido o già trattato');
define('ERROR_BAD_FRIEND_EMAIL', 'E-mail non valido');
define('ERROR_ALREADY_FRIEND_EMAIL', 'Questo amico ha già beneficiato di una riduzione per questo ordine');
define('ERROR_MAX_FRIENDS', 'Hai raggiunto il numero massimo consentito di tagli per questo comando');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Avete già inviato un buono di sconto a quest\'amico prima');
define('ERROR_MAX_FRIENDS_REACHED', 'Hai superato il numero massimo consentito di tagli di questo comando (%s rimanenti)');
define('MAIL_SENT', 'Una e-mail è stata inviata ai tuoi contatti con il codice di sconto !');


define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s vi offre un buono di sconto '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Buongiorno ,

Il vostro amico %s desidera offrirvi %s di riduzione da valere su una delle vostre ordinazioni <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Approfittate di questa riduzione valida che dura 48. che entra nel codice seguente "%s" in occasione della vostra ordinazione.

Se non avete fatto ancora parte del cerchio privilegiato dei membri di '.STORE_NAME.', potete d\'ora in poi apparire premendo sul legame seguente:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

A molto presto lo speriamo.
Tutto il team '.STORE_NAME.'. ');
?>