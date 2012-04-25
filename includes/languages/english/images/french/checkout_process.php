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
define('EMAIL_TEXT_ORDER_NUMBER', 'Les vacances approchent, nous vous invitons � suivre l\'�tat de livraison de votre colis via le tracking mentionn� sur www.bpostinternational.com, en cas d\'absence, le colis reste en poste pendant une p�riode al�atoire de 5 � 15 jours, au dela de ce d�lai, votre colis nous sera retourn�.<br />
Vous pouvez donner procuration � un ami ou � un voisin avec la copie de votre pi�ce d\'identit� pour �viter que votre colis nous soit retourn�.<br />
'.EMAIL_SEPARATOR."\n".'Num�ro de commande :');

define('EMAIL_TEXT_NAME','Nom');
define('EMAIL_TEXT_PRICE','Prix');
define('EMAIL_TEXT_QTY','Quantit�');
define('EMAIL_TEXT_TOTAL','Total');
define('EMAIL_TEXT_SUB_TOTAL','Sous-Total');
define('EMAIL_TEXT_TAX','TVA');
define('EMAIL_TEXT_ORDER_TOTAL','Total commande');



define('EMAIL_TEXT_CONTENT_HIGH','Cher(e) %s,
<br><br>
Merci pour votre commande %s du %s
<br><br>
Si votre commande ne comporte aucune anomalie, vos produits vous seront livr�s dans 12 jours.
<br><br>
Vous pourrez v�rifier le statut de votre commande en vous connectant sur votre compte dans les 72h :
<br><br>
<a href=\"http://www.'.strtolower(STORE_NAME).'\">http://www.'.strtolower(STORE_NAME).'</a><br>
e-mail: %s<br>
Password: %s');
define('EMAIL_TEXT_CONTENT', 'Votre commande nous a �t� correctement envoy�e.
<br><br>
Si votre commande ne comporte aucune anomalie, vos produits vous seront livr�s dans 12 jours.');
define('EMAIL_TEXT_CONTENT_LESS',EMAIL_TEXT_CONTENT_HIGH);

define('EMAIL_TEXT_TITRE','<br><b>Votre commande</b><br>');

define('EMAIL_TEXT_INVOICE_URL', 'Facture d�taill�e :');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande :');
define('EMAIL_TEXT_PRODUCTS', 'Produits');
define('EMAIL_TEXT_SUBTOTAL', 'Sous-Total :');
define('EMAIL_TEXT_TAX', 'TVA :        ');
define('EMAIL_TEXT_SHIPPING', 'Exp�dition : ');
define('EMAIL_TEXT_TOTAL', 'Total :    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de livraison');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de facturation');
define('EMAIL_TEXT_PAYMENT_METHOD', 'M�thode de paiement');

define('TEXT_EMAIL_VIA', 'par l\'interm�diaire de');

define('SPONSORSHIP_EMAIL_SUBJECT', 'Nouveau code de r�duction '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Bonjour ,

Nous sommes heureux de vous faire parvenir le code de r�duction suivant : "%s" d\'une valeur de %s valable %s mois suite � la commande de votre %sfilleul %s.

Vous pouvez acc�der � la liste de vos r�ductions en vous connectant sur notre site et en utilisant le lien suivant :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php</a>

Cordialement,
Toute l\'�quipe '.STORE_NAME.'. ');

define('STR_GODCHILD_1', '');
define('STR_GODCHILD_2', 'petit ');
define('STR_GODCHILD_3', 'petit petit ');

define('EMAIL_TEXT_DISCOUNT_SUBJECT', '%s de r�duction pour vos amis !');


define('EMAIL_FRIEND_DISCOUNT', 'Bonjour %s,

Suite � votre commande, vos amis peuvent gr�ce � vous b�n�ficier d\'une r�duction de %s.

Cliquez sans plus attendre sur le lien suivant pour envoyer le bon de r�duction � vos amis :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s">http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s</a>

Cordialement,
L\'�quipe '.STORE_NAME.'.
T�l : 0970 465 068');

define('EMAIL_TEXT_SUBJECT_MEMBER', 'Votre adh�sion � '.STORE_NAME);
define('EMAIL_MEMBER', '%s
<br /><br />
Vous faites maintenant partie des membres de '.ucfirst($_SERVER['SERVER_NAME']).'.
<br />
Votre abonnement expire le : %s
<br /><br />
A tr�s bient�t sur '.ucfirst($_SERVER['SERVER_NAME']).'
');
?>
