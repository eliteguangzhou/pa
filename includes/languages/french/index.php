<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('TABLE_HEADING_NEW_PRODUCTS', 'Nouveaux produits pour %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prochains produits');
define('TABLE_HEADING_DATE_EXPECTED', 'Date prévu');

if ( $category_depth == 'products' || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Voyons ce que nous avons ici');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modèle');
  define('TABLE_HEADING_PRODUCTS', 'Nom du produit ');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricant');
  define('TABLE_HEADING_QUANTITY', 'Quantité');
  define('TABLE_HEADING_PRICE', 'Prix');
  define('TABLE_HEADING_WEIGHT', 'Poids');
  define('TABLE_HEADING_BUY_NOW', 'Acheter maintenant');
  define('TEXT_NO_PRODUCTS', 'Il n\'y a aucun produit listé dans cette catégorie.');
  define('TEXT_NO_PRODUCTS2', 'Il n\'y a aucun produit disponible de ce fabricant.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Nombre de produits :');
  define('TEXT_SHOW', '<b>Afficher :</b>');
  define('TEXT_BUY', 'Acheter 1 \'');
  define('TEXT_NOW', '\' maintenant');
  define('TEXT_ALL_CATEGORIES', 'Toutes catégories');
  define('TEXT_ALL_MANUFACTURERS', 'Tous fabricants');
  define('TEXT_PRICE_FROM', 'à partir de');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'A découvrir...');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Catégories');
}

?>
