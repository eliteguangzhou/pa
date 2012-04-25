<?php
/*
  $Id: account_newsletters.php,v 1.3 2003/06/05 23:23:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_NEWSLETTERS);

  $newsletter_query = tep_db_query("select customers_newsletter from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $newsletter = tep_db_fetch_array($newsletter_query);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    if (isset($HTTP_POST_VARS['newsletter_general']) && is_numeric($HTTP_POST_VARS['newsletter_general'])) {
      $newsletter_general = tep_db_prepare_input($HTTP_POST_VARS['newsletter_general']);
    } else {
      $newsletter_general = '0';
    }

    if ($newsletter_general != $newsletter['customers_newsletter']) {
      $newsletter_general = (($newsletter['customers_newsletter'] == '1') ? '0' : '1');

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_newsletter = '" . (int)$newsletter_general . "' where customers_id = '" . (int)$customer_id . "'");
    }

    $messageStack->add_session('account', SUCCESS_NEWSLETTER_UPDATED, 'success');

    tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}

function checkBox(object) {
  document.account_newsletter.elements[object].checked = !document.account_newsletter.elements[object].checked;
}
//--></script>
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
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
	</td>
<!-- body_text //-->
    <td width="100%" class="col_center"><?php echo tep_draw_form('account_newsletter', tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
	
		<tr><td>
			
<?php tep_draw_heading_top();?>
	
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_1();?>
						
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td class="main"><b><?php echo MY_NEWSLETTERS_TITLE; ?></b></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>
                
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
						  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="checkBox('newsletter_general')">
							<td class="main"><?php echo tep_draw_checkbox_field('newsletter_general', '1', (($newsletter['customers_newsletter'] == '1') ? true : false), 'onclick="checkBox(\'newsletter_general\')"'); ?></td>
							<td class="main"><b><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER; ?></b></td>
						  </tr>
						  <tr>
							<td class="main">&nbsp;</td>
							<td><table border="0" cellspacing="0" cellpadding="2">
							  <tr>
								<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
								<td class="main"><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER_DESCRIPTION; ?></td>
								<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							  </tr>
							</table></td>
						  </tr>
						</table></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
					</table>
                    
<?php echo tep_draw_infoBox_bottom();?>

	                  </td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td> 
					<table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
						<td align="right" class="bg_input"><?php echo tep_image_submit('button_continue1.gif', IMAGE_BUTTON_CONTINUE); ?></td>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
					</table>
				</td>
			  </tr>
	  </table>
					
<?php tep_draw_heading_bottom_1();?>					
		
<?php tep_draw_heading_bottom();?>
	
			</td></tr>
		</table>
	</form></td>

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
