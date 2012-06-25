<?php
/*
  $Id: login.php,v 1.14 2003/06/09 22:46:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Benevenuto, Accedi');

define('HEADING_NEW_CUSTOMER', 'Nuovo cliente su '.STORE_NAME.' ?');
define('TEXT_NEW_CUSTOMER', 'Fare clic sul pulsante “Continua” per creare un account.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Creando un account su '.STORE_NAME.', potrai acquistare più rapidamente e tracciare gli ordini.');

define('HEADING_RETURNING_CUSTOMER', 'Vecchio Cliente');
define('TEXT_RETURNING_CUSTOMER', 'Sono già stato vostro cliente.');

define('TEXT_PASSWORD_FORGOTTEN', 'Dimenticato la password? Clicca qui.');

define('TEXT_LOGIN_ERROR_IN_LOGIN', 'Questo indirizzo e-mail non è registrato sul nostro sito.');
define('TEXT_LOGIN_ERROR_IN_PASSWORD', 'La password non è valida per questo indirizzo e-mail.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Note:</b></font> Il contenuto del suo &quot;Carrello ospiti&quot; sarà inserito nel suo &quot;Carrello membri&quot; appena accederà tramite il suo account. <a href="javascript:session_win();">[Ulteriorio Informazioni Qui]</a>');

define('FROM_SPONSORSHIP', 'Per approfittare del sistema di sponsorizzazione, è necessario autenticarsi.

2 buoni motivi per sponsorizzare i tuoi amici!

1. È semplice!
Per sponsorizzare i vostri amici, basta inserire il proprio indirizzo email nei campi sottostanti. Una e-mail sarà inviata per informarli del vostro invito.

2. Esso riguarda l\'euro!
'.STORE_NAME.' offre una remunerazione eccezionale sceso su 3 livelli, che si può vincere Euro:

- %s sui primi %s ordini per dei figliocci diretti
- %s sui primi %s ordini per dei figliocci dei vostri figliocci
- %s sui primi %s ordini dei figliocci dei vostri figliocci dei vostri figliocci

<img src="images/parrain_schema.gif" />');
?>
