<?php
/*
  $Id: password_forgotten.php,v 1.8 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Ouverture session');
define('NAVBAR_TITLE_2', 'Mot de passe oubli�');

define('HEADING_TITLE', 'J\'ai oubli� mon mot de passe !');

define('TEXT_MAIN', 'Si vous avez oubli� votre mot de passe, entrez votre adresse �lectronique ci-dessous et nous vous enverrons un courrier �lectronique contenant votre nouveau mot de passe.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Erreur : L\'adresse �lectronique n\'a pas �t� trouv�e dans notre base, veuillez r�essayer. ');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', ' - Nouveau mot de passe'); //STORE_NAME . 
define('EMAIL_PASSWORD_REMINDER_BODY', 'Votre nouveau mot de passe sur est:' . "\n\n" . '   %s' . "\n\n");//\'' . STORE_NAME . '\' 

define('SUCCESS_PASSWORD_SENT', 'Succ�s : Un nouveau mot de passe a �t� envoy� � votre adresse �lectronique.');
?>