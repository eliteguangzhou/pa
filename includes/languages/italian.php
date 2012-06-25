<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'it_IT.ISO8859-1');


define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
} 

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="it"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crea account');
define('HEADER_TITLE_MY_ACCOUNT', 'Il mio account');
define('HEADER_TITLE_CART_CONTENTS', 'Cosa c\'è nel carrello');
define('HEADER_TITLE_CHECKOUT', 'Acquista');
define('HEADER_TITLE_TOP', 'Home Page');
define('HEADER_TITLE_CATALOG', 'Catalogo');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');
define('HEADER_NEW_DISCOUNT', '<a href="'.tep_href_link('sponsorship_discount.php').'" id="new_discount">Nuovo codice di sconto! Clicca qui!</a>');
define('HEADER_NEW_DISCOUNTS', '<a href="'.tep_href_link('sponsorship_discount.php').'" id="new_discount">Nuovi codici di sconto! Clicca qui!</a>');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'visite da');

// text for gender
define('MALE', 'Uomo');
define('FEMALE', 'Donna');
define('MALE_ADDRESS', 'Sig.');
define('FEMALE_ADDRESS', 'Sig.ra');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorie');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Produttori');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novità');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Ricerca veloce');
define('BOX_SEARCH_TEXT', 'Usa parole chiave per trovare il prodotto');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Ricerca avanzata');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Offerte');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Recensioni');
define('BOX_REVIEWS_WRITE_REVIEW', 'Scrivi una recensione su questo prodotto!');
define('BOX_REVIEWS_NO_REVIEWS', 'In questo momento non ci sono recensioni disponibili');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s su 5 Stelle!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Carrello spesa');
define('BOX_SHOPPING_CART_EMPTY', ' prodotti');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'I miei acquisti');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Più venduti');
define('BOX_HEADING_BESTSELLERS_IN', 'Più venduti fra(in)<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Comunicazioni');
define('BOX_NOTIFICATIONS_NOTIFY', 'Comunica gli aggiornamenti di<b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Non comunicare gli aggiornamenti di<b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Info sul produttore');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Altri prodotti');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Lingue');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Valute');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informazioni');
define('BOX_INFORMATION_PRIVACY', 'Privacy');
define('BOX_INFORMATION_CONDITIONS', 'Contratto di Vendita');
define('BOX_INFORMATION_SHIPPING', 'Spedizioni  e Consegna');
define('BOX_INFORMATION_CONTACT', 'Contattaci');
define('BOX_INFORMATION_ABOUT_US', 'Chi siamo');
define('BOX_INFORMATION_SHIPPING_DETAILS', 'Dati per la spedizione ');
define('BOX_INFORMATION_RETURNS', 'Resi');
define('BOX_INFORMATION_CANCEL', 'Annullamenti');
define('BOX_INFORMATION_TRACK', 'Controllo degli ordini');
define('BOX_INFORMATION_FAQ', 'Domande frequenti');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Dillo ad un amico');
define('BOX_TELL_A_FRIEND_TEXT', 'Invia questa pagina ad un amico.');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Invio Informazioni');
define('CHECKOUT_BAR_PAYMENT', 'Metodo di pagamento');
define('CHECKOUT_BAR_CONFIRMATION', 'Conferma');
define('CHECKOUT_BAR_FINISHED', 'Fine!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selezionare');
define('TYPE_BELOW', 'Inserire qui');

// javascript messages
define('JS_ERROR', 'Ci sono stati degli errori nella compilazione del modulo!\nEseguire le seguenti modifiche:\n\n');

define('JS_REVIEW_TEXT', '* Il testo delle \'Recensioni\' deve essere di almeno ' . REVIEW_TEXT_MIN_LENGTH . ' caratteri.\n');
define('JS_REVIEW_RATING', '* Devi votare il prodotto per recensirlo.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Seleziona un tipo di pagamento per il tuo acquisto.\n');

define('JS_ERROR_SUBMITTED', 'Questo modulo è già stato inviato. Premi ok e aspetta che termini il processo.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Seleziona un tipo di pagamento per il tuo acquisto.');

define('CATEGORY_COMPANY', 'Azienda');
define('CATEGORY_PERSONAL', 'Dettagli personali');
define('CATEGORY_ADDRESS', 'Indirizzo');
define('CATEGORY_CONTACT', 'Contatti');
define('CATEGORY_OPTIONS', 'Opzioni');
define('CATEGORY_PASSWORD', 'Password');

define('ENTRY_COMPANY', 'Nome dell\' azienda:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sesso:');
define('ENTRY_GENDER_ERROR', 'Campo \"Sesso\" Richiesto.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', 'Il campo \"Nome\" deve contentere minimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Cognome:');
define('ENTRY_LAST_NAME_ERROR', 'Il campo \"Cognome\" deve contenere minimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data di nascita:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'La \"Data di nascita\" deve essere inserita seguendo il formato MM/DD/YYYY (eg. 05/21/1970).');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Indirizzo E-Mail:');
define('ENTRY_EMAIL_ADDRESS_CONFIRM', 'Confermare l\'indirizzo e-mail:');
define('ENTRY_EMAIL_ADDRESS_CONFIRM_ERROR', 'L\'indirizzo e-mail di conferma è diverso dal tuo indirizzo e-mail.');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Il campo \"Indirizzo E-Mail\" deve contentere minimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Indirizzo email non valido - accertarsi e correggere.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Indirizzo email già contenuto nel nostro database - accedere con questo indirizzo oppure creare un account con un indirizzo differente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_EMAIL_ADDRESS_CONFIRM_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Indirizzo:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Il campo \"Indirizzo\" deve contentere minimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Frazione:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_DIGICODE', 'Codice d\'accesso :');
define('ENTRY_DIGICODE_TEXT', '');
define('ENTRY_POST_CODE', 'CAP:');
define('ENTRY_POST_CODE_ERROR', 'Il campo \"CAP\" deve contentere minimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caratteri.');
define('ENTRY_POST_CODE_ERROR2', 'Non consegniamo nel DOM-TOM.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Città:');
define('ENTRY_CITY_ERROR', 'Il campo \"Città\" deve contentere minimo ' . ENTRY_CITY_MIN_LENGTH . ' caratteri.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Stato/Provincia:');
define('ENTRY_STATE_ERROR', 'Il campo \"Stato/Provincia\" deve contentere minimo ' . ENTRY_STATE_MIN_LENGTH . ' caratteri.');
define('ENTRY_STATE_ERROR_SELECT', 'Seleziona uno Stato/Provincia del menù a scorrimento.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Nazione:');
define('ENTRY_COUNTRY_ERROR', 'Seleziona una Nazione del menù a scorrimento.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Numero di telefono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Il campo \"Numero di telefono\" deve contentere minimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caratteri.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Mi iscrivo');
define('ENTRY_NEWSLETTER_NO', 'Non mi iscrivo');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_ERROR', 'Il campo \"Password\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le Password \"Password\" e \"Conferma password\" inserite non corrispondono.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Conferma Password:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Password Attuale:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Il campo \"Password Attuale\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW', 'Nuova Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Il campo \"Nuova Password\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Le Password \"Password Attuale\" e \"Nuova Password\" inserite non corrispondono .');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Campi Richiesti');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina dei risultati:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> acquisti)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> recensioni)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> nuovi prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> offerte)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Prima pagina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Pagina precedente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pagina successiva');
define('PREVNEXT_TITLE_LAST_PAGE', 'Ultima pagina');
define('PREVNEXT_TITLE_PAGE_NO', 'Pagina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Precedenti  %d pagine');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Successive %d pagine');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRIMO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Precedente]');
define('PREVNEXT_BUTTON_NEXT', '[Successivo&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'ULTIMO&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Aggiungi indirizzo');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Indirizzo');
define('IMAGE_BUTTON_BACK', 'Indietro');
define('IMAGE_BUTTON_BUY_NOW', 'Compra Ora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambia indirizzo');
define('IMAGE_BUTTON_CHECKOUT', 'Acquista');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Conferma acquisto');
define('IMAGE_BUTTON_CONTINUE', 'Continua');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continua gli acquisti');
define('IMAGE_BUTTON_DELETE', 'Cancella');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Modifica account');
define('IMAGE_BUTTON_HISTORY', 'I miei acquisti');
define('IMAGE_BUTTON_LOGIN', 'Entra-login-');
define('IMAGE_BUTTON_IN_CART', 'Aggiungi al carrello');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Comunicazioni');
define('IMAGE_BUTTON_QUICK_FIND', 'Ricerca veloce');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Cancella comunicazioni');
define('IMAGE_BUTTON_REVIEWS', 'Recensioni');
define('IMAGE_BUTTON_SEARCH', 'Cerca');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Scegli spedizione');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dillo ad un amico');
define('IMAGE_BUTTON_UPDATE', 'Aggiorna');
define('IMAGE_BUTTON_UPDATE_CART', 'Aggiorna il carrello');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Scrivi una recensione');

define('SMALL_IMAGE_BUTTON_DELETE', 'Cancella');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modifica');
define('SMALL_IMAGE_BUTTON_VIEW', 'Visualizza');

define('ICON_ARROW_RIGHT', 'Altro');
define('ICON_CART', 'Nel carrello');
define('ICON_ERROR', 'Errore');
define('ICON_SUCCESS', 'Successo');
define('ICON_WARNING', 'Attenzione');

define('TEXT_GREETING_PERSONAL', 'Bentornato <span class="greetUser">%s!</span> Vuoi vedere i <a href="%s"><u>nouvi prodotti</u></a> che sono disponibili?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Se tu non sei %s, <a href="%s"><u>effettua il log-in</u></a> con i dati del tuo accout.</small>');
define('TEXT_GREETING_GUEST', 'Benvenuto <span class="greetUser">!</span> Puoi effettuare qui <a href="%s"><u>il log-in</u></a>? Oppure puoi creare qui <a href="%s"><u>un account</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Tipi di prodotti');
define('TEXT_DESCENDINGLY', 'in modo discendente');
define('TEXT_ASCENDINGLY', 'in modo ascendente');
define('TEXT_BY', ' di ');

define('TEXT_REVIEW_BY', 'da %s');
define('TEXT_REVIEW_WORD_COUNT', '%s vocaboli');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data di inserimento: %s');
define('TEXT_NO_REVIEWS', 'Non ci sono recensioni per questo prodotto.');

define('TEXT_NO_NEW_PRODUCTS', 'Non ci sono prodotti.');

define('TEXT_UNKNOWN_TAX_RATE', 'Tassa sconosciuta');

define('TEXT_REQUIRED', '<span class="errorText">Richiesto</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>ERRORE TEP:</small> Non è possibile inviare email, non è stato specificato SMTP server. Cerca php.ini e configura SMTP server.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Attenzione: La directory di installazione esiste in : ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Rimuovila per ragioni di sicurezza.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Attenzione: E\' possibile scrivere sul file di configurazione: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Questo è un rischio - configura tale file in sola lettura.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Attenzione: La directory che contiene la sessione non esiste: ' . tep_session_save_path() . '. La sessione non funzionerà finche non si corregge questo errore.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Attenzione: Non è possibile scrivere-lavorare sulla directory che contiene la sessione: ' . tep_session_save_path() . '. LA sessione non funzionerà finche non verrà corretto questo errore.');
define('WARNING_SESSION_AUTO_START', 'Attenzione: session.auto_start è abilitata - disabilitala nel file  php.ini e riavvia il web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Attenzione: La directory che contiene i download non esiste: ' . DIR_FS_DOWNLOAD . '. I download non funzioneranno finche non verrà corretto questo errore.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La data di scadenza della carta di credito non è corretta.<br>Controlla la data e riprova.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Il numero della carta di credito immesso è invalido.<br>Controlla il numero e riprova.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'I primi quattro numeri digitati sono: %s<br>Se questi numeri sono corretti, noi accettiamo la carta di credito.<br>Se non sono giusti, riprova.');

/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>');
define('Our_Best_Candles', 'Le nostre migliori candele');
define('Our_Best_P_Her', 'I migliori profumi da donna');
define('Our_Best_P_Him', 'I migliori profumi da uomo');
define('Skin_Care', 'I migliori trattamenti per la pelle');
define('Nos_meilleurs_coffrets_w', 'Le migliori confezioni da donna');
define('Nos_meilleurs_coffrets_m', 'Le migliori confezioni da uomo');
define('meilleurs_marques', 'Le migliori marche');
define('Nos_marques', 'Le nostre marche');
define('minimum_order',  '<div align="center"><img src="images/wholesaleonly.jpg"></div>');
define('BOX_SHOPPING_CART_MIN_ORDER', 'Commande minimum 150€');
define('HEADER_HELLO', 'Benvenuti');
define('HEADER_LOGIN', 'Identificazione');
define('HEADER_LOGOUT', 'Scollegamento');
define('CHOOSE_YOUR_CAT', 'Fare clic sulla categoria scelta: ');
define('CHOOSE_YOUR_BRAND', 'Fare clic sulla marca scelta: ');


define('TEXT_DISPLAY_NUMBER_OF_RANGES', 'Visualizzare i risultati da <b>%d</b> a <b>%d</b> (su <b>%d</b> line)');
define('TEXT_INSTEAD_OF', 'Anziché');
define('TEXT_EN_STOCK', '<span class="en_stock">In Stock</span>');

define('MENU_HOME', 'Casa');
define('MENU_FRAGRANCE_WOMEN', 'Profumi Donna');
define('MENU_FRAGRANCE_MEN', 'Profumi Uomo');
define('MENU_ALL_BRANDS', 'Tutte nostre marche');
define('MENU_MY_ACCOUNT', 'Il mio acconto');
define('MENU_CHRISTMAS', 'Speciale Natale');
define('MENU_MONTHLY', 'Speciale mese');
define('MENU_SPONSORSHIP', 'Sponsorizzazione');
define('MENU_CONTACT', 'Contatto');
define('MENU_FLASH', 'Flash Sale');
define('MENU_BECOME_MEMBER', 'Diventa un membro');

define('OTHERS_LIST_PRODUCTS', 'Altri prodotti della gamma');

$tmp = array(
'Mon' => 'Lunedi',
'Tue' => 'Martedì',
'Wed' => 'Mercoledì',
'Thu' => 'Giovedi',
'Fri' => 'Venerdì',
'Sat' => 'Sabato',
'Sun' => 'Domenica',
);
$tmp = $tmp[date('D')];
define('MENU_DAILY', 'Promozione del '.$tmp);

define('FOR_HIM', '<span class="for_him">Per Lui</span>');
define('FOR_HER', '<span class="for_her">Per Lei</span>');
define('FOR_UNISEX', '<span class="for_him">Uni</span><span class="for_her">sex</span>');
define('FOR_HIM_STR', 'Per Lui');
define('FOR_HER_STR', 'Per Lei');
define('FOR_UNISEX_STR', 'Unisex');
define('TEXT_SAVING', 'Salvare ');

define('PRICE_TIMER', 1.33);

//Cartes membres
define('CARD_NAME_CARD1', 'Abbonamento 6 mesi');
define('CARD_DESC_CARD1', 'Negozio al costo di 6 mesi !');
define('CARD_NAME_CARD2', 'Abbonamento 3 mesi');
define('CARD_DESC_CARD2', 'Negozio al costo di 3 mesi !');
define('CARD_NAME_CARD3', 'Abbonamento 12 mesi');
define('CARD_DESC_CARD3', 'Negozio al costo di 12 mesi !');

define('FREE_SHIPPING_TITLE', 'Dettaglio');
define('FREE_SHIPPING_DESCRIPTION', 'Procedere istantanea');

define('ABOUT_US_TITLE', 'Chi siamo');
define('IMAGE_BUTTON_TWO_PRODUCTS_MINIMUM', 'Almeno 2 prodotti');

define('MENU_TESTIMONY', 'Testimonianze');
define('MENU_CONCEPT', 'Concetto');
define('MENU_SAVINGS', 'Risparmia');
define('MENU_FAQ', 'Domande frequenti');
define('MENU_ADVANTAGES', 'I nostri vantaggi');
define('MENU_PRESSE', 'Tutta la stampa parla');

define('MEMBER_PRICE', 'Iscritto prezzo : ');

define('ERROR_TOO_FEW_ITEMS1', 'Si prega di aggiungere un prodotto al tuo carrello al fine di convalidare l\'ordine.');
define('ERROR_TOO_FEW_ITEMS2', 'Si prega di aggiungere due prodotti nel vostro carrello al fine di convalidare l\'ordine.');

define('SUB_TITLE_SUB_SPECIAL_DISCOUNT', 'Promozione nel mese di luglio:');
define('SPECIAL_DISCOUNT', get_promo('text').'<br />(off-board)');
define('SPECIAL_DISCOUNT_PAYPAL', get_promo('text').' (off-board)');

define('TEXT_MAIN_MEMBER', 'Per diventare un membro '.STORE_NAME.' e godere di tutti i vantaggi del Club, è sufficiente scegliere tra le nostre opzioni di abbonamento :');
define('MEMBER_CARD1', '<span class="bigger">- <span class="blue bold">Iscritto SAPHIR</span> : Tessera (validità '.$cards->list['card1']['duration'].' mesi) : <span class="red bold">'.$currencies->format($cards->list['card1']['price']).'</span></span>');
define('MEMBER_CARD2', '<span class="bigger">- <span class="red">Iscritto RUBIS</span> : Tessera '.$cards->list['card2']['duration'].' mesi : <span class="red bold">'.$currencies->format($cards->list['card2']['price']).'</span> (<span class="bold">-50% di risparmio</span>)</span>');
define('MEMBER_CARD3', '<span class="bigger">- <span class="gold bold">Iscritto GOLD</span> : Tessera (validità '.$cards->list['card3']['duration'].' mesi) : <span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span> <span class="bold small">('.$currencies->format(floor($cards->list['card3']['price'] / 12)).' al mese)</span></span>');
define('MEMBER_CARD31', '<span class="bold small">(-80% di risparmio)</span>');
define('TEXT_END', '<center><span class="bold">Nessun obbligo di acquisto</span><center>');

define('MENU_BONS_PLANS', 'Occasioni');
define('MENU_SELECTION', 'Prezzo Madness');
define('ALREADY_MEMBER', 'Già membro.');
define('ALREADY_HAVE_CARD', 'Hai già una carta nel carrello.');
define('YOUR_PROMO_CODE', 'Il tuo codice promozionale');

define('PRODUCTS_NOT_TOGETHER1', 'Occorre prima diventare un membro prima di acquistare.');
define('PRODUCTS_NOT_TOGETHER2', 'Non è possibile acquistare carte allo stesso tempo come prodotti');

define('BOX_INFORMATION_HOW_TO_ORDER', 'Come ordinare ?');

define('ERROR_MAX_DAILY_LIMIT', 'Si può ordinare solo '.(isset($is_member) && $is_member ? MAX_DAILY_LIMIT : MAX_DAILY_LIMIT_NOT_MEMBER).' prodotti al giorno');
define('ERROR_MAX_WEEKLY_LIMIT', 'È possibile ordinare per soli '.MAX_WEEKLY_LIMIT.'€ a settimana');

define('REDUCED_PRICE', 'Prezzo ridotto : ');

define('CONCEPT_INTRO','');

define('PAYEMENT_100_SECURE', '100% pagamento sicuro');

define('OUR_MARQUES','i marques');
?>