<?php
/*
  $Id: checkout_success.php,v 1.12 2003/04/15 17:47:42 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE_1', 'Acquista');
define('NAVBAR_TITLE_2', 'Successo');

define('HEADING_TITLE', '<p><b>Congratulazioni !</b></p>
  <p>
  Il tuo ordine è stato correttamente inviato. </p>
  <p>Se l\'ordine non presenta alcuna anomalia, i prodotti saranno consegnati fra 12 giorni.</p>

  <p>
  Una conferma d\'ordine è stata inviata alla tua casella di posta elettronica. Se non avete ricevuto nulla entro 10 minuti, è possibile accedere conferma d\'ordine con questo link:<br />
  <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
  </p>
<br /><br />
  <p><b>
  Si prega anche gustare la vostra conoscenza di un buono del valore di %s inserendo il proprio indirizzo email nei seguenti campi:</b><br />
  <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
  <table cellpadding="0" cellspacing="5" style="width:220px;">
  <tr><td>Indirizzo e-mail 1 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Indirizzo e-mail 2 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Indirizzo e-mail 3 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td align="center">'.tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE).'</td></tr>
  </table>
  </form>
  </p>');

define('TEXT_NOTIFY_PRODUCTS', 'Comunicami gli aggiornameti dei prototti che io ho selezionato sotto:');
define('TEXT_SEE_ORDERS', 'Puoi vedere la cronologia dei tuoi ordini dalla pagina <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Il mio account\'</a> e cliccando sopra <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Cronologia\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Comunica qualsiasi problema all\' <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">amministratore</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Grazie per aver acquistato on-line con noi!');

define('TABLE_HEADING_COMMENTS', 'Inserisci un commento per il procedimento di acquisto');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Data di scadenza: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' Downloads rimanenti.');
define('HEADING_DOWNLOAD', 'Scarica qui il tuo prodotto:');
define('FOOTER_DOWNLOAD', 'Tu puoi scaricare il tuo prodotto dopo le ore \'%s\'');

define('BAD_FRIEND_EMAIL', 'E-mail non valido');

define('MAIL_SENT', 'Una e-mail è stata inviata ai tuoi contatti con il codice di sconto !');

define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s offre una cedola '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Ciao ,

Tuo amico %s vuole offrire uno sconto del %s per conto di uno dei tuoi ordini <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Approfittare di questo sconto valido per 48 ore, inserendo il seguente codice  "%s" al momento dell\'ordine.

Se non sei ancora parte della cerchia privilegiata dei membri '.STORE_NAME.', È ora possibile registrarsi cliccando sul seguente link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

Ci vediamo presto.
Tutte il Team '.STORE_NAME.'.');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Hai già inviato una cedola a questo amico, prima.');
?>