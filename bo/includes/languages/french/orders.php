<?php
/*
  $Id: orders.php,v 1.25 2003/06/20 00:28:44 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Commandes');
define('HEADING_TITLE_SEARCH', 'ID commande :');
define('HEADING_TITLE_STATUS', 'Statut :');

define('TABLE_HEADING_COMMENTS', 'Commentaires');
define('TABLE_HEADING_CUSTOMERS', 'Clients');
define('TABLE_HEADING_ORDER_TOTAL', 'Total commande');
define('TABLE_HEADING_DATE_PURCHASED', 'Date d\'achat');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qt�.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Mod�le');
define('TABLE_HEADING_PRODUCTS', 'Produits');
define('TABLE_HEADING_TAX', 'Taxe');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Prix (ht)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Prix (ttc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ht)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (ttc)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Client notifi�');
define('TABLE_HEADING_DATE_ADDED', 'Date d\'ajout');

define('ENTRY_CUSTOMER', 'Client :');
define('ENTRY_SOLD_TO', 'VENDU A :');
define('ENTRY_DELIVERY_TO', 'Livraison � :');
define('ENTRY_SHIP_TO', 'LIVRE A :');
define('ENTRY_SHIPPING_ADDRESS', 'Adresse d\'exp�dition :');
define('ENTRY_BILLING_ADDRESS', 'Adresse facturation :');
define('ENTRY_PAYMENT_METHOD', 'M�thode de paiement :');
define('ENTRY_CREDIT_CARD_TYPE', 'Type de carte de cr�dit :');
define('ENTRY_CREDIT_CARD_OWNER', 'Propri�taire de la carte de cr�dit :');
define('ENTRY_CREDIT_CARD_NUMBER', 'Num�ro de la carte de cr�dit :');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Date d\'expiration de la carte de cr�dit :');
define('ENTRY_SUB_TOTAL', 'Sous-Total :');
define('ENTRY_TAX', 'Taxe :');
define('ENTRY_SHIPPING', 'Exp�dition :');
define('ENTRY_TOTAL', 'Total :');
define('ENTRY_DATE_PURCHASED', 'Date d\'achat :');
define('ENTRY_STATUS', 'Statut :');
define('ENTRY_DATE_LAST_UPDATED', 'Derni�re date de mise � jour :');
define('ENTRY_NOTIFY_CUSTOMER', 'Informer client :');
define('ENTRY_NOTIFY_COMMENTS', 'Ajouter un commentaire :');
define('ENTRY_PRINTABLE', 'Imprimer la facture');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Supprimer la commande');
define('TEXT_INFO_DELETE_INTRO', 'Etes vous s�r de vouloir supprimer cette commande ?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restaurer la valeur de stock');
define('TEXT_DATE_ORDER_CREATED', 'Date de cr�ation :');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Derni�re modification :');
define('TEXT_INFO_PAYMENT_METHOD', 'M�thode de paiement :');

define('TEXT_ALL_ORDERS', 'Toutes les commandes');
define('TEXT_NO_ORDER_HISTORY', 'Aucun historique de commande disponible');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Mise � jour de la commande');
define('EMAIL_TEXT_ORDER_NUMBER', 'Num�o de commande :');
define('EMAIL_TEXT_INVOICE_URL', 'Facture d�taill�e :');
define('EMAIL_TEXT_DATE_ORDERED', 'Date de commande :');
define('EMAIL_TEXT_STATUS_UPDATE', 'Le statut de votre commande a �t� mis � jour.' . "\n\n" . 'Nouveau statut: %s' . "\n\n" . 'Veuillez r�pondre � ce mail si vous avez des questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Les commentaires de votre commande sont' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Erreur : La commande n\'existe pas.');
define('SUCCESS_ORDER_UPDATED', 'Succ�s : La commande est mise � jour.');
define('WARNING_ORDER_NOT_UPDATED', 'Attention : Aucune modification n\'a �t� effectu�e. La commande n\'a pas �t� mise � jour.');
?>