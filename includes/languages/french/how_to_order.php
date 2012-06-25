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
Si vous n\'êtes pas encore client chez nous :<br>
<br />
- Créez un compte client (<a href="'.tep_href_link(FILENAME_CREATE_ACCOUNT).'">cliquez ici</a>).<br>
- Choisissez une carte membre (<a href="'.tep_href_link(FILENAME_MEMBERS).'">cliquez ici</a>).<br>
- Effectuez le processus complet d\'achat de la carte.<br>
- La carte est virtuelle et s\'active directement aprés le paiement.<br>
- Vous êtes à présent membre de Parfumrama, vous pouvez commander !<br>
<br>
<br />
Si vous êtes client mais pas encore membre :<br>
<br />
- Veuillez vous authentifier (<a href="'.tep_href_link(FILENAME_LOGIN).'">cliquez ici</a>).<br />
- Choisissez une carte membre (<a href="'.tep_href_link(FILENAME_MEMBERS).'">cliquez ici</a>).<br>
- Effectuer le processus complet d\'achat de la carte.<br>
- La carte est virtuelle et s\'active directement aprés le paiement.<br>
- Vous êtes à présent membre de Parfumrama, vous pouvez commander !<br>
<br>
<br />
Si vous êtes membre :<br />
<br />
- Veuillez vous authentifier avec l\'email que vous avez utilisé lors de l\'achat de votre carte (<a href="'.tep_href_link(FILENAME_LOGIN).'">cliquez ici</a>).<br>
- Vous pouvez commander !<br>
<br />
<br>
<u><b>Notes importantes :</b></u> <br>
<br />
- Nos cartes sont des produits virtuels.<br>
- Nos cartes sont liées a l\'email que vous utilisez lors de l\'achat de la carte. <br>
- Une fois l\'achat d\'une carte finalisé, celle-ci est automatiquement activée et vous pouvez directement procéder a l\'achat de vos parfums.<br>
- Si vous possédez une carte, vous devez être authentifié pour pouvoir être considéré comme membre de Parfumrama.<br>
- '.MIN_PRODUCTS.' parfums minimum par commande.<br />
- '.MAX_QTY_IN_CART.' parfums maximum par commande.<br />
')
?>