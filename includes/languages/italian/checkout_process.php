<?php
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Verifica ordine');
define('EMAIL_TEXT_ORDER_NUMBER', 'Ordine Numero:');
define('EMAIL_TEXT_NAME', 'Nome');
define('EMAIL_TEXT_PRICE', 'Prezzo');
define('EMAIL_TEXT_QTY', 'Quantità');
define('EMAIL_TEXT_TOTAL', 'Totale:    ');
define('EMAIL_TEXT_SUB_TOTAL', 'Subtotale');
define('EMAIL_TEXT_TAX', 'Tasse:        ');
define('EMAIL_TEXT_ORDER_TOTAL', 'Totale ordine');
define('EMAIL_TEXT_CONTENT_HIGH', 'Gentile %s,
<br><br>
Grazie per l\'ordine %s del %s
<br><br>
Se l\'ordine non presenta alcuna anomalia, i prodotti saranno consegnati fra 12 giorni.
<br><br>
Potrai verificare lo stato dell’ordine collegandoti al tuo account tra circa 72 h:
<br><br>
<a href=\"http://www.'.strtolower(STORE_NAME).'\">http://www.'.strtolower(STORE_NAME).'</a><br>
e-mail: %s<br>
Password: %s');
define('EMAIL_TEXT_CONTENT', 'Il tuo ordine è stato correttamente inviato.
<br><br>
Se l\'ordine non presenta alcuna anomalia, i prodotti saranno consegnati fra 12 giorni.');
define('EMAIL_TEXT_CONTENT_LESS', 'EMAIL_TEXT_CONTENT_HIG');
define('EMAIL_TEXT_TITRE', '<br><b>Votre commande</b><br>');
define('EMAIL_TEXT_INVOICE_URL', 'Dettagli fattura:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data Ordine:');
define('EMAIL_TEXT_PRODUCTS', 'Prodotti');
define('EMAIL_TEXT_SUBTOTAL', 'Sub-Totale:');
define('EMAIL_TEXT_SHIPPING', 'Spedizione: ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Indirizzo per la consegna');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Indirizzo di fatturazione');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Metodo di pagamento');
define('TEXT_EMAIL_VIA', 'via');
define('SPONSORSHIP_EMAIL_SUBJECT', 'Nuovo codice di sconto '.STORE_NAME.'');
define('SPONSORSHIP_EMAIL_TEXT', 'Ciao ,

Siamo lieti di inviarvi il seguente codice di sconto: "%s" valore %s valido %s mesi dopo l\'ordinazione il vostro %sfiglioccio %s.

È possibile accedere all\'elenco delle riduzioni di registrazione sul nostro sito utilizzando il seguente link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php</a>

Con i migliori saluti,
Tutto il Team '.STORE_NAME.'. ');
define('STR_GODCHILD_1', '');
define('STR_GODCHILD_2', 'piccolo ');
define('STR_GODCHILD_3', 'piccolo piccolo ');
define('EMAIL_TEXT_DISCOUNT_SUBJECT', 'Sconto del %s per gli amici !');
define('EMAIL_FRIEND_DISCOUNT', 'Ciao %s,

Segue l\'ordine, i tuoi amici con voi possono beneficiare di una riduzione di %s.

Fare clic senza indugio sul link qui sotto per inviare il tagliando ai tuoi amici:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s">http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s</a>

Con i migliori saluti,
Tutto il Team '.STORE_NAME.'.');
define('EMAIL_TEXT_SUBJECT_MEMBER', 'La tua iscrizione '.STORE_NAME.'');
define('EMAIL_MEMBER', '%s
<br /><br />
Voi siete ora parte dei membri del '.ucfirst($_SERVER['SERVER_NAME']).'.
<br />
L\'abbonamento scade il : %s
<br /><br />
A presto su '.ucfirst($_SERVER['SERVER_NAME']).'');
?>