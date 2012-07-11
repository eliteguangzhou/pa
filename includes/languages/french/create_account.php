<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Cr�er un compte');

define('HEADING_TITLE', 'Information de mon compte');


define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>REMARQUE:</b></small></font> Si vous avez d�j� un compte chez nous, veuillez vous connecter � la page d\'<a href="%s"><u>ouverture de session</u></a>.');

define('EMAIL_SUBJECT', 'Bienvenue sur ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. vnom,' . "\n\n");
define('EMAIL_GREET_MS', 'Cher Mme. vnom,' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher vnom' . "\n\n");

define('EMAIL_WELCOME', '
F�licitation ! Votre compte personnel est maintenant cr��.

Vous pouvez maintenant acheter nos parfums en cliquant sur : "ajoutez au panier"

Les informations pour acc�der � votre compte sont les suivantes :

Utilisateur: vloggin
Mot de pass�: vpass'. "\n\n");

define('EMAIL_TEXT', '');
define('EMAIL_CONTACT', 'Si vous avez besoin d�aide, merci de nous contacter par email � <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'" target="_blank">'.STORE_OWNER_EMAIL_ADDRESS.'</a> ou par t�l�phone de 9H � 12H du lundi au vendredi.

  Bonne visite,

  Equipe Service Client
  <a href="http://www.'.strtolower(STORE_NAME).'/" target="_blank">www.'.strtolower(STORE_NAME).'</a>');
  
define('EMAIL_WARNING', '<b><u>REMARQUE IMPORTANTE :</u></b>Vous recevez cet email car il fait suite � l\'inscription d\'un nouveau client dans notre boutique en ligne. Si vous ne vous �tes pas inscrit sur ' . STORE_NAME . ', merci de le signaler au gestionnaire de la boutique � cette adresse : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('ENTRY_EMAIL_ADDRESS_SPONSORSHIP_ERROR', 'L\'adresse de parrainage est diff�rente de celle que vous avez entr�e.');

define('SPONSORSHIP_GODFATHER', 'Votre parrain est : ');
define('SPONSORSHIP_GODFATHER_UNKNOWN', 'La cl� et l\'email entr�s ne correspondent � aucun parrainage.');
?>
