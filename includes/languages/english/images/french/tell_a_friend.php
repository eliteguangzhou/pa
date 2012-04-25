<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Faire connaître à un ami(e)');

define('HEADING_TITLE', 'Faire connaître à un ami(e) à propos de \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vous');
define('FORM_TITLE_FRIEND_DETAILS', 'Votre ami(e)');
define('FORM_TITLE_FRIEND_MESSAGE', 'Votre message');

define('FORM_FIELD_CUSTOMER_NAME', 'Votre nom :');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Votre adresse électronique :');
define('FORM_FIELD_FRIEND_NAME', 'Le nom de votre ami(e) :');
define('FORM_FIELD_FRIEND_EMAIL', 'L\adresse électronqiue de votre ami(e) :');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Votre courrier électronique à propos de <b>%s</b> Ont été avec succès envoyé à <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Votre ami %s a recommandé ce produit de %s');
define('TEXT_EMAIL_INTRO', 'Hé %s !' . "\n\n" . 'Votre ami(e), %s, a pensé que vous seriez intéressés par %s de %s.');
define('TEXT_EMAIL_LINK', 'Pour voir le produit cliquez sur le lien ci-dessous ou copiez et collez le lien dans votre navigateur Internet :' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Amicalement,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Erreur : Votre nom d\'ami(e) ne doit pas être vide.');
define('ERROR_TO_ADDRESS', 'Erreur : L\'adresse électronique de votre ami(e) doit être une adresse électronique valide.');
define('ERROR_FROM_NAME', 'Erreur : Votre nom ne doit pas être vide.');
define('ERROR_FROM_ADDRESS', 'Erreur : Votre adresse électronique doit être une adresse électronique valide.');
?>