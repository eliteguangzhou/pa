<?php
/*
  $Id: create_account_success.php,v 1.30 2003/06/05 23:27:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);
  $breadcrumb->add(NAVBAR_TITLE_2);

  if (sizeof($navigation->snapshot) > 0) {
    $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
    $navigation->clear_snapshot();
  } else {
    $origin_href = tep_href_link(FILENAME_DEFAULT);
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
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
   </td>
<!-- body_text //-->
    <td width="100%" class="col_center"><?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>

<?php tep_draw_heading_top('');?>
		
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_1();?>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <!--<td><?php //echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE); ?></td>-->
            <td valign="top">
			
			<table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr><td class="main smalltext"><?php echo sprintf(TEXT_ACCOUNT_CREATED, isset($_SESSION['customer_login']) ? $_SESSION['customer_login'] : '', isset($_SESSION['customer_pass']) ? $_SESSION['customer_pass'] : '');tep_session_unregister('customer_login');tep_session_unregister('customer_pass'); ?></td></tr>
            </table>
			
			</td>
          </tr>
        </table>
		
		<table cellpadding="0" cellspacing="0" border="0"><tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr></table>
            
<?php /*  echo tep_draw_infoBox_top();  */?>
	
			<table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . $origin_href . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table>
            
<?php /*  echo tep_draw_infoBox_bottom();  */?>

	<?php tep_draw_heading_bottom_1();?>
      		
<?php tep_draw_heading_bottom();?>
	
		</td>
      </tr>
    </table></td>
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

<?php if ($check_server == 'es') { ?>
<!-- Google Code for Cr&eacute;a Compte - Perfumes ES Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1024320665;
var google_conversion_language = "es";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "xC54CKnF3AIQmcm36AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1024320665/?label=xC54CKnF3AIQmcm36AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } elseif ($check_server == 'it') {?>
<!-- Google Code for Cr&eacute;a Compte - Profumi IT Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1024320665;
var google_conversion_language = "it";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "sHuvCKHG3AIQmcm36AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1024320665/?label=sHuvCKHG3AIQmcm36AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
