<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Créer un compte');

define('HEADING_TITLE', 'Information de mon compte');


define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>REMARQUE:</b></small></font> Si vous avez déjà un compte chez nous, veuillez vous connecter à la page d\'<a href="%s"><u>ouverture de session</u></a>.');

define('EMAIL_SUBJECT', 'Bienvenue sur ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. vnom,' . "\n\n");
define('EMAIL_GREET_MS', 'Cher Mme. vnom,' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher vnom' . "\n\n");

define('EMAIL_WELCOME', '
Félicitation ! Votre compte personnel est maintenant créé.

Vous pouvez maintenant acheter nos parfums en cliquant sur : "ajoutez au panier"

Les informations pour accéder à votre compte sont les suivantes :

Utilisateur: vloggin
Mot de passé: vpass'. "\n\n");

define('EMAIL_TEXT', '');
define('EMAIL_CONTACT', 'Si vous avez besoin d’aide, merci de nous contacter par email à <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'" target="_blank">'.STORE_OWNER_EMAIL_ADDRESS.'</a> ou par téléphone de 9H à 12H du lundi au vendredi.

  Bonne visite,

  Equipe Service Client
  <a href="http://www.'.strtolower(STORE_NAME).'/" target="_blank">www.'.strtolower(STORE_NAME).'</a>');
  
define('EMAIL_WARNING', '<b><u>REMARQUE IMPORTANTE :</u></b>Vous recevez cet email car il fait suite à l\'inscription d\'un nouveau client dans notre boutique en ligne. Si vous ne vous êtes pas inscrit sur ' . STORE_NAME . ', merci de le signaler au gestionnaire de la boutique à cette adresse : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

define('ENTRY_EMAIL_ADDRESS_SPONSORSHIP_ERROR', 'L\'adresse de parrainage est différente de celle que vous avez entrée.');

define('SPONSORSHIP_GODFATHER', 'Votre parrain est : ');
define('SPONSORSHIP_GODFATHER_UNKNOWN', 'La clé et l\'email entrés ne correspondent à aucun parrainage.');
?>
