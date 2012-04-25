<?php
define('SPONSORSHIP_INTRODUCTION_TEXT', '2 good reasons to invite your friends!

1. It\'s simple!
To refer your friends, simply enter their email <sup>(1)</sup> in the field below. An email will be sent informing them of your invitation.

2. It brings in euros!
'. STORE_NAME.' offers an exceptional compensation declined on 3 levels which allows you to earn euros <sup>(2)</sup>:

-%s on %s first orders for your referrals direct
-%s on %s first orders of referrals of your referrals
-%s on %s first orders of referrals of your referrals of your referrals

<img src="images/parrain_schema.gif" />

You can sponsor up to 100 referrals and earn up to 700 euros in vouchers of your direct referrals and so much more with referrals of your referrals and so on.
Contact them via "Sponsorship" in your account to multiply your winnings!

Sign up now for '. STORE_NAME.' and get sponsorship to earn money!

<i><sup>(1)</sup>: Email will they use when they sign on '. STORE_NAME.'
<sup>(2)</sup>: Gains will be issued via Vouchers valid for 1 year on '. STORE_NAME.'
</i>');
define('SPONSORSHIP_TYPE_EMAILS', 'Enter the emails of friends you want to sponsor:');
define('SPONSORSHIP_SUBMIT_BUTTON', 'Sponsor');
define('ENTRY_QUOTA_GODCHILD', 'You have exceeded your quota of referrals (%s remaining)');
define('ENTRY_EMAIL_ERROR', 'The following email is invalid: <br /> - %s');
define('ENTRY_EMAIL_ERRORS', 'The following emails are invalid: <br /> - %s');
define('ENTRY_STORED_EMAIL_ERROR', 'The following email is already a member of '.STORE_NAME.' : <br />- %s');
define('ENTRY_STORED_EMAIL_ERRORS', 'The following emails are already a member of '.STORE_NAME.' : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERROR', 'The following email is already waiting for sponsorship : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERRORS', 'The following emails are already waiting for sponsorship : <br />- %s');
define('SPONSORSHIP_TITLE', 'Sponsor a friend');
define('SPONSORSHIP_EMAIL_SUBJECT', '%s wants to introduce you to '.STORE_NAME);
define('SPONSORSHIP_EMAIL_TEXT', 'Hello,

Your friend %s wanted to introduce you to our site <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'"> '. STORE_NAME.' </A> and we are very proud of it.

We are very pleased to offer you s% reduction on account of one of your orders without delay to start shopping on <a target = "blank" href="http://'. $_SERVER['SERVER_NAME'].'">'. STORE_NAME. '</a>. Take advantage of this discount valid for one month by entering the following code "%s" when ordering.

To also be a member of '. STORE_NAME.', you just have to accept the invitation from %s by clicking on the link below:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

See you soon hopefully.
The whole team '. STORE_NAME.'.');
define('SPONSORSHIP_EMAIL_SENT', 'Congratulations!

Your friend(s) have been advised by email for your invitation.

Enjoy coupons on their first purchase, but also for purchases of their referrals and the referrals of their referrals ! These discount codes will be sent by email and will also be available on this link:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">My discounts</a>

You can also display your referrals by clicking on the link below:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_list.php">My referrals</a>

Sincerely,
The whole team '. STORE_NAME');
?>