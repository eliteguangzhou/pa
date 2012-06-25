<?php
/*
  $Id: faq.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'FAQ');
define('HEADING_TITLE', 'FAQ');

define('TEXT_INFORMATION', '<font size="3"><b>• Passer une commande</b></font></p>
<p>C&#39;est votre premier achat sur
'.STORE_NAME.' ? <br>

 <br>
Nous vous souhaitons la Bienvenue et nous vous invitons à suivre les
étapes suivantes : </font></p>
<ol type="1">
  <li>Choisissez les articles
  que vous souhaitez acheter</li>
  <li>Ajoutez vos produits
  à votre panier en cliquant sur &quot; AJOUTER &quot;</li>
  <li>Lorsque vous avez
  ajouté tous vos articles à votre panier, il ne vous reste plus qu&#39;à
  cliquer sur</li>

  <li>&quot; COMMANDER&quot;. Si vous souhaitez ajouter d&#39;autres articles, cliquez
  sur &quot; Continuer mes achats &quot; </li>
  <li>Identifiez-vous.
  Pour plus de sécurité, un mot de passe et votre email vous seront
  demandés. </li>
  <li>Choisissez votre
  adresse de facturation et votre adresse de livraison</li>
</ol>
 <br>

<p>Nous vous remercions d&#39;indiquer
très précisément le nom de votre commune ainsi que votre code postal. </p>
<p>Veillez à bien orthographier
le nom de la ville de livraison : les abréviations, fautes d&#39;orthographe
et autres coquilles peuvent parfois entraîner des erreurs dans cette
rubrique. <br></p>
<p> </font><a name="0.5_BM2"></a><font size="3"><b>•
Mode de paiement</b></font> <br></p>
<p><b><u>Par carte bancaire</u></b>,
c&#39;est facile, rapide et sécurisé ! <br></p>
<p>Le paiement par carte bancaire
est un moyen <b>simple</b>, <b>rapide</b> et <b>sécurisé</b> pour
acheter en ligne. <br></p>

<p>•Nous acceptons les cartes <b>
VISA</b>,  <b>MASTER CARD</b>. <br></p>
<p>Nous vous garantissons une <b>
sécurité maximale</b>. <br></p>
<p>La transaction sera réalisée
de façon sécurisée par le biais du service de paiement de paypal. <br>
Toutes les données bancaires saisies (numéro de carte, cryptogramme
et date d&#39;expiration de votre carte) lors de votre paiement par carte
bancaire sont immédiatement cryptées grâce au protocole SSL et enregistrées
sur le serveur de paiement paypal.<br></p>

<p>• Aucune données de paiement
ne sont stockées sur le site <a href="http://'.strtolower(STORE_NAME).'" target="_blank">'.strtolower(STORE_NAME).'</a>, évitant toute possibilité
de fraude par piratage du site <a href="http://'.strtolower(STORE_NAME).'" target="_blank">'.strtolower(STORE_NAME).'</a> .  <br>
</p>
<p><font size="3"><b>Condition
de livraison</b></font></p>
<p>'.STORE_NAME.' livre votre
commande à l&#39;adresse de votre choix dans le monde entier (80 pays).</p>
<p><font size="3"><b>• Coût et délais de
livraison</b></font></p>
<p>    Les frais
de transport s’élèvent à <b><u>8,00 Euros</u></b> et ce peu importe
le nombre de colis inclus dans votre commande.</p>

<p>Le délai généralement constaté
entre le moment de la passation de commande, la préparation des commandes
et la réception des colis est de 8 à 12 jours ouvrables.</font></p>
<p><font size="3"><b>•
Annuler ou modifier une commande</b></font></p>
<p>Avant de valider une commande,
vous pouvez vérifier le contenu et le montant total de votre panier.
Une fois la commande prise en compte, il nous est impossible d&#39;annuler
ou de modifier votre commande.</p>
<p>Nous vous imposons cette réactivité
pour vous permettre de recevoir vos produits dans les délais les plus
courts. <br>
 <br>
'.STORE_NAME.' n&#39;est pas en mesure de modifier le contenu de votre
commande ni les informations liées à l&#39;adresse de livraison, dès
lors que votre commande a été validée par vos soins.</font></p>
<p></a><font size="3"><b>
Confirmation de commande </b></font></p>

<p>Après avoir passé commande
sur <a href="http://www.'.strtolower(STORE_NAME).'" target="_blank">www.'.strtolower(STORE_NAME).'</a> vous recevrez un e-mail en récapitulant
le détail. <br>
 <br>
Il indique votre numéro de commande (le numéro qui s&#39;est affiché
sur le site lorsque la commande a été acceptée), le détail des produits
commandés et les prix correspondants. Le cas échéant, les bons promotionnels,
vos adresses de livraison et de facturation ainsi que le mode d&#39;expédition
choisi y figurent également.</p>
<p><font size="3"><b>• Suivre
ma commande</b></font></p>
<p>Vous pouvez suivre votre commande
sur notre site grâce à votre numéro de commande figurant dans votre
e-mail de confirmation d&#39;expédition.  <br>
</p>

<p><font size="3"><b>Codes
promotionnels </b></font></p>
<p><b>Codes Promotionnels</b> <br>
Pour bénéficier d&#39;une promotion, il vous suffit <b><u>de
saisir le code </u></b> correspondant dans l&#39;étape Paiement. Ces offres
impliquent parfois un montant minimum d&#39;achat (hors frais de livraison).
Si cette promotion a bien été prise en compte, l&#39;offre promotionnelle
apparaîtra dans votre panier de commande </p>
<p><a name="0.5_BM12"></a><font size="3"><b>• Garantie
sécurité</b></font></p>
<p><a href="http://www.'.strtolower(STORE_NAME).'/" target="_blank"><u>www.'.strtolower(STORE_NAME).'</u></a> vous offre toutes les garanties de
sécurité et de confidentialité de vos informations tant bancaires
que personnelles. <br>

 <br>
<i><u>LE CRYPTAGE</u></i> <br>
Toutes vos données bancaires (numéro de carte, date de validité,
et cryptogramme) sont immédiatement cryptées et protégées par un
système sécurisé. <br>
Aucune coordonnée bancaire vous concernant n&#39;est stockée sur le site
<a href="http://'.strtolower(STORE_NAME).'" target="_blank">'.strtolower(STORE_NAME).'</a>. <br>
 <br>
<font size="3"><b>• Email de confirmation
d&#39;expédition </b></font></p>

<p>Après le traitement et l&#39;expédition
de votre commande, vous recevrez un e-mail. Celui-ci indique votre numéro
de commande (le numéro qui s&#39;est affiché sur le site lorsque la commande
a été acceptée), le numéro de tracking ,votre numéro client, le
détail des produits commandés et les prix correspondants. <br>
</p>
<p><font size="3"><b>• Remboursement des produits</b></font></p>
<p>Le remboursement du ou des
produits sera effectué dans un délai  de 90 jours maximum à compter
de la date litige constaté. Le remboursement s&#39;effectue selon le mode
de paiement utilisé lors de la commande à l&#39;adresse de facturation
de la commande. ');
?>
