<?php
/*
  $Id: product_notifications.php,v 1.8 2003/06/09 22:19:07 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (isset($HTTP_GET_VARS['products_id'])) {
?>
<!-- notifications //-->
          <tr>
            <td>
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_NOTIFICATIONS);

    new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL'));

    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }
	
$link_2 = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($HTTP_GET_VARS['products_id'])) .'</a>';

    $info_box_contents = array();
    if ($notification_exists == true) {
      $info_box_contents[] = array('text' => '
	<table cellpadding="0" cellspacing="0" border="0">
		<tr><td>
			<table border="0" cellspacing="5" cellpadding="0">
				<tr>
					<td><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'box_products_notifications_remove.gif', IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a></td>
					<td><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, tep_get_products_name($HTTP_GET_VARS['products_id'])) .'</a></td>
				</tr>
			</table>
		</td></tr>
	</table>');
    } else {
      $info_box_contents[] = array('text' => '
	<table cellpadding="0" cellspacing="0" border="0">
	  	<tr><td>
			<table border="0" cellspacing="5" cellpadding="0">
				<tr><td><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . tep_image(DIR_WS_IMAGES . 'box_products_notifications.gif', IMAGE_BUTTON_NOTIFICATIONS) . '</a></td>
					<td style=" width:100%;">'.$link_2.'</td>
				</tr>
			</table>
		</td></tr>
	</table>');
    }

    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- notifications_eof //-->
<?php
  }
?>
