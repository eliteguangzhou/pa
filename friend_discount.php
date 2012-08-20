<?php
  require('includes/application_top.php');

  if (!SPONSORSHIP_ACTIVATE) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }
  if (!isset($_GET['var'])) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $order_id = (int) $_GET['var'];

  if (!$order_id) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_FRIEND_DISCOUNT);

  //Si deja 3 amis ajoutes pour cette commande, erreur
  require_once(DIR_WS_CLASSES . '/friend_discount.php');
  $friend_discount = new friendDiscount();
  $max_friend_discount = MAX_FRIEND_DISCOUNT / $currencies->currencies["EUR"]['value'];

  $mail_sent = false;
  $friend_emails = $friend_discount->get($order_id);
  $has_error = false;
  if ($friend_discount->check_valid($order_id, $customer_id))
    $messageStack->add('block_error', ERROR_BAD_ORDER);
  elseif (isset($_POST['email'])) {
    $emails = array_unique($_POST['email']);
    foreach ($emails as $index => $email) {
        if (empty($email))
            unset($emails[$index]);
        elseif (!$has_error && !(tep_validate_email($email) && $email != $customer_email_address)) {
            $messageStack->add('bad_email', ERROR_BAD_FRIEND_EMAIL);
            $has_error = true;
        }
        elseif (!$has_error && in_array($email, $friend_emails)) {
            $messageStack->add('bad_email', ERROR_ALREADY_FRIEND_EMAIL);
            $has_error = true;
        }
        elseif (!$has_error && $friend_discount->check_email($email, $customer_id)) {
            $messageStack->add('bad_email', ERROR_DISCOUNT_ALREADY_GIVEN);
            $has_error = true;
        }
    }

    if (!$has_error && $friend_discount->check_reach($friend_emails, $emails))
        $messageStack->add('bad_email', sprintf(ERROR_MAX_FRIENDS_REACHED, 3 - count($friend_emails)));

    if ($messageStack->size('bad_email') == 0) {
        $date = new DateTime();
        $date->modify("+2 day");
        $godfather_fullname = ucfirst($customer_first_name) . ' ' . ucfirst($customer_last_name);
        foreach ($emails as $email) {
            $code = gen_coupon_code(SPONSORSHIP_CODE_LENGTH);
            $sponsorship->generate_discount($code, $max_friend_discount, $email, $date->format("Y-m-d H:i:s"), $order_id, 0);
            tep_mail(
                '',
                $email,
                sprintf(FRIEND_DISCOUNT_EMAIL_SUBJECT, $godfather_fullname),
                nl2br(sprintf(FRIEND_DISCOUNT_EMAIL_TEXT, $godfather_fullname, $currencies->display_price($max_friend_discount), $code)),
                STORE_NAME,
                STORE_OWNER_EMAIL_ADDRESS
            );
            $friend_discount->track_friend($email, $customer_id, $order_id);
            $mail_sent = true;
        }
    }
  }
  elseif ($friend_discount->check_max($friend_emails))
    $messageStack->add('block_error', ERROR_MAX_FRIENDS);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->
    <td class="col_center">

<?php tep_draw_heading_top();?>

<?php tep_draw_heading_top_1();?>

        <div class="friend_list_info">
            <h1><?php echo FRIEND_DISCOUNT_TITLE;?></h1>
            <?php if ($messageStack->size('block_error') > 0) echo $messageStack->output('block_error');
                  elseif (!$mail_sent) {?>
                    <?php if ($messageStack->size('bad_email') > 0) echo $messageStack->output('bad_email');?>
                    <p><?php echo sprintf(FRIEND_DISCOUNT_INTRO, $currencies->display_price($max_friend_discount));?></p>
                    <form action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="POST">
                        Adresse email 1 : <input type="text" name="email[]" value="<?php echo isset($_POST['email'][0]) ? $_POST['email'][0] : '';?>" /><br />
                        Adresse email 2 : <input type="text" name="email[]" value="<?php echo isset($_POST['email'][1]) ? $_POST['email'][1] : '';?>" /><br />
                        Adresse email 3 : <input type="text" name="email[]" value="<?php echo isset($_POST['email'][2]) ? $_POST['email'][2] : '';?>" /><br />
                        <input type="submit" value="Envoyer !" />
                    </form>
            <?php } else echo MAIL_SENT;?>

        </div>

<?php tep_draw_heading_bottom_1();?>

<?php tep_draw_heading_bottom();?>

    </td>
<!-- body_text_eof //-->
    <td class="col_right">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>