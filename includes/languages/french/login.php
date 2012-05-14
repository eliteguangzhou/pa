<?php
/*
  $Id: login.php,v 1.14 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Ouverture de session');
define('HEADING_TITLE', 'Bienvenue, ');

define('HEADING_NEW_CUSTOMER', 'Nouveau client');
define('TEXT_NEW_CUSTOMER', 'Vous &ecirc;tes nouveau client sur '.STORE_NAME.' ?');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Veuillez cliquer sur le bouton "Continuer" pour cr&eacute;er un compte. <br /><br />En cr&eacute;ant votre compte sur ' . STORE_NAME . ', vous pourrez faire vos achats plus rapidement et suivre vos commandes.');

define('HEADING_RETURNING_CUSTOMER', 'Vous avez d&eacute;j&agrave; un compte ?');
define('TEXT_RETURNING_CUSTOMER', 'Identifiez-vous pour y acc&egrave;der.  ');

define('TEXT_PASSWORD_FORGOTTEN', 'Vous avez oubli&eacute; votre mot de passe ? Cliquez ici.');

define('TEXT_LOGIN_ERROR_IN_LOGIN', 'Erreur : Cette adresse email n\'est pas enregistr&eacute;e sur notre site.');
define('TEXT_LOGIN_ERROR_IN_PASSWORD', 'Erreur : Le mot de passe n\'est pas valide pour cette adresse email.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>REMARQUE :</b></font> Le contenu de votre &quot;panier visiteurs&quot; sera ajout&eacute; &agrave; celui de votre &quot;panier membres&quot; d&eacute;s que vous aurez ouvert une session. <a href="javascript:session_win();">[Plus d\'info]</a>');

define('FROM_SPONSORSHIP', 'Pour profiter du syst&eacute;me de parrainage, vous devez vous authentifiez.

2 bonnes raisons de parrainer vos amis !

1. C\'est simple !
Pour parrainer vos amis, il vous suffit d\'entrer leurs emails dans les champs ci-dessous. Un email leur sera envoy&eacute; les informant de votre invitation.

2. Ca rapporte des euros !
'.STORE_NAME.' vous offre une r&egrave;mun&eacute;ration exceptionnelle d&eacute;clin&eacute;e sur 3 niveaux qui vous permet de gagner des euros :

- %s sur les %s premi&egrave;res commandes de vos filleuls direct
- %s sur les %s premi&egrave;res commandes des filleuls de vos filleuls
- %s sur les %s premi&egrave;res commandes des filleuls de vos filleuls de vos filleuls

<img src="images/parrain_schema.gif" />');
define('TEXT_LOGIN_ERROR_BLOCK','Votre compte a &eacute;t&eacute; bloqu&eacute;, veuillez contacter le service client.');
?>