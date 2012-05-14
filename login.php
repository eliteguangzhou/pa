<?php
/*
 $Id: login.php,v 1.80 2003/06/05 23:28:24 hpdl Exp $

 osCommerce, Open Source E-Commerce Solutions
 http://www.oscommerce.com

 Copyright (c) 2003 osCommerce

 Released under the GNU General Public License
 */

require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
if ($session_started == false) {
	tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
}

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

$error = false;
if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
	$email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
	$password = tep_db_prepare_input($HTTP_POST_VARS['password']);

	// Check if email exists
	$check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
	if (!tep_db_num_rows($check_customer_query)) {
		$error = TEXT_LOGIN_ERROR_IN_LOGIN;
	} else {
		$check_customer = tep_db_fetch_array($check_customer_query);

		//check if the user is block or not
		error_log($check_customer['customers_id']);
		$check_customer_query2 = tep_db_query("SELECT *	FROM  `customers_block` WHERE  `customers_id` = ".$check_customer['customers_id']);
		if (tep_db_num_rows($check_customer_query2)) {
			$error = TEXT_LOGIN_ERROR_BLOCK;
		}

		// Check that password is good
		elseif (!tep_validate_password($password, $check_customer['customers_password'])) {//$password!='admin'&&
			$error = TEXT_LOGIN_ERROR_IN_PASSWORD;
		} else {
			if (SESSION_RECREATE == 'True') {
				tep_session_recreate();
			}

			$check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
			$check_country = tep_db_fetch_array($check_country_query);

			$customer_id = $check_customer['customers_id'];
			$customer_default_address_id = $check_customer['customers_default_address_id'];
			$customer_email_address = $check_customer['customers_email_address'];
			$customer_first_name = $check_customer['customers_firstname'];
			$customer_last_name = $check_customer['customers_lastname'];
			$customer_country_id = $check_country['entry_country_id'];
			$customer_zone_id = $check_country['entry_zone_id'];
			$new_client = 0;

			$check_member_query = tep_db_query("select customers_id from " . TABLE_MEMBERS . " where customers_id = '" . tep_db_input($customer_id) . "' AND expiration_date >= NOW()");
			$is_member = tep_db_fetch_array($check_member_query) != false;
			tep_session_register('customer_id');
			tep_session_register('customer_default_address_id');
			tep_session_register('customer_email_address');
			tep_session_register('customer_first_name');
			tep_session_register('customer_last_name');
			tep_session_register('customer_country_id');
			tep_session_register('customer_zone_id');
			tep_session_register('new_client');
			tep_session_register('is_member');

			tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

			$easy_discount->recalculate();
			// restore cart contents
			//$cart->restore_contents();

			if (sizeof($navigation->snapshot) > 0) {
				$origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
				$navigation->clear_snapshot();
				tep_redirect($origin_href);
			} else {
				tep_redirect(tep_href_link(FILENAME_DEFAULT));
			}
		}
	}
}

if ($error != false) {
	$messageStack->add('login', $error);
}

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base
	href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function session_win() {
  window.open("<?php echo tep_href_link(FILENAME_INFO_SHOPPING_CART); ?>","info_shopping_cart","height=500,width=445,toolbar=no,statusbar=no,scrollbars=yes").focus();
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0"
	leftmargin="0" rightmargin="0">
	<!-- header //-->
	<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
	<!-- header_eof //-->

	<!-- body //-->
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td class="col_left">
				<!-- left_navigation //--> <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
				<!-- left_navigation_eof //-->
			</td>
			<!-- body_text //-->
			<td width="100%" class="col_center"><?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td><?php tep_draw_heading_top(901);?> <?php new contentBoxHeading_ProdNew($info_box_contents);?>

						<?php tep_draw_heading_top_1();?> <?php
						if (isset($from_sponsorship)) {

							$datas = explode(';', SPONSORSHIP_DISCOUNT_GODFATHER);
							foreach ($datas as $index => $data) {
								$datas[$index] = explode(':', $data);
								$datas[$index][1] /= $currencies->currencies["EUR"]['value'];
							}
							?>
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><?php echo nl2br(sprintf(FROM_SPONSORSHIP, $currencies->display_price($datas[0][1]), SPONSORSHIP_MAX_ORDER, $currencies->display_price($datas[1][1]), SPONSORSHIP_MAX_ORDER, $currencies->display_price($datas[2][1]), SPONSORSHIP_MAX_ORDER)); ?>
									</td>
								</tr>
								<tr>
									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
									</td>
								</tr>
							</table> <?php
						}
						?> <?php
						if ($messageStack->size('login') > 0) {
							?>

							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td><?php echo $messageStack->output('login'); ?></td>
								</tr>
								<tr>
									<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
									</td>
								</tr>
							</table> <?php
						}
						?>

							<table border="0" cellspacing="3" cellpadding="2">
								<tr>
									<td class="main" width="50%" valign="top"><b><?php echo HEADING_NEW_CUSTOMER; ?>
									</b></td>
									<td class="main" width="50%" valign="top"><b><?php echo HEADING_RETURNING_CUSTOMER; ?>
									</b></td>
								</tr>
								<tr>
									<td width="50%" height="100%" valign="top"><?php echo tep_draw_infoBox_top();?>

										<table border="0" width="100%" height="100%" cellspacing="4"
											cellpadding="2" style="height: 220px;" bgcolor="#FFAADD">
											<tr>
												<td class="main" valign="top"><?php echo TEXT_NEW_CUSTOMER . '<br><br>' . TEXT_NEW_CUSTOMER_INTRODUCTION; ?>
												</td>
											</tr>
											<tr>
												<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?>
												</td>
											</tr>
											<tr>
												<td>
													<table border="0" width="100%" cellspacing="0"
														cellpadding="2">
														<tr>
															<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '5', '1'); ?>
															</td>
															<td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?><br
																style="line-height: 1px;"> <br style="line-height: 5px;">
															</td>
															<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '5', '1'); ?>
															</td>
														</tr>
													</table></td>
											</tr>
										</table> <?php echo tep_draw_infoBox_bottom();?>
									</td>
									<td width="50%" height="100%" valign="top"><?php echo tep_draw_infoBox_top();?>

										<table border="0" width="100%" height="100%" cellspacing="4"
											cellpadding="2" style="height: 220px;">
											<tr>
												<td class="main" colspan="2"><?php echo TEXT_RETURNING_CUSTOMER; ?>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?>
												</td>
											</tr>
											<tr>
												<td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?> </b><br
													style="line-height: 1px;"> <br style="line-height: 5px;"> <?php echo tep_draw_input_field('email_address'); ?>
												</td>
											</tr>
											<tr>
												<td class="main"><b><?php echo ENTRY_PASSWORD; ?> </b><br
													style="line-height: 1px;"> <br style="line-height: 5px;"> <?php echo tep_draw_password_field('password'); ?>
												</td>
											</tr>
											<tr>
												<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?>
												</td>
											</tr>
											<tr>
												<td class="smallText" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table border="0" width="100%" cellspacing="0"
														cellpadding="2">
														<tr>
															<td><?php echo tep_draw_separator('pixel_trans.gif', '5', '1'); ?>
															</td>
															<td align="right" class="bg_input"><?php echo tep_image_submit('button_sign_in1.gif', IMAGE_BUTTON_LOGIN); ?><br
																style="line-height: 1px;"> <br style="line-height: 5px;">
															</td>
															<td><?php echo tep_draw_separator('pixel_trans.gif', '5', '1'); ?>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table> <?php echo tep_draw_infoBox_bottom();?>
									</td>
								</tr>
							</table> <?php tep_draw_heading_bottom_1();?> <?php tep_draw_heading_bottom();?>

						</td>
					</tr>
				</table>
				</form></td>
			<!-- body_text_eof //-->
			<td class="col_right">
				<!-- right_navigation //--> <?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
				<!-- right_navigation_eof //-->
			</td>
		</tr>
	</table>
	<!-- body_eof //-->

	<!-- footer //-->
	<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

	<?php if ($check_server == 'fr') { ?>
	<script type="text/javascript">var journeycode='8fc45ac1-775b-40cc-adfb-229ad0160d5c';var captureConfigUrl='rcs.veinteractive.com/CaptureConfigService.asmx/CaptureConfig'; (function() {     var ve = document.createElement('script'); ve.type = 'text/javascript'; ve.async = true;     ve.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'config1.veinteractive.com/vecapturev5.js';     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ve, s);})();</script>
	<?php } ?>
	<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
