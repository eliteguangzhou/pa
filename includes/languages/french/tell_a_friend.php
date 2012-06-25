<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Faire conna�tre � un ami(e)');

define('HEADING_TITLE', 'Faire conna�tre � un ami(e) � propos de \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vous');
define('FORM_TITLE_FRIEND_DETAILS', 'Votre ami(e)');
define('FORM_TITLE_FRIEND_MESSAGE', 'Votre message');

define('FORM_FIELD_CUSTOMER_NAME', 'Votre nom :');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Votre adresse �lectronique :');
define('FORM_FIELD_FRIEND_NAME', 'Le nom de votre ami(e) :');
define('FORM_FIELD_FRIEND_EMAIL', 'L\adresse �lectronqiue de votre ami(e) :');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Votre courrier �lectronique � propos de <b>%s</b> Ont �t� avec succ�s envoy� � <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Votre ami %s a recommand� ce produit de %s');
define('TEXT_EMAIL_INTRO', 'H� %s !' . "\n\n" . 'Votre ami(e), %s, a pens� que vous seriez int�ress�s par %s de %s.');
define('TEXT_EMAIL_LINK', 'Pour voir le produit cliquez sur le lien ci-dessous ou copiez et collez le lien dans votre navigateur Internet :' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Amicalement,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Erreur : Votre nom d\'ami(e) ne doit pas �tre vide.');
define('ERROR_TO_ADDRESS', 'Erreur : L\'adresse �lectronique de votre ami(e) doit �tre une adresse �lectronique valide.');
define('ERROR_FROM_NAME', 'Erreur : Votre nom ne doit pas �tre vide.');
define('ERROR_FROM_ADDRESS', 'Erreur : Votre adresse �lectronique doit �tre une adresse �lectronique valide.');
?>