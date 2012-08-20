<?php
/*
  $Id: currencies.php,v 1.12 2003/06/25 20:36:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Devises');

define('TABLE_HEADING_CURRENCY_NAME', 'Devise');
define('TABLE_HEADING_CURRENCY_CODES', 'Code');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valeur');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_EDIT_INTRO', 'Merci de faire les changements n�cessaires');
define('TEXT_INFO_CURRENCY_TITLE', 'Titre :');
define('TEXT_INFO_CURRENCY_CODE', 'Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbole gauche :');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbole droit :');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Point d�cimal :');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'S�parateur de milliers :');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Nombre de d�cimales :');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Derni�re mise � jour :');
define('TEXT_INFO_CURRENCY_VALUE', 'Valeur :');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Exemple de sortie :');
define('TEXT_INFO_INSERT_INTRO', 'Merci de rentrer la nouvelle devise avec ces don�es li�es');
define('TEXT_INFO_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette devise ?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nouvelle devise');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editer devise');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Supprimer devise');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (Requiert une mise � jour manuelle de la valeur de la devise)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Le taux de change pour %s (%s) a �t� mis � jour avec succ�s par l\'interm�diaire de %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Erreur : La devise par d�faut ne peut �tre supprim�e. Merci de choisir une autre devise par d�faut et de r�essayer.');
define('ERROR_CURRENCY_INVALID', 'Erreur : Le taux de change pour %s (%s) n\'a pas �t� mis � jour par l\'interm�diaire de %s. S\'agit t\'il d\'un code devise valide ?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Attention : Le serveur de taux de change primaire (%s) a echou� %s (%s) - essayer avec le serveur de taux de change secondaire.');
?>