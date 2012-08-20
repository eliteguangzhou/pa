<?php
  require('includes/application_top.php');

  if (!SPONSORSHIP_ACTIVATE) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPONSORSHIP_LIST);


    function has_bad_emails($bad_emails, &$messageStack, $error_message){
        if (!empty($bad_emails)){
            $messageStack->add('email_format', sprintf(constant($error_message), join('<br />- ', $bad_emails)));
            return true;
        }

        return false;
    }
    
    $mail_sent = false;
    //Verification avant envoi email
    if (!empty($_POST)){
        $bad_emails = array();
        $emails = array();
        $query = tep_db_query("select IF(last_retry = '0000-00-00 00:00:00' OR ADDTIME(last_retry, '24:00:00') < NOW(), 1, 0) as can_retry, email from " . TABLE_SPONSORSHIP. " where email IN ('".join("','",$_POST['email'])."') AND subscribed = 0");

        while($data = tep_db_fetch_array($query)) {
            $emails[] = $data['email'];
            if (!$data['can_retry'])
                $bad_emails[] = $email;
        }

        if (!has_bad_emails($bad_emails, $messageStack, 'SPONSORSHIP_RETRY_LATER')) {

            //Verification du format de mail
            foreach ($_POST['email'] as $email)
                if (!tep_validate_email($email) || !in_array($email, $emails))
                    $bad_emails[] = $email;

            if (!has_bad_emails($bad_emails, $messageStack, 'SPONSORSHIP_EMAIL_ERROR')) {

                foreach ($_POST['email'] as $index => $email) {

                    $query = tep_db_query("
                        SELECT c.discount, c.code, s.unlock_key
                        FROM ".TABLE_COUPONS." c, ".TABLE_SPONSORSHIP." s
                        WHERE c.email = '".$email."'
                        and s.email = c.email
                    ");
                    $infos = tep_db_fetch_array($query);

                    $godfather_fullname = ucfirst($customer_first_name) . ' ' . ucfirst($customer_last_name);
                    tep_mail(
                        '',
                        $email,
                        sprintf(SPONSORSHIP_EMAIL_SUBJECT, $godfather_fullname),
                        nl2br(sprintf(SPONSORSHIP_EMAIL_TEXT, $godfather_fullname, $currencies->display_price($infos['discount']), $infos['code'], $godfather_fullname, $infos['unlock_key'], $email, $infos['unlock_key'], $email)),
                        STORE_NAME,
                        STORE_OWNER_EMAIL_ADDRESS
                    );

                    $query = tep_db_query("
                        UPDATE ".TABLE_SPONSORSHIP." SET
                        last_retry = NOW()
                        WHERE email = '".$email."'
                    ");

                    $mail_sent = true;
                }
            }
        }
    }

    $datas = explode(';', SPONSORSHIP_DISCOUNT_GODFATHER);
    foreach ($datas as $index => $data)
        $datas[$index] = explode(':', $data);

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

        <div class="sponsorship_info">
            <h1><?php echo SPONSORSHIP_TITLE;?></h1>

            <?php if ($messageStack->size('email_format') > 0) { ?>
                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
            			  <tr>
            			<td><?php echo $messageStack->output('email_format'); ?></td>
            		  </tr>
            		  <tr>
            			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
            		  </tr>
            	 </table>
            <?php } ?>

            <?php if ($mail_sent) echo '<div id="notice">'.nl2br(SPONSORSHIP_EMAIL_SENT).'</div>'; ?>
            
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <table cellpadding="1" cellspacing="1" border="1" id="sponsorship_list">
                    <tr>
                        <td align="center"><?php echo SPONSORSHIP_EMAIL; ?></td>
                        <td align="center"><?php echo SPONSORSHIP_SUBSCRIBED; ?></td>
                        <td align="center"><?php echo SPONSORSHIP_RETRY; ?></td>
                    </tr>
                    <?php
                        $query = tep_db_query("
                            select
                                email,
                                subscribed,
                                IF(last_retry = '0000-00-00 00:00:00' OR ADDTIME(last_retry, '24:00:00') < NOW(), 1, 0) as can_retry
                            from ".TABLE_SPONSORSHIP."
                            where customers_id = '".(int)$customer_id."'

                        ");
                        $can_retry = false;
                        $has_godchild = false;
                        while($data = tep_db_fetch_array($query)) {
                            if (!$data['subscribed'] && $data['can_retry'])
                                $can_retry = true;
                            $has_godchild = true;
                            echo '
                                <tr>
                                    <td>'.$data['email'].'</td>
                                    <td align="center">'.($data['subscribed'] ? SPONSORSHIP_YES : SPONSORSHIP_NO).'</td>
                                    <td align="center">'.($data['subscribed'] ? '-' : (!$data['can_retry'] ? SPONSORSHIP_RETRY_LATER : '<input type="checkbox" name="email[]" value="'.$data['email'].'" />')).'</td>
                                </tr>
                            ';
                        }
                        if (!$has_godchild)
                            echo '
                                <tr>
                                    <td colspan="5">'.SPONSORSHIP_NO_GODCHILD.'</td>
                                </tr>
                            ';
                        elseif($can_retry)
                            echo '
                                <tr>
                                    <td colspan="5" align="right"><input type="submit" value="'.SPONSORSHIP_RETRY.'" /></td>
                                </tr>
                            ';
                    ?>
                </table>
            </form>
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

<?php if ($messageStack->size('email_format') > 0) { ?>
<script type="text/javascript">
    self.location.hash='#sponsorship';
</script>
<?php } ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>