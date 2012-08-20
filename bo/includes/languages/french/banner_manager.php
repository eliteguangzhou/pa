<?php
/*
  $Id: banner_manager.php,v 1.17 2002/08/18 18:54:47 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gestionnaire de banni�res');

define('TABLE_HEADING_BANNERS', 'Banni�res');
define('TABLE_HEADING_GROUPS', 'Groupes');
define('TABLE_HEADING_STATISTICS', 'Affichages / Clics');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_BANNERS_TITLE', 'Titre de la banni�re :');
define('TEXT_BANNERS_URL', 'URL banni�re :');
define('TEXT_BANNERS_GROUP', 'Dimension de la banni�re :');
define('TEXT_BANNERS_NEW_GROUP', ', ou entrez une nouvelle dimension de la banni�re ci-dessous');
define('TEXT_BANNERS_IMAGE', 'Image :');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou sp�cifiez un fichier local ci-dessous');
define('TEXT_BANNERS_IMAGE_TARGET', 'Cible de l\'image (Sauvegarder dans) :');
define('TEXT_BANNERS_HTML_TEXT', 'Texte HTML :');
define('TEXT_BANNERS_EXPIRES_ON', 'Expire le :');
define('TEXT_BANNERS_OR_AT', ', ou �');
define('TEXT_BANNERS_IMPRESSIONS', 'Impressions/Vues.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Planifi� le :');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Remarque sur la banni�re :</b><ul><li>Utilisez une image ou du texte HTML pour la banni�re mais pas les deux.</li><li>Le texte HTML a priorit� sur l\'image</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Remarque sur l\'image :</b><ul><li>Le r�pertoire de destination lors du transfert doit avoir les bonnes permissions (�criture) sur le serveur!</li><li>Ne remplissez pas la cible de l\'image (\'Sauvegarder dans\') si vous ne transf�rez pas d\'image sur le serveur web (dans le cas o� vous utilisez une image d�ja pr�sente sur celui-ci).</li><li>La cible de l\'image (\'Sauvegarder dans\') doit pointer sur un r�pertoire existant et le slash de fin doit �tre pr�sent (ex., banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Remarque sur l\'expiration :</b><ul><li>Seul un des 2 champs doit �tre saisi.</li><li>Pour laisser la banni�re active, sans expiration automatique, laisser ces champs vides.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Remarque sur la planification :</b><ul><li>Si la date de planification est pr�cis�e, la banni�re sera activ�e seulement � partir de cette date.</li><li>Toutes les banni�res planifi�es seront marqu�es inactives jusqu\'� ce que la date de planification soit atteinte. Elles seront alors actives.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Date d\'ajout :');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Planifi� �: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expire le : <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expire au bout de : <b>%s</b> affichages');
define('TEXT_BANNERS_STATUS_CHANGE', 'Changement du statut : %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Les 3 derniers jours');
define('TEXT_BANNERS_BANNER_VIEWS', 'Nombre d\'affichages');
define('TEXT_BANNERS_BANNER_CLICKS', 'Nombre de clics');

define('TEXT_INFO_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette banni�re ?');
define('TEXT_INFO_DELETE_IMAGE', 'Supprimer l\'image de la banni�re');

define('SUCCESS_BANNER_INSERTED', 'Success : La bani�re a �t� ins�r�e.');
define('SUCCESS_BANNER_UPDATED', 'Success : La bani�re a �t� mise � jour.');
define('SUCCESS_BANNER_REMOVED', 'Success : La bani�re a �t� supprim�e.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success : Le statut de la bani�re a �t� mis � jour.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erreur : Titre de bani�re requis.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erreur : Groupe de bani�re requis.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur : Le r�pertoire cible n\'existe pas: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur : Target directory is not writeable: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erreur : L\'image n\'existe pas.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erreur : L\'image ne peut pas �tre supprim�e.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erreur : Statut flag inconnu.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erreur : Le r�pertoire de banni�res n\'existe pas. Cr�er un r�pertoire \'graphs\' dans \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erreur : Le r�pertoire de banni�res n\'est pas autoris� en �criture.');
?>