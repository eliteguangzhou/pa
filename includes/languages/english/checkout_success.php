<?php
define('NAVBAR_TITLE_1', 'Checkout');
define('NAVBAR_TITLE_2', 'Success');
define('HEADING_TITLE', '<p> Congratulations </b> </p>
   <p>
   Your order has been successfully sent. </p>
   <p> If your order is functioning correctly, your products will be delivered in 12 working days. </p>

   <p>
   An order confirmation has been sent to your inbox. If you\'ve received nothing in 10 minutes, you can access your order confirmation with this link: <br />
   <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
   </p>');
define('TEXT_NOTIFY_PRODUCTS', 'Please notify me of updates to the products I have selected below:');
define('TEXT_SEE_ORDERS', 'You can view your order history by going to the <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'My Account\'</a> page and by clicking on <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'History\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Please direct any questions you have to the <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">store owner</a>.');
define('TABLE_HEADING_COMMENTS', 'Enter a comment for the order processed');
define('TABLE_HEADING_DOWNLOAD_DATE', 'Expiry date: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' downloads remaining');
define('HEADING_DOWNLOAD', 'Download your products here:');
define('FOOTER_DOWNLOAD', 'You can also download your products at a later time at \'%s\'');
define('BAD_FRIEND_EMAIL', 'Incorrect email');
define('MAIL_SENT', 'An email has been sent to your contact with the discount code !');
define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s offer you a discount on '.STORE_NAME);
define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hello, 

Your friend %s  wants to offer discount of %s on one of your orders <a target = "blank" href = "http://'. $_SERVER['SERVER_NAME']. '">'. STORE_NAME. '</a>. Take advantage of this discount valid for 48 hours by entering the following code "%s" when ordering. 

If you do not privileged circle of party members '. STORE_NAME.', you can now register by clicking the following link: 

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

See you soon. 
The team '. STORE_NAME. '.');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'You already have sent a discount code to this friend before');
?>