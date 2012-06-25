<?php
/*
  $Id: create_account.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Create an Account');

define('HEADING_TITLE', 'My Account Information');
define('EMAIL_GREET_MR', 'Dear Mr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear %s' . "\n\n");

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTE:</b></font></small> If you already have an account with us, please login at the <a href="%s"><u>login page</u></a>.');

define('EMAIL_SUBJECT', 'Welcome to  Parfumwholesale.com ' ); // . STORE_NAME);

define('EMAIL_WELCOME', 'Your personal account is now open an fully operative on www.parfumwholesale.com.<br><br>
The following will explain to you how to create your first order quickly and efficiently<br><br>
Browse the different categories on our website and add items into your shopping basket by pressing the "Add to Cart" button.<br><br>
When you\'re ready to checkout, simply click on the "Checkout" button.<br><br>
After you submit your order, we will review it and send you an email to confirm the order. If all looks good, we will review it and send you an email to confirm the order. If all looks good, your products will arrive at their destination within 7 - 12 business days.<br><br>
The minimum order quantity is 150$ USD. <br><br>
The following is your personal account information.<br><br>Please save or print this message for later reference.'. "\n\n");
define('EMAIL_PRESENTATION', '');
//define('EMAIL_LOGIN', 'Username: %s <br>' . "\n\n");
//define('EMAIL_PWD', 'Password: %s <br>' . "\n\n");


define('EMAIL_CONTACT', 'If you need further assistance, please e-mail us using our contact form and describe your request in detail. We will respond to your e-mail within 24-48 hours, depends on our back-log.
<br><br>
You could also send us an email to : contact@parfumwholesale.com
<br><br>
We look forward to a mutual beneficial, long-term relationship with you!
<br><br>
Best Regards,
<br><br>
Mike Hilton<br>
Customer Service Dpt.
<br><br>
' . "\n\n");
//define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>
