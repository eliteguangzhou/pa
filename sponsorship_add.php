<?php
  require('includes/application_top.php');
  
  if (!SPONSORSHIP_ACTIVATE) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }
  
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    $from_sponsorship = true;
    tep_session_register('from_sponsorship');
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPONSORSHIP_ADD);

    function has_bad_emails($bad_emails, &$messageStack, $error_message){
        if (!empty($bad_emails)){
            $messageStack->add('email_format', sprintf(constant($error_message .(count($bad_emails) > 1 ? 'S' : '')), join('<br />- ', $bad_emails)));
            return true;
        }

        return false;
    }

    $mail_sent = false;
    //Ajout des filleuls
    if (!empty($_POST)){
        $bad_emails = array();
        $emails = array();
        //Verification du format de mail
        foreach ($_POST['email'] as $email)
            if (!empty ($email) && !tep_validate_email($email))
                $bad_emails[] = $email;
            elseif (!empty ($email))
                $emails[] = $email;

        if (!has_bad_emails($bad_emails, $messageStack, 'ENTRY_EMAIL_ERROR')) {
            //Si l'email n'est pas deja inscrit
            $query = tep_db_query("select customers_email_address as email from " . TABLE_CUSTOMERS . " where customers_email_address IN ('".join("','", $emails)."')");

            while($data = tep_db_fetch_array($query))
                $bad_emails[] = $data['email'];
                
            if (!has_bad_emails($bad_emails, $messageStack, 'ENTRY_STORED_EMAIL_ERROR')) {
                //Si l'email n'est pas en attente de parrainage
                $query = tep_db_query("select email from " . TABLE_SPONSORSHIP . " where email IN ('".join("','", $emails)."')");

                while($data = tep_db_fetch_array($query))
                    $bad_emails[] = $data['email'];
                    
                if (!has_bad_emails($bad_emails, $messageStack, 'ENTRY_SPONSORED_EMAIL_ERROR')) {

                    //Si quota filleuls pas atteint
                    $query = tep_db_query("select count(customers_id) as total from " . TABLE_SPONSORSHIP . " where customers_id = ".$customer_id);
                    $total = tep_db_fetch_array($query);
                    $total = $total['total'];
                    
                    if (SPONSORSHIP_MAX_GODCHILDREN == 0 || $total + count($emails) <= SPONSORSHIP_MAX_GODCHILDREN)
                    {
                        foreach ($emails as $index => $email) {
                            $key = md5(uniqid());

                            $query = tep_db_query("
                                INSERT INTO ".TABLE_SPONSORSHIP." SET
                                customers_id = ".$customer_id.",
                                email = '".$email."',
                                unlock_key = '".$key."'
                            ");

                            //creation coupon pour le filleul
                            $godfather_fullname = ucfirst($customer_first_name) . ' ' . ucfirst($customer_last_name);
                            $code = gen_coupon_code(SPONSORSHIP_CODE_LENGTH);
                            $sponsorship_discount_godchild = SPONSORSHIP_DISCOUNT_GODCHILD / $currencies->currencies["EUR"]['value']; 
							
                            $sponsorship->generate_discount($code, $sponsorship_discount_godchild, $email, date("Y-m-d H:i:s", strtotime("+".SPONSORSHIP_GODCHILD_EXPIRATION." month")));
                            tep_mail(
                                '',
                                $email,
                                sprintf(SPONSORSHIP_EMAIL_SUBJECT, $godfather_fullname),
                                nl2br(sprintf(SPONSORSHIP_EMAIL_TEXT, $godfather_fullname, $currencies->display_price($sponsorship_discount_godchild), $code, $godfather_fullname, $key, $email, $key, $email)),
                                STORE_NAME,
                                STORE_OWNER_EMAIL_ADDRESS
                            );
                            $mail_sent = true;
                        }
                    }
                    else {
                        $messageStack->add('email_format', sprintf(ENTRY_QUOTA_GODCHILD, SPONSORSHIP_MAX_GODCHILDREN - $total));
                    }
                }
            }
        }
    }
    
    $datas = explode(';', SPONSORSHIP_DISCOUNT_GODFATHER);
    foreach ($datas as $index => $data) {
        $datas[$index] = explode(':', $data);
		$datas[$index][1] /= $currencies->currencies["EUR"]['value']; 
	}

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

            <?php if(!$mail_sent) {?>
                <?php echo nl2br(sprintf(SPONSORSHIP_INTRODUCTION_TEXT, $currencies->display_price($datas[0][1]), SPONSORSHIP_MAX_ORDER, $currencies->display_price($datas[1][1]), SPONSORSHIP_MAX_ORDER, $currencies->display_price($datas[2][1]), SPONSORSHIP_MAX_ORDER));?><br />
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <fieldset id="sponsorship">
                        <h2><?php echo SPONSORSHIP_TYPE_EMAILS;?></h2>

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
                        <?php for($i=1; $i<=SPONSORSHIP_EMAIL_DISPLAY; $i++) {?>
                            <p>
                                <label for="email_<?php echo $i; ?>">Adresse email N&deg;<?php echo $i; ?></label>
                                <input value="<?php if(!empty($_POST['email'][$i-1])) echo $_POST['email'][$i-1]; ?>" name="email[]" id="email_<?php echo $i; ?>" class="texte" type="text" />
                            </p>
                        <?php } ?>
                        <p><input type="submit" value="<?php echo SPONSORSHIP_SUBMIT_BUTTON;?>"></p>
                    </fieldset>
                </form>
            <?php } else echo nl2br(SPONSORSHIP_EMAIL_SENT);?>
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