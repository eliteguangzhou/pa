<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

define('TEXT_MAIN', 'Questa è una dimostrazione di negozio on-line, <b>i prodotti visualizzati non sono veramnete in vendita, non verranno ne spedidi ne fatturati</b>. Tutte le informazioni sui prodotti sono esposte col solo intento dimostrativo.<br><br>Se vuoi scaricare questo progetto di negozio on-line, o contribuire al progetto, visita <a href="http://oscommerce.com"><u>il sito di supporto</u></a>. Questo negozio è basato su <font color="#f0000"><b>' . PROJECT_VERSION . '</b></font>. Questa versione è stata tradotta da <a href="http://www.oscommerceitalia.com">osCommerceITalia</a>, comunità italiana di utenti e sviluppatori osCommerce.');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuovi prodotti per %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prodotti in arrivo');
define('TABLE_HEADING_DATE_EXPECTED', 'Data di arrivo');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vediamo cose c\'è qui');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modello');
  define('TABLE_HEADING_PRODUCTS', 'Nome prodotto');
  define('TABLE_HEADING_MANUFACTURER', 'Produttore');
  define('TABLE_HEADING_QUANTITY', 'Quantità');
  define('TABLE_HEADING_PRICE', 'Prezzo');
  define('TABLE_HEADING_WEIGHT', 'Dimensioni');
  define('TABLE_HEADING_BUY_NOW', 'Acquista adesso');
  define('TEXT_NO_PRODUCTS', 'Non ci sono prodotti in questa categoria.');
  define('TEXT_NO_PRODUCTS2', 'Non ci sono prodotti per questo produttore.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Numero di prodotti: ');
  define('TEXT_SHOW', '<b>Mostra:</b>');
  define('TEXT_BUY', 'Acquista 1 \'');
  define('TEXT_NOW', '\' Ora');
  define('TEXT_ALL_CATEGORIES', 'Tutte le categoria');
  define('TEXT_ALL_MANUFACTURERS', 'Tutti i produttori');
  define('TEXT_PRICE_FROM', 'a partire da');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Da scoprire');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorie');
}

define('NEW_INTRO','<h2 style="font-size:17px;margin-bottom:10px;"><b>Fragranza DISCOUNT</b></h2>
Benvenuto al regno dei segreti dei profumi a piccoli prezzi !

Passeggiata nel profumo di <span class="text_rose">marquesla economici Francia !</span>
Non comprare senza confronto più !<span class="text_rose"> Vi rimborseremo la differenza !</span>

« <a class="text_rose" href="'.tep_href_link(FILENAME_ADVANTAGES).'">Scopri i nostri vantaggi</a> »

- <span class="text_rose">20.000 profumi e cosmetici</span> attualmente sul sito
- 500 marchi a -40%, -50%, -70%
- 3€, 8€, <span class="text_rose">15€ di sconto</span> offerte
- <span class="text_rose">Spedizione 3€</span> da 2 prodotti nel carrello
- 1 regalo <span class="text_rose">HUGO BOSS offerte</span> da 2 prodotti nel carrello
- Tutti i prodotti on-line sono <span class="text_rose">in magazzino</span>
- <span class="text_rose">Soddisfatti o rimborsati</span> 30 giorni
- Pagamento <span class="text_rose">Secure</span>');
?>
