<?php
/*
  $Id: advanced_search.php,v 1.50 2003/06/05 23:25:46 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="javascript"><!--
function check_form() {
  var error_message = "<?php echo JS_ERROR; ?>";
  var error_found = false;
  var error_field;
  var keywords = document.advanced_search.keywords.value;
  var dfrom = document.advanced_search.dfrom.value;
  var dto = document.advanced_search.dto.value;
  var pfrom = document.advanced_search.pfrom.value;
  var pto = document.advanced_search.pto.value;
  var pfrom_float;
  var pto_float;

  if ( ((keywords == '') || (keywords.length < 1)) && ((dfrom == '') || (dfrom == '<?php echo DOB_FORMAT_STRING; ?>') || (dfrom.length < 1)) && ((dto == '') || (dto == '<?php echo DOB_FORMAT_STRING; ?>') || (dto.length < 1)) && ((pfrom == '') || (pfrom.length < 1)) && ((pto == '') || (pto.length < 1)) ) {
    error_message = error_message + "* <?php echo ERROR_AT_LEAST_ONE_INPUT; ?>\n";
    error_field = document.advanced_search.keywords;
    error_found = true;
  }

  if ((dfrom.length > 0) && (dfrom != '<?php echo DOB_FORMAT_STRING; ?>')) {
    if (!IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dfrom;
      error_found = true;
    }
  }

  if ((dto.length > 0) && (dto != '<?php echo DOB_FORMAT_STRING; ?>')) {
    if (!IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_TO_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if ((dfrom.length > 0) && (dfrom != '<?php echo DOB_FORMAT_STRING; ?>') && (IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) && (dto.length > 0) && (dto != '<?php echo DOB_FORMAT_STRING; ?>') && (IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>'))) {
    if (!CheckDateRange(document.advanced_search.dfrom, document.advanced_search.dto)) {
      error_message = error_message + "* <?php echo ERROR_TO_DATE_LESS_THAN_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if (pfrom.length > 0) {
    pfrom_float = parseFloat(pfrom);
    if (isNaN(pfrom_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_FROM_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pfrom;
      error_found = true;
    }
  } else {
    pfrom_float = 0;
  }

  if (pto.length > 0) {
    pto_float = parseFloat(pto);
    if (isNaN(pto_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  } else {
    pto_float = 0;
  }

  if ( (pfrom.length > 0) && (pto.length > 0) ) {
    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float < pfrom_float) ) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_LESS_THAN_PRICE_FROM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  }

  if (error_found == true) {
    alert(error_message);
    error_field.focus();
    return false;
  } else {
    RemoveFormatString(document.advanced_search.dfrom, "<?php echo DOB_FORMAT_STRING; ?>");
    RemoveFormatString(document.advanced_search.dto, "<?php echo DOB_FORMAT_STRING; ?>");
    return true;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=445,height=500,screenX=150,screenY=150,top=150,left=150')
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
    <td width="100%" class="col_center"><?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onSubmit="return check_form(this);"') . tep_hide_session_id(); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>

<?php tep_draw_heading_top(901);?>

<?php echo tep_draw_title_top();?>

			<?php echo HEADING_TITLE_1;?>
			
<?php echo tep_draw_title_bottom();?>

<?php tep_draw_heading_top_1();?>
								
<?php
  if ($messageStack->size('search') > 0) {
?>
		<table cellpadding="0" cellspacing="0" border="0">
			    <tr><td><?php echo $messageStack->output('search'); ?></td></tr>
      			<tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
		</table>
<?php
  }
?>
            
<?php echo tep_draw_infoBox_top();?>

<?php
  $info_box_contents = array();
//  $info_box_contents[] = array('text' => HEADING_SEARCH_CRITERIA);


  $info_box_contents = array();
  $info_box_contents[] = array('text' => tep_draw_input_field('keywords', '', 'style="width: 100%"').'<br style="line-height:1px;"><br style="line-height:5px;">'.tep_draw_checkbox_field('search_in_description', '1') . ' ' . TEXT_SEARCH_IN_DESCRIPTION);
  //$info_box_contents[] = array('align' => 'right', 'text' => );

  new infoBox_78($info_box_contents);
?>
<?php echo tep_draw_infoBox_bottom();?>

		<br style="line-height:1px;"><br style="line-height:10px;">
		
		<table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText vam"><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?></td>
            <td class="smallText vam bg_input" align="right"><?php echo tep_image_submit('button_search.gif', IMAGE_BUTTON_SEARCH); ?></td>
          </tr>
        </table>
		
	<br style="line-height:1px;"><br style="line-height:10px;">
            
<?php echo tep_draw_infoBox_top();?>
		
		<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="padd_2">
			
				<table border="0" width="100%" cellspacing="4" cellpadding="2">
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_CATEGORIES; ?></td>
					<td class="fieldValue"><?php echo tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)))); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey">&nbsp;</td>
					<td class="smallText"><?php echo tep_draw_checkbox_field('inc_subcat', '1', true) . ' ' . ENTRY_INCLUDE_SUBCATEGORIES; ?></td>
				  </tr>
				  <tr>
					<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_MANUFACTURERS; ?></td>
					<td class="fieldValue"><?php echo tep_draw_pull_down_menu('manufacturers_id', tep_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))); ?></td>
				  </tr>
				  <tr>
					<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_PRICE_FROM; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('pfrom'); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_PRICE_TO; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('pto'); ?></td>
				  </tr>
				  <tr>
					<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_DATE_FROM; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('dfrom', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?></td>
				  </tr>
				  <tr>
					<td class="fieldKey"><?php echo ENTRY_DATE_TO; ?></td>
					<td class="fieldValue"><?php echo tep_draw_input_field('dto', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?></td>
				  </tr>
				</table>
			
			</td>
          </tr>
        </table>
		
<?php echo tep_draw_infoBox_bottom();?>

	<?php tep_draw_heading_bottom_1();?>
      		
<?php tep_draw_heading_bottom();?>
	
		</td>
      </tr>
    </table></form></td>
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
