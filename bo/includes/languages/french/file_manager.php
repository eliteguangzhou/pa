<?php
/*
  $Id: file_manager.php,v 1.13 2002/08/19 01:45:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gestionnaire de fichiers');

define('TABLE_HEADING_FILENAME', 'Nom');
define('TABLE_HEADING_SIZE', 'Taille');
define('TABLE_HEADING_PERMISSIONS', 'Permissions');
define('TABLE_HEADING_USER', 'Utilisateur');
define('TABLE_HEADING_GROUP', 'Groupe');
define('TABLE_HEADING_LAST_MODIFIED', 'Derni�re modification');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_HEADING_UPLOAD', 'Transf�rer');
define('TEXT_FILE_NAME', 'Nom de fichier :');
define('TEXT_FILE_SIZE', 'Taille :');
define('TEXT_FILE_CONTENTS', 'Contenus :');
define('TEXT_LAST_MODIFIED', 'Derni�re modification :');
define('TEXT_NEW_FOLDER', 'Nouveau dossier');
define('TEXT_NEW_FOLDER_INTRO', 'Entrez le nom du nouveau dossier :');
define('TEXT_DELETE_INTRO', 'Etes vous sur de vouloir supprimer ce fichier ?');
define('TEXT_UPLOAD_INTRO', 'Merci de s�lectionner les fichiers � transf�rer.');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'Erreur : Impossible d\'�crire dans ce r�pertoire. Merci de v�rifier les droits d\'acc�s sur: %s');define('ERROR_FILE_NOT_WRITEABLE', 'Erreur : Impossible d\'�crire dans ce fichier. Merci de v�rifier les droits d\'acc�s sur : %s');
define('ERROR_DIRECTORY_NOT_REMOVEABLE', 'Erreur : Impossible de supprimer ce r�pertoire. Merci de v�rifier les droits d\'acc�s sur : %s');
define('ERROR_FILE_NOT_REMOVEABLE', 'Erreur : Impossible de supprimer ce fichier. Merci de v�rifier les droits d\'acc�s sur : %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'Erreur : Le r�pertoire n\'existe pas : %s');
?>