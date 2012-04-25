<?php
define('SPONSORSHIP_INTRODUCTION_TEXT', '2 buoni motivi per sponsorizzare i tuoi amici!

1. È semplice!
Per sponsorizzare i vostri amici, basta inserire il proprio indirizzo email<sup>(1)</sup> nei campi sottostanti. Una e-mail sarà inviata per informarli del vostro invito.

2. Esso riguarda l\'euro!
'.STORE_NAME.' offre una remunerazione eccezionale sceso su 3 livelli, che si può vincere Euro<sup>(2)</sup>:

- %s sui primi %s ordini per dei figliocci diretti
- %s sui primi %s ordini per dei figliocci dei vostri figliocci
- %s sui primi %s ordini dei figliocci dei vostri figliocci dei vostri figliocci

<img src="images/parrain_schema.gif" />

Potete patrocinare fino a 100 figliocci e guadagnare fino a 700 euro di buoni di acquisti sui vostri figliocci diretti e dunque molto più con i figliocci dei vostri figliocci ecc.
Rilanciate via lo spazio "Sponsorizzazione" nel vostro conto per moltiplicare i vostri guadagni!

Iscrivete rapidamente a '.STORE_NAME.' ed approfittate della Sponsorizzazione per guadagnare euro!

<i><sup>(1)</sup> : Email che dovranno utilizzare in occasione della loro iscrizione a '.STORE_NAME.'
<sup>(2)</sup> : I guadagni realizzati saranno emessi via codici di riduzioni valide 1 anno a '.STORE_NAME.'
</i>');

define('SPONSORSHIP_TYPE_EMAILS', 'Afferrate gli emails degli amici che desiderate patrocinare :');
define('SPONSORSHIP_SUBMIT_BUTTON', 'Sponsorizzazione');

define('ENTRY_QUOTA_GODCHILD', 'Avete superato la vostra quota di figliocci  (%s rimanati)');

define('ENTRY_EMAIL_ERROR', 'Questa email seguente non è valida  : <br />- %s');
define('ENTRY_EMAIL_ERRORS', 'Queste email seguenti non sono valide  : <br />- %s');

define('ENTRY_STORED_EMAIL_ERROR', 'Questa email seguente è già cliente '.STORE_NAME.' : <br />- %s');
define('ENTRY_STORED_EMAIL_ERRORS', 'Queste email seguenti sono già clienti '.STORE_NAME.' : <br />- %s');

define('ENTRY_SPONSORED_EMAIL_ERROR', 'Questa email seguente è già in attesa di sponsorizzazione  : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERRORS', 'Queste email seguenti sono già in attesa di sponsorizzazione : <br />- %s');
define('SPONSORSHIP_TITLE', 'Patrocinare un amico');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s souhaite vous faire découvrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Buongiorno ,

Il vostro amico %s ha avuto voglia di farvi scoprire il nostro sito <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> e ne siamo molto felici.

Siamo molto felici di offrirvi %s di riduzione da valere su una delle vostre ordinazioni per cominciare senza più attendere il vostro shopping su <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Approfittate di questa riduzione valida durante 1 mese che entra nel codice seguente "%s" in occasione della vostra ordinazione.

Per entrare al vostro giro nel cerchio privilegiato dei membri di '.STORE_NAME.', vi basta accettare l\'invito di %s premendo sul legame seguente:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

A molto presto lo speriamo.
Tutto il Team '.STORE_NAME.'.  ');

define('SPONSORSHIP_EMAIL_SENT', 'Congratulazioni!

Il vostro amico è stato informato da email del vostro invito.

Approfitterete di buoni di sconto fin dal loro primo acquisto, ma anche in occasione degli acquisti dei loro figliocci e dei loro piccolo-figliocci! Questi buoni di sconto vi saranno trasmessi da email e saranno anche accessibili su questo legame:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">Le mie riduzioni</a>

Potete anche pubblicare il seguito delle vostre garanzie premendo sul legame seguente:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_list.php">I miei figliocci</a>

Cordialmente,
Tutto il Team '.STORE_NAME);
?>