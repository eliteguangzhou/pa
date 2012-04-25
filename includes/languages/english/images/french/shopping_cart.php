<?php
/*
  $Id: shopping_cart.php,v 1.13 2002/04/05 20:24:02 project3000 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Contenu du panier');
define('HEADING_TITLE', 'Qu\'y a t\'il dans mon panier ?');
define('TABLE_HEADING_REMOVE', 'Supprimer');
define('TABLE_HEADING_QUANTITY', 'Qté.');
define('TABLE_HEADING_MODEL', 'Modèle');
define('TABLE_HEADING_PRODUCTS', 'Produit(s)');
define('TABLE_HEADING_TOTAL', 'Total');
define('TEXT_CART_EMPTY', 'Votre panier est vide ');
define('SUB_TITLE_SUB_TOTAL', 'Sous-Total :');
define('SUB_TITLE_TOTAL', 'Total :');
define('SUB_TITLE_FRAIS_PORT', 'Frais de port :');
define('SUB_TITLE_NB_PRODUCTS_DISCOUNT', 'Réduction :');
define('PROMO_NB', '<ul class="promo_nb promo_nb%s" id="promo_nb%s">Pour l\'achat de <span class="text_red">%s articles</span> :<li><span class="text_red">%s</span> de réduction offerts !</li></ul>');
define('PROMO_NB1', '<ul class="promo_nb promo_nb%s" id="promo_nb%s">Pour l\'achat de <span class="text_red">%s articles</span> :<li><span class="text_red">%s</span> de réduction offerts,</li><li><span class="text_red">Un gel douche</span> Hugo Boss offert,</li><li><span class="text_red">5 euros</span> de réduction sur vos frais de port !</li></ul>');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'Les produits marqués ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ne sont pas en stock dans la quantité désirée.<br>Merci de corriger la quantité des articles marqués (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '), Merci');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Les produits marqués avec ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' ne sont pas en stock dans la quantité désirée.<br>Vous pouvez néanmoins les acheter ils vous seront délivrés dès disponibilité.');

define('STR_GIFT', 'Votre cadeau offert');

define('TEXT_MIN_PRODUCTS1', '<span class="red">Vous devez ajouter deux produits dans votre panier pour pouvoir commander.</span>');
define('TEXT_MAX_PRODUCTS', '<span class="red">Vous avez atteint le nombre maximum de produits autorisés dans une commande.</span>');

define('SUB_TITLE_SUB_TOTAL_PRODUCTS', 'Total produits :');

define('TEXT_SUBSCRIBE', '<span class="red">Devenez membre ! <a href="'.tep_href_link(FILENAME_MEMBERS).'" class="red">Cliquez ici</a></span>');
define('TEXT_MIN_PRODUCTS2', '<span class="red">Vous devez ajouter un produit dans votre panier pour pouvoir commander.</span>');

define('USE_CODE', '');//'Pour profiter de la réduction de 15€, veuillez d\'abord ajouter une carte membre GOLD dans votre panier et entrez le code "<b>GOLD</b>" (sans les guillemets) dans le champ prévu à cet effet en haut de chaque page ou en dessous de votre panier.');
?>