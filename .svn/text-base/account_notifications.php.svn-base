<?php
/*
  $Id: account_notifications.php,v 1.2 2003/05/22 14:24:54 hpdl Exp $

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
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_NOTIFICATIONS);

  $global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = tep_db_fetch_array($global_query);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    if (isset($HTTP_POST_VARS['product_global']) && is_numeric($HTTP_POST_VARS['product_global'])) {
      $product_global = tep_db_prepare_input($HTTP_POST_VARS['product_global']);
    } else {
      $product_global = '0';
    }

    (array)$products = $HTTP_POST_VARS['products'];

    if ($product_global != $global['global_product_notifications']) {
      $product_global = (($global['global_product_notifications'] == '1') ? '0' : '1');

      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set global_product_notifications = '" . (int)$product_global . "' where customers_info_id = '" . (int)$customer_id . "'");
    } elseif (sizeof($products) > 0) {
      $products_parsed = array();
      reset($products);
      while (list(, $value) = each($products)) {
        if (is_numeric($value)) {
          $products_parsed[] = $value;
        }
      }

      if (sizeof($products_parsed) > 0) {
        $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "' and products_id not in (" . implode(',', $products_parsed) . ")");
        $check = tep_db_fetch_array($check_query);

        if ($check['total'] > 0) {
          tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "' and products_id not in (" . implode(',', $products_parsed) . ")");
        }
      }
    } else {
      $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      if ($check['total'] > 0) {
        tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "'");
      }
    }

    $messageStack->add_session('account', SUCCESS_NOTIFICATIONS_UPDATED, 'success');

    tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'));
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
  document.account_notifications.elements[object].checked = !document.account_notifications.elements[object].checked;
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
    <td width="100%" class="col_center"><?php echo tep_draw_form('account_notifications', tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>
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
				<td class="main"><b><?php echo MY_NOTIFICATIONS_TITLE; ?></b></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>
                
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main"><?php echo MY_NOTIFICATIONS_DESCRIPTION; ?></td>
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
				<td class="main"><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>
                
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
						  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="checkBox('product_global')">
							<td class="main" width="30"><?php echo tep_draw_checkbox_field('product_global', '1', (($global['global_product_notifications'] == '1') ? true : false), 'onclick="checkBox(\'product_global\')"'); ?></td>
							<td class="main"><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></td>
						  </tr>
						  <tr>
							<td width="30">&nbsp;</td>
							<td class="main"><?php echo GLOBAL_NOTIFICATIONS_DESCRIPTION; ?></td>
						  </tr>
						</table></td>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
				</table>
                
<?php echo tep_draw_infoBox_bottom();?>

	                </td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
<?php
  if ($global['global_product_notifications'] != '1') {
?>
			  <tr>
				<td class="main"><b><?php echo NOTIFICATIONS_TITLE; ?></b></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>
                
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    $products_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_NOTIFICATIONS . " where customers_id = '" . (int)$customer_id . "'");
    $products_check = tep_db_fetch_array($products_check_query);
    if ($products_check['total'] > 0) {
?>
						  <tr>
							<td class="main" colspan="2"><?php echo NOTIFICATIONS_DESCRIPTION; ?></td>
						  </tr>
<?php
      $counter = 0;
      $products_query = tep_db_query("select pd.products_id, pd.products_name from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_NOTIFICATIONS . " pn where pn.customers_id = '" . (int)$customer_id . "' and pn.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name");
      while ($products = tep_db_fetch_array($products_query)) {
?>
						  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="checkBox('products[<?php echo $counter; ?>]')">
							<td class="main" width="30"><?php echo tep_draw_checkbox_field('products[' . $counter . ']', $products['products_id'], true, 'onclick="checkBox(\'products[' . $counter . ']\')"'); ?></td>
							<td class="main"><b><?php echo $products['products_name']; ?></b></td>
						  </tr>
<?php
        $counter++;
      }
    } else {
?>
						  <tr>
							<td class="main"><?php echo NOTIFICATIONS_NON_EXISTING; ?></td>
						  </tr>
<?php
    }
?>
						</table></td>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
				</table>
                
<?php echo tep_draw_infoBox_bottom();?>

	                </td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
<?php
  }
?>
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
