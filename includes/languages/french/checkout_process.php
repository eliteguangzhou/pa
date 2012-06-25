<?php
/*
  $Id: checkout_process.php,v 1.26 2002/11/01 04:22:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Traitement de la commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'Les vacances approchent, nous vous invitons à suivre l\'état de livraison de votre colis via le tracking mentionné sur www.bpostinternational.com, en cas d\'absence, le colis reste en poste pendant une période aléatoire de 5 à 15 jours, au dela de ce délai, votre colis nous sera retourné.<br />
Vous pouvez donner procuration à un ami ou à un voisin avec la copie de votre pièce d\'identité pour éviter que votre colis nous soit retourné.<br />
'.EMAIL_SEPARATOR."\n".'Numéro de commande :');

define('EMAIL_TEXT_NAME','Nom');
define('EMAIL_TEXT_PRICE','Prix');
define('EMAIL_TEXT_QTY','Quantité');
define('EMAIL_TEXT_TOTAL','Total');
define('EMAIL_TEXT_SUB_TOTAL','Sous-Total');
define('EMAIL_TEXT_TAX','TVA');
define('EMAIL_TEXT_ORDER_TOTAL','Total commande');



define('EMAIL_TEXT_CONTENT_HIGH','Cher(e) %s,
<br><br>
Merci pour votre commande %s du %s
<br><br>
Si votre commande ne comporte aucune anomalie, vos produits vous seront livrés dans 12 jours.
<br><br>
Vous pourrez vérifier le statut de votre commande en vous connectant sur votre compte dans les 72h :
<br><br>
<a href=\"http://www.'.strtolower(STORE_NAME).'\">http://www.'.strtolower(STORE_NAME).'</a><br>
e-mail: %s<br>
Password: %s');
define('EMAIL_TEXT_CONTENT', 'Votre commande nous a été correctement envoyée.
<br><br>
Si votre commande ne comporte aucune anomalie, vos produits vous seront livrés dans 12 jours.
<br /><br />
Les vacances approchent, nous vous invitons à suivre l\'état de livraison de votre colis via le tracking mentionné sur www.bpostinternational.com, en cas d absence, le colis reste en poste pendant une période aléatoire de 5 à 15 jours, au dela de ce délai, votre colis nous sera retourné.<br />
Vous pouvez donner procuration à un ami ou à un voisin avec la copie de votre pièce d\'identité pour éviter que votre colis nous soit retourné.');

define('EMAIL_TEXT_CONTENT_LESS',EMAIL_TEXT_CONTENT_HIGH);

define('EMAIL_TEXT_TITRE','<br><b>Votre commande</b><br>');

define('EMAIL_TEXT_INVOICE_URL', 'Facture détaillée :');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande :');
define('EMAIL_TEXT_PRODUCTS', 'Produits');
define('EMAIL_TEXT_SUBTOTAL', 'Sous-Total :');
define('EMAIL_TEXT_TAX', 'TVA :        ');
define('EMAIL_TEXT_SHIPPING', 'Expédition : ');
define('EMAIL_TEXT_TOTAL', 'Total :    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de livraison');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de facturation');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Méthode de paiement');

define('TEXT_EMAIL_VIA', 'par l\'intermédiaire de');

define('SPONSORSHIP_EMAIL_SUBJECT', 'Nouveau code de réduction '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Nous sommes heureux de vous faire parvenir le code de réduction suivant : "%s" d\'une valeur de %s valable %s mois suite à la commande de votre %sfilleul %s.

Vous pouvez accéder à la liste de vos réductions en vous connectant sur notre site et en utilisant le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php</a>

Cordialement,
Toute l\'équipe '.STORE_NAME.'. ');

define('STR_GODCHILD_1', '');
define('STR_GODCHILD_2', 'petit ');
define('STR_GODCHILD_3', 'petit petit ');

define('EMAIL_TEXT_DISCOUNT_SUBJECT', '%s de réduction pour vos amis !');


define('EMAIL_FRIEND_DISCOUNT', 'Bonjour %s,

Suite à votre commande, vos amis peuvent gràce à vous bénéficier d\'une réduction de %s.

Cliquez sans plus attendre sur le lien suivant pour envoyer le bon de réduction à vos amis :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s">http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s</a>

Cordialement,
L\'équipe '.STORE_NAME.'.
Tél : 0970 465 068');
?>
