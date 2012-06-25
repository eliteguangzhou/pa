<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Warenkorb');
define('HEADING_TITLE', 'Ihr Warenkorb enth&auml;lt :');
define('TABLE_HEADING_REMOVE', 'Entfernen');
define('TABLE_HEADING_QUANTITY', 'Anzahl');
define('TABLE_HEADING_MODEL', 'Artikelnr.');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TOTAL', 'Summe');
define('TEXT_CART_EMPTY', 'Sie haben noch nichts in Ihrem Warenkorb.');
define('SUB_TITLE_SUB_TOTAL', 'Zwischensumme:');
define('SUB_TITLE_TOTAL', 'Summe:');
define('SUB_TITLE_FRAIS_PORT', 'Versand :');
define('SUB_TITLE_NB_PRODUCTS_DISCOUNT', 'Ermäßigung:');
define('PROMO_NB', '<ul class="promo_nb promo_nb%s" id="promo_nb%s">Beim Kauf von <span class="text_red">%s articles</span> :<li><span class="text_red">%s</span> Rabatt angeboten !</li></ul>');
define('PROMO_NB1', '<ul class="promo_nb promo_nb%s" id="promo_nb%s">Beim Kauf von <span class="text_red">%s articles</span> :<li><span class="text_red">%s</span> Rabatt angeboten,</li><li><span class="text_red">Duschgel</span> Hugo Boss angeboten,</li><li><span class="text_red">5 euros</span> Rabatt auf ihren Versand !</li></ul>');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'Die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' markierten Produkte, sind leider nicht in der von Ihnen gew&uuml;nschten Menge auf Lager.<br>Bitte reduzieren Sie Ihre Bestellmenge f&uuml;r die gekennzeichneten Produkte, vielen Dank');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Die mit ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' markierten Produkte, sind leider nicht in der von Ihnen gew&uuml;nschten Menge auf Lager.<br>Die bestellte Menge wird kurzfristig von uns geliefert, wenn Sie es w&uuml;nschen nehmen wir auch eine Teillieferung vor.');

define('TEXT_ALTERNATIVE_CHECKOUT_METHODS', '- ODER -');

define('STR_GIFT', 'Ihr Geschenk');
?>