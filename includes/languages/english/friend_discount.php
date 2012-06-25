<?php
define('FRIEND_DISCOUNT_TITLE', 'Discount coupons for 3 of your friends!');
define('FRIEND_DISCOUNT_INTRO', 'Offer your friend a voucher worth %s by entering their emails in the following fields: <br />');
define('ERROR_BAD_ORDER', 'Invalid order or already processed');
define('ERROR_BAD_FRIEND_EMAIL', 'Invalid email');
define('ERROR_ALREADY_FRIEND_EMAIL', 'This friend already received a discount for this order');
define('ERROR_MAX_FRIENDS', 'You have reached the maximum discounts number allowed for his order');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'You have already sent a discount coupon to this friend before');
define('ERROR_MAX_FRIENDS_REACHED', 'You have exceeded the maximal number of discount allowed for this order (%s left)');
define('MAIL_SENT', 'An email has been sent to your contact with the discount coupon');
define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s offers your a voucher '.STORE_NAME);
define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hello,

Your friend (%s) wants to offer you a voucher worth %s usuable on one of your orders <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'. STORE_NAME.'</a>. Take advantage of this discount valid for 48 hours by entering the following code "%s" when ordering.

If you are not a member of '. STORE_NAME.', you can now register by clicking the following link:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

See you soon hopefully.
The whole team '. STORE_NAME.'.');
?>