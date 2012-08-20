<?php
/*
  $Id: address_book.php,v 1.58 2003/06/09 23:03:52 hpdl Exp $

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

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADDRESS_BOOK);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
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
    <td width="100%" class="col_center">

			
<?php tep_draw_heading_top();?>
	
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_1();?>
						
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
	  	  <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
	  </table>
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
		  <tr>
			<td><?php echo $messageStack->output('addressbook'); ?></td>
		  </tr>
		  <tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
		  </tr>
	  </table>
<?php
  }
?>
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
	          <tr><td class="main"><b><?php echo PRIMARY_ADDRESS_TITLE; ?></b></td></tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>

                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main" width="50%" valign="top"><?php echo PRIMARY_ADDRESS_DESCRIPTION; ?></td>
						<td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
						  <tr>
							<td class="main" align="center" valign="top"><b><?php echo PRIMARY_ADDRESS_TITLE; ?></b><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
							<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" valign="top"><?php echo tep_address_label($customer_id, $customer_default_address_id, true, ' ', '<br>'); ?></td>
							<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						  </tr>
						</table></td>
					  </tr>
					</table>

<?php echo tep_draw_infoBox_bottom();?>

	                </td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td class="main"><b><?php echo ADDRESS_BOOK_TITLE; ?></b></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>

                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_digicode as digicode, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname");
  while ($addresses = tep_db_fetch_array($addresses_query)) {
	$format_id = tep_get_address_format_id($addresses['country_id']);
?>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
						   <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL'); ?>'">
							<td class="main" style=" vertical-align:middle;">&nbsp;<b><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></b><?php if ($addresses['address_book_id'] == $customer_default_address_id) echo '&nbsp;<small><i>' . PRIMARY_ADDRESS . '</i></small>'; ?></td>
							<td class="main" align="right" style=" padding:5px 5px 5px 0px;">
							
							<?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('button_edit.gif', SMALL_IMAGE_BUTTON_EDIT,' style=" margin-bottom:4px;"') . '</a>'/*. <a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . tep_image_button('button_delete1.gif', SMALL_IMAGE_BUTTON_DELETE,' style=" margin-bottom:4px;"') . '</a>'*/; ?></td>
						  </tr>
						  <tr>
							<td colspan="2"><table border="0" cellspacing="0" cellpadding="2">
							  <tr>
								<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
								<td class="main"><?php echo tep_address_format($format_id, $addresses, true, ' ', '<br>'); ?></td>
								<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							  </tr>
							</table></td>
						  </tr>
						</table></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
<?php
  }
?>
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
						<td class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
<?php
  if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
?>
						<td class="smallText" align="right"><?php //echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . tep_image_button('button_add_address1.gif', IMAGE_BUTTON_ADD_ADDRESS) . '</a>'; ?></td>
<?php
  }
?>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
					</table>
				
				</td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td class="smallText"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></td>
			  </tr>
	 </table>

					
<?php tep_draw_heading_bottom_1();?>					
		
<?php tep_draw_heading_bottom();?>
	
	</form></td>

<!-- body_text_eof //-->
    <td valign="top">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
