<?php
/*
  $Id: BECOME_MEMBER.php,v 1.65 2003/06/09 23:03:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  $disable_links = false;
  require('includes/application_top.php');
// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_BECOME_MEMBER);
  
  if (isset($_GET['type'])) {
    $neta_type = htmlentities($_GET['type']);
    tep_session_register('neta_type');
  }
  
  if (isset($_GET['newsletter'])) {
    $neta_newsletter = htmlentities($_GET['newsletter']);
    tep_session_register('neta_newsletter');
  }

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $process = true;

    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);

    $error = false;
    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('become_member', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('become_member', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('become_member', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    if ($error == false) {
      //On verifie que l'email ou ip n'est pas deja present en base pour la newsletter en cours
      $rs = tep_db_query('SELECT neta_email FROM '.TABLE_NETA.' WHERE neta_email = "'.$email_address.'"');
      if (mysql_num_rows($rs) == 0) {
	  
		  $sql_data_array = array('neta_email' => $email_address,
								  'neta_date_added' => date('y-m-d h:i:s'),
								  'neta_type' => isset($neta_type) ? $neta_type : '',
								  'neta_newsletter' => isset($neta_newsletter) ? $neta_newsletter : '',);

          tep_db_perform(TABLE_NETA, $sql_data_array);

	  }
	  

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

      $neta_email = $email_address;
      tep_session_register('neta_email');

      tep_redirect(tep_href_link(FILENAME_ADVANTAGES, '', 'SSL', true, true, true));
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_BECOME_MEMBER, '', 'SSL'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<?php require('includes/form_check.js.php'); ?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php //require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
   </td>
<!-- body_text //-->
    <td width="100%" class="col_center"><?php echo tep_draw_form('become_member', tep_href_link(FILENAME_BECOME_MEMBER, '', 'SSL', true, true, true), 'post', 'onSubmit="return check_form(become_member);"') . tep_draw_hidden_field('action', 'process'); ?>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>


<?php tep_draw_heading_top_1();?>

     <?php //<table cellpadding="0" cellspacing="0" border="0"> <tr><td class="smallText padd_1"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); </td></tr></table>?>
     <table cellpadding="0" cellspacing="0" border="0"><tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr></table>
<?php
  if ($messageStack->size('become_member') > 0) {
?>
     <table cellpadding="0" cellspacing="0" border="0">
		  <tr><td><?php echo $messageStack->output('become_member'); ?></td></tr>
		  <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
	 </table>
<?php
  }
?>

		<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main" style="color:#d923bf;font-weight:weight;font-size:17px;"><?php echo USE_OFFER; ?></td>
      </tr>
    </table><br><br>
        
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main" style="font-size:10px;font-weight:bold;">Je souhaite recevoir les offres Parfumreduc</td>
       <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
      </tr>
    </table>



<?php echo tep_draw_infoBox_top();?>

            <table border="0" cellspacing="2" cellpadding="2" class="newsletter_email">
<!--
              <tr>
                <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
                <td class="main"><?php echo tep_draw_input_field('firstname') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
                <td class="main"><?php echo tep_draw_input_field('lastname') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
              </tr>
-->
              <tr>
                <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                <td class="main" width="250"><?php echo tep_draw_input_field('email_address', '', 'style="width:200px"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                <td class="bg_input"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
              </tr>

            </table>

<?php echo tep_draw_infoBox_bottom();?>

<?php tep_draw_heading_bottom_1();?>
<br />
<center>
<div id="become-member-adv">
<?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/1.302.jpg', 'Rejoignez leclub de parfum à prix coûtant');?>
</div>
</center>
    </form></td>
<!-- body_text_eof //-->
    <td class="col_right">
<!-- right_navigation //-->
<?php //include(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php include(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
