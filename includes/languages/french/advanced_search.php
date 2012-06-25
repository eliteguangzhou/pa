<?php
/*
  $Id: advanced_search.php,v 1.15 2003/07/08 16:45:35 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Recherche avanc�e');
define('NAVBAR_TITLE_2', 'R�sultats de recherche');

define('HEADING_TITLE_1', 'Recherche avanc�e');
define('HEADING_TITLE_2', 'Produits r�pondant aux crit�res de recherche');

define('HEADING_SEARCH_CRITERIA', 'Crit�res de recherche');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Chercher dans les descriptions de produits');
define('ENTRY_CATEGORIES', 'Cat�gories:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Inclure les sous-cat�gories');
define('ENTRY_MANUFACTURERS', 'Fabricants :');
define('ENTRY_PRICE_FROM', 'Prix � partir de :');
define('ENTRY_PRICE_TO', 'Prix jusqu\'� :');
define('ENTRY_DATE_FROM', 'Depuis la date :');
define('ENTRY_DATE_TO', 'Jusqu\'� la date :');

define('TEXT_SEARCH_HELP_LINK', '<u>Aide � la recherche</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Toutes cat�gories');
define('TEXT_ALL_MANUFACTURERS', 'Tous fabricants');

define('HEADING_SEARCH_HELP', 'Aide � la recherche');
define('TEXT_SEARCH_HELP', 'Vous pouvez s�parer les mots cl�s par les op�rateurs logiques AND et OR. Par exemple, vous pouvez entrer <u>Microsoft AND souris</u>. Cette recherche vous affichera les r�sultats qui r�pondent simultan�ment aux deux crit�res. Toutefois, si vous tapez <u>souris OR clavier</u>, seront list�s les articles qui ont au moins l\'un des deux mots dans les champs s�lectionn�s. Si aucun op�rateur n\'est pr�cis�, la recherche s\'effectuera avec l\'op�rateur AND.<br><br>Vous pouvez �galement faire une recherche sur une chaine en l\'encadrant de guillements. Par exemple, une recherche sur  <u>"ordinateur portable"</u> vous affichera la liste de tous les articles ayant exactement cette chaine dans leur description.<br><br>Les parenth�ses peuvent �tre utilis�es pour contr&ocirc;ler l\'ordre de traitement des op�rateurs logiques. Par exemple entrez <u>Microsoft and clavier or souris or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Fermer la fen�tre</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Mod�le');
define('TABLE_HEADING_PRODUCTS', 'Nom du produit');
define('TABLE_HEADING_MANUFACTURER', 'Fabricant');
define('TABLE_HEADING_QUANTITY', 'Quantit�');
define('TABLE_HEADING_PRICE', 'Prix');
define('TABLE_HEADING_WEIGHT', 'Poids');
define('TABLE_HEADING_BUY_NOW', 'Acheter maintenant');

define('TEXT_NO_PRODUCTS', 'Il n\'y a aucun produit correspondant � vos crit�res de recherche.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Au moins un crit�re de recherche doit �tre rempli.');
define('ERROR_INVALID_FROM_DATE', 'Date du champ <u>Depuis la date<\/u> invalide.');
define('ERROR_INVALID_TO_DATE', 'Date du champ <u>Jusqu\'� la date<\/u>  invalide.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'La date du champ <u>Jusqu\'� la date<\/u> doit �tre sup�rieure ou �gale � la date du champ <u>Depuis la date<\/u>');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Le prix du champ <u>Prix � partir de<\/u> ne doit contenir que des chiffres.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Le prix du champ <u>Prix jusqu\'�<\/u> ne doit contenir que des chiffres.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Le prix du champ <u>Prix jusqu\'�<\/u> doit �tre sup�rieure ou �gale au prix du champ <u>Prix � partir de<\/u>.');
define('ERROR_INVALID_KEYWORDS', 'Mots-cl�s invalides.');
?>