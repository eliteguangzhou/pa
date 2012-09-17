<?php
/*
  $Id: account_history.php,v 1.63 2003/06/09 23:03:52 hpdl Exp $

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

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_MY_TICKET);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" summary="" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" summary="" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" summary="" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" summary="" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_history.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
        

<?php
// print_r(isset($_GET));
if (!isset($HTTP_GET_VARS['ticket_id'])) { ?>
          <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main" width="80%"><?php echo TITLE_TICKET_NAME; ?></td>
              <td class="main"  width="20%"><?php echo TITLE_TICKET_STATUS; ?></td>
            </tr>
          </table>
          <?php 
  $sql = "SELECT * 
FROM  `ticket` 
INNER join status_ticket on status_ticket.id = status
WHERE  `customer_id` = ".$_SESSION['customer_id'];

$sql = 'SELECT `ticket`.*, status_ticket.values,  count(ticket_message.id) as count FROM `ticket` 
join status_ticket on status_ticket.id = `ticket`.status 
LEFT OUTER JOIN ticket_message ON (ticket_message.ticket_id = ticket.id AND ticket_message.status = 0)
WHERE `customer_id` = '.$_SESSION['customer_id'].' 
 group by ticket.id';
$res = tep_db_query($sql);
$test = TRUE;
$return_file = FILENAME_ACCOUNT;
while ($r =  tep_db_fetch_array($res)) {
  $test = FALSE;
?>
          <table border="0" summary="" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" summary="" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main <?php if ($r['count'] == 0)echo "black_c";?>" width="80%" valign="top"><a href="<?php echo FILENAME_MY_TICKET;?>?ticket_id=<?php echo $r['id'];?>"><?php echo $r['title'];?>
                  <?php 
                  //show how many unread message there is on this tickets
                  if ($r['count'] > 0){
// 		  echo NEW_MESSAGES;
		  echo '<span class="new_message">('.$r['count'].' '.NEW_MESSAGES.')</span>';
                  }
                  ?>                  
                  </a>
                  </td>
                  <td class="main" width="20%"><?php echo $tmp[$r['values']];?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
            </tr>
          </table>
<?php
}
  if ($test) {
?>
          <table border="0" summary="" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" summary="" width="100%" cellspacing="2" cellpadding="4">
                <tr>
                  <td class="main"><?php echo TEXT_NO_TICKETS; ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
<?php
  }
 } //end of the test if there is a specific ticket
 else {
     $tid = $HTTP_GET_VARS['ticket_id'];
     $sql = "SELECT * 
FROM  `ticket_message` 
WHERE  `ticket_id` = ".$tid;
$res = tep_db_query($sql);
 $return_file = FILENAME_MY_TICKET;
 while ($r =  tep_db_fetch_array($res)) {
?>
<table border="0" summary="" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td><table border="0" summary="" width="100%" cellspacing="2" cellpadding="4">
                <tr class="<?php if ($r['status'] == 0) { echo 't_message_unread'; } ?>">
                  <td class="main " width="20%" valign="top"><?php echo $r['from'].'<br/>'.$r['date_creation'];?>                
                  </a>
                  </td>
                  <td class="main" width="80%"><?php echo $r['message'];?></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
            </tr>
          </table>

<?php } }?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" summary="" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo '<a href="' . tep_href_link($return_file, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" summary="" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
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
