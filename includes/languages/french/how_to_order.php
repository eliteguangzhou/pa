<?php
/*
  $Id $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Comment commander ?');
define('NAVBAR_TITLE', 'Comment commander ?');
define('TEXT_INFORMATION','<br /><h2>Comment commander ?</h2>
<br />
Si vous n\'�tes pas encore client chez nous :<br>
<br />
- Cr�ez un compte client (<a href="'.tep_href_link(FILENAME_CREATE_ACCOUNT).'">cliquez ici</a>).<br>
- Choisissez une carte membre (<a href="'.tep_href_link(FILENAME_MEMBERS).'">cliquez ici</a>).<br>
- Effectuez le processus complet d\'achat de la carte.<br>
- La carte est virtuelle et s\'active directement apr�s le paiement.<br>
- Vous �tes � pr�sent membre de Parfumrama, vous pouvez commander !<br>
<br>
<br />
Si vous �tes client mais pas encore membre :<br>
<br />
- Veuillez vous authentifier (<a href="'.tep_href_link(FILENAME_LOGIN).'">cliquez ici</a>).<br />
- Choisissez une carte membre (<a href="'.tep_href_link(FILENAME_MEMBERS).'">cliquez ici</a>).<br>
- Effectuer le processus complet d\'achat de la carte.<br>
- La carte est virtuelle et s\'active directement apr�s le paiement.<br>
- Vous �tes � pr�sent membre de Parfumrama, vous pouvez commander !<br>
<br>
<br />
Si vous �tes membre :<br />
<br />
- Veuillez vous authentifier avec l\'email que vous avez utilis� lors de l\'achat de votre carte (<a href="'.tep_href_link(FILENAME_LOGIN).'">cliquez ici</a>).<br>
- Vous pouvez commander !<br>
<br />
<br>
<u><b>Notes importantes :</b></u> <br>
<br />
- Nos cartes sont des produits virtuels.<br>
- Nos cartes sont li�es a l\'email que vous utilisez lors de l\'achat de la carte. <br>
- Une fois l\'achat d\'une carte finalis�, celle-ci est automatiquement activ�e et vous pouvez directement proc�der a l\'achat de vos parfums.<br>
- Si vous poss�dez une carte, vous devez �tre authentifi� pour pouvoir �tre consid�r� comme membre de Parfumrama.<br>
- '.MIN_PRODUCTS.' parfums minimum par commande.<br />
- '.MAX_QTY_IN_CART.' parfums maximum par commande.<br />
')
?>