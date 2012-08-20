<?php
/*
  $Id: english.php,v 1.106 2003/06/20 00:18:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'fr_FR.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
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

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="fr"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Site officiel');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalogue en ligne');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');

// text for date of birth example
define('DOB_FORMAT_STRING', 'jj/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_MYSTORE', 'Mon magasin');
define('BOX_CONFIGURATION_LOGGING', 'Enregistrement');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrateurs');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Paiement');
define('BOX_MODULES_SHIPPING', 'Exp�dition');
define('BOX_MODULES_ORDER_TOTAL', 'Total commande');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalogue');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Cat�gories/Produits');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attributs produits');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricants');
define('BOX_CATALOG_REVIEWS', 'Critiques');
define('BOX_CATALOG_SPECIALS', 'Promotions');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produits en attente');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clients/Commandes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clients');
define('BOX_CUSTOMERS_ORDERS', 'Commandes');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Lieux / Taxes');
define('BOX_TAXES_COUNTRIES', 'Pays');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Zones fiscales');
define('BOX_TAXES_TAX_CLASSES', 'Classes fiscales');
define('BOX_TAXES_TAX_RATES', 'Taux fiscaux');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Rapports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produits les plus consult�s');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produits achet�s');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de commande clients');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Outils');
define('BOX_TOOLS_EXPORT', 'Export');
define('BOX_TOOLS_BACKUP', 'Sauvegarde de base de donn�es');
define('BOX_TOOLS_BANNER_MANAGER', 'Gestionnaire de banni�res');
define('BOX_TOOLS_CACHE', 'Contr&ocirc;le du cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'D�finissez langues');
define('BOX_TOOLS_FILE_MANAGER', 'Gestionnaire de fichiers');
define('BOX_TOOLS_MAIL', 'Envoyez un courrier �lectronique');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gestionnaire de bulletin d\'information');
define('BOX_TOOLS_SERVER_INFO', 'Renseignements sur serveur');
define('BOX_TOOLS_WHOS_ONLINE', 'Qui est en ligne');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localisation');
define('BOX_LOCALIZATION_CURRENCIES', 'Devises');
define('BOX_LOCALIZATION_LANGUAGES', 'Langues');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Statut des commandes');

// javascript messages
define('JS_ERROR', 'Des erreurs sont survenues durant le traitement de votre formulaire !\nMerci de faire les corrections suivantes :\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Le nouveau attribut produit necessite un prix\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Le nouveau attribut produit necessite un pr�fixe de prix\n');

define('JS_PRODUCTS_NAME', '*  Le nouveau produit necessite un nom\n');
define('JS_PRODUCTS_DESCRIPTION', '* Le nouveau produit necessite une description\n');
define('JS_PRODUCTS_PRICE', '* Le nouveau produit necessite un prix\n');
define('JS_PRODUCTS_WEIGHT', '* Le nouveau produit necessite un poids\n');
define('JS_PRODUCTS_QUANTITY', '* Le nouveau produit necessite une quantit�\n');
define('JS_PRODUCTS_MODEL', '* Le nouveau produit necessite un mod�le\n');
define('JS_PRODUCTS_IMAGE', '* Le nouveau produit necessite une image\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nouveau prix pour ce produit doit �tre fix�\n');

define('JS_GENDER', '* La valeur de \'Genre\' doit �tre choisie.\n');
define('JS_FIRST_NAME', '* L\'entr�e \'Pr�nom\' doit avoir au moins ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract�res.\n');
define('JS_LAST_NAME', '* L\'entr�e \'Nom\' doit avoir au moins ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract�res.\n');
define('JS_DOB', '* L\'entr�e \'Date de naissance\' doit avoir la forme: xx/xx/xxxx (10/09/1975).\n');
define('JS_EMAIL_ADDRESS', '* L\'entr�e \'Adresse �lectronique\' doit avoir au moins ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract�res.\n');
define('JS_ADDRESS', '* L\'entr�e \'Adresse\' doit avoir au moins ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract�res.\n');
define('JS_POST_CODE', '* L\'entr�e \'Code postal\' doit avoir au moins ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract�res.\n');
define('JS_CITY', '* L\'entr�e \'Ville\' doit avoir au moins ' . ENTRY_CITY_MIN_LENGTH . ' caract�res.\n');
define('JS_STATE', '* L\'entr�e \'Etat\' doit avoir �t� choisie.\n');
define('JS_STATE_SELECT', '-- Choisissez ci-dessus --');
define('JS_ZONE', '* L\'entr�e \'Etat\' doit �tre choisie parmi la liste pour ce pays.');
define('JS_COUNTRY', '* La valeur \'Pays\' doit �tre choisie.\n');
define('JS_TELEPHONE', '* L\'entr�e \'Num�ro de t�l�phone\' doit avoir au moins ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract�res.\n');
define('JS_PASSWORD', '* Les entr�es \'Mot de passe\' et \'Confirmation\' doivent avoir au moins ' . ENTRY_PASSWORD_MIN_LENGTH . ' caract�res.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Le num�ro de commande %s n\'existe pas !');

define('CATEGORY_PERSONAL', 'Donn�es personnelles');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Soci�t�');
define('CATEGORY_OPTIONS', 'Options');

define('ENTRY_GENDER', 'Genre :');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">requis</span>');
define('ENTRY_FIRST_NAME', 'Pr�nom :');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract.</span>');
define('ENTRY_LAST_NAME', 'Nom :');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract.</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance :');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 03/02/1961)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Adresse �lectronique :');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract.</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">L\'adresse �lectronique ne semble pas �tre valide!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Cette adresse �lectronique existe d�j�!</span>');
define('ENTRY_COMPANY', 'Nom de la soci�t� :');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adresse :');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract.</span>');
define('ENTRY_SUBURB', 'Compl�ment adresse :');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Code postal :');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract.</span>');
define('ENTRY_CITY', 'Ville :');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_CITY_MIN_LENGTH . ' caract.</span>');
define('ENTRY_STATE', 'Etat :');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">requis</span>');
define('ENTRY_COUNTRY', 'Pays :');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Num�ro de t�l�phone :');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract.</span>');
define('ENTRY_FAX_NUMBER', 'Num�ro de fax :');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Bulletin d\'informations :');
define('ENTRY_NEWSLETTER_YES', 'Abonn�');
define('ENTRY_NEWSLETTER_NO', 'Non abonn�');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Envoyer un courrier �lectronique');
define('IMAGE_BACK', 'Retour');
define('IMAGE_BACKUP', 'Sauvegarde');
define('IMAGE_CANCEL', 'Annuler');
define('IMAGE_CONFIRM', 'Confirmer');
define('IMAGE_COPY', 'Copier');
define('IMAGE_COPY_TO', 'Copier vers');
define('IMAGE_DETAILS', 'D�tails');
define('IMAGE_DELETE', 'Supprimer');
define('IMAGE_EDIT', 'Editer');
define('IMAGE_EMAIL', 'Courrier �lectronique');
define('IMAGE_FILE_MANAGER', 'Gestionnaire de fichiers');
define('IMAGE_ICON_STATUS_GREEN', 'Actif');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activer');
define('IMAGE_ICON_STATUS_RED', 'Inactif');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'D�sactiver');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Ins�rer');
define('IMAGE_LOCK', 'Verouilller');
define('IMAGE_MODULE_INSTALL', 'Installez le module');
define('IMAGE_MODULE_REMOVE', 'Supprimer le module');
define('IMAGE_MOVE', 'D�placer');
define('IMAGE_NEW_BANNER', 'Nouvelle banni�re');
define('IMAGE_NEW_CATEGORY', 'Nouvelle cat�gorie');
define('IMAGE_NEW_COUNTRY', 'Nouveau pays');
define('IMAGE_NEW_CURRENCY', 'Nouvelle devise');
define('IMAGE_NEW_FILE', 'Nouveau fichier');
define('IMAGE_NEW_FOLDER', 'Nouveau dossier');
define('IMAGE_NEW_LANGUAGE', 'Nouvelle Langue');
define('IMAGE_NEW_NEWSLETTER', 'Nouveau bulletin d\'informations');
define('IMAGE_NEW_PRODUCT', 'Nouveau Produit');
define('IMAGE_NEW_TAX_CLASS', 'Nouvelle classe fiscale');
define('IMAGE_NEW_TAX_RATE', 'Nouveau taux fiscal');
define('IMAGE_NEW_TAX_ZONE', 'Nouvelle zone fiscale');
define('IMAGE_NEW_ZONE', 'Nouvelle zone');
define('IMAGE_ORDERS', 'Commandes');
define('IMAGE_ORDERS_INVOICE', 'Facture');
define('IMAGE_ORDERS_PACKINGSLIP', 'Bon de Livraison');
define('IMAGE_PREVIEW', 'Pr�visualiser');
define('IMAGE_RESTORE', 'Restaurer');
define('IMAGE_RESET', 'R�initialiser');
define('IMAGE_SAVE', 'Sauvegarder');
define('IMAGE_SEARCH', 'rechercher');
define('IMAGE_SELECT', 'Choisir');
define('IMAGE_SEND', 'Envoyer');
define('IMAGE_SEND_EMAIL', 'Envoyer un courrier �lectronique');
define('IMAGE_UNLOCK', 'D�verrouiller');
define('IMAGE_UPDATE', 'Mettre � jour');
define('IMAGE_UPDATE_CURRENCIES', 'Mettre � jour le taux de change');
define('IMAGE_UPLOAD', 'Transf�rer');

define('ICON_CROSS', 'Faux');
define('ICON_CURRENT_FOLDER', 'Dossier courant');
define('ICON_DELETE', 'Supprimer');
define('ICON_ERROR', 'Erreur');
define('ICON_FILE', 'Fichier');
define('ICON_FILE_DOWNLOAD', 'T�l�charger');
define('ICON_FOLDER', 'Dossier');
define('ICON_LOCKED', 'Verrouill�');
define('ICON_PREVIOUS_LEVEL', 'Niveau pr�c�dent');
define('ICON_PREVIEW', 'Pr�visualiser');
define('ICON_STATISTICS', 'Statistiques');
define('ICON_SUCCESS', 'Succ�s');
define('ICON_TICK', 'Vrai');
define('ICON_UNLOCKED', 'D�verrouill�');
define('ICON_WARNING', 'Attention');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s sur %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> banni�res)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> pays)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> clients)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> devises)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> langues)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> fabricants)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> bulletins d\'informations)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> commandes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> statuts commandes)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> produits)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> produits en attente)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> critiques produit)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> produits en promotion)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> classes fiscales)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> zones fiscales)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> taux fiscal)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Affiche <b>%d</b> � <b>%d</b> (sur <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'd�faut');
define('TEXT_SET_DEFAULT', 'mettre par d�faut');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requis</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erreur : Il n\'y a actuellement aucune devise par d�faut. Veuillez en choisir une: Outils administration->Localisation->Devises');

define('TEXT_CACHE_CATEGORIES', 'Bo�te cat�gories');
define('TEXT_CACHE_MANUFACTURERS', 'Bo�te fabricants');
define('TEXT_CACHE_ALSO_PURCHASED', 'Module d\'achat suppl�mentaire');

define('TEXT_NONE', '--aucun--');
define('TEXT_TOP', 'Haut');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erreur : le chemin cible n\'existe pas.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erreur : Impossible d\'�crire dans le r�pertoire cible.');
define('ERROR_FILE_NOT_SAVED', 'Erreur : fichier transf�rer non sauvegard�.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erreur : type de fichier transf�r� non-permis.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succ�s : Le fichier transf�r� a �t� sauvegard� avec succ�s.');
define('WARNING_NO_FILE_UPLOADED', 'Attention : fichier non transf�r�.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Attention : transfert de fichier est d�sactiv&ea dans le fichier de configuration php.ini.');
?>
