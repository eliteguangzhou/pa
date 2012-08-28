<?php
/*
  $Id: catalog/admin/comment8r.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/
  require('includes/application_top.php');
  $arr_model_info = $arr_prodid_info = $arr_prod_name = $arr_auth = $arr_tit = $arr_mess = $arr_dat = $arr_msg_ids = $arr_glob_sets = array();

  $products = tep_db_query("select p.products_id, p.products_model, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
				
  while ($products_values = tep_db_fetch_array($products)) {
  	$arr_model_info[] = $products_values['products_name'];
  	$arr_prodid_info[] = $products_values['products_id'];
  }
  
  require(DIR_WS_CLASSES . 'comment8r/delegate.php');
	$delegate = new delegate();
	
  $messages = $delegate->getAllMessages();
  while ($message = @tep_db_fetch_array($messages)) {
  	$arr_prod_name[] = $message['product_id'];
	  $arr_auth[] = $message['name'];
	  $arr_tit[] = $message['msg_title'];
	  $arr_mess[] = $message['msg'];
	  $arr_dat[] = $message['msg_date']; 
	  $arr_msg_ids[] = $message['msg_id'];
	}
  
  $arr_glob_sets = $delegate->getGlobSets();
  
  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
	
  if (tep_not_null($action)) {
	
	  switch ($action) {
	  	
	  	case 'save_new_msg':
	  		$delegate->saveNewMessage($HTTP_GET_VARS);
	  	break;	  
	  	
	  	case 'delete_msg':
	  		$delegate->deleteMessage($HTTP_GET_VARS['msg_id']);
	  	break;	
	  	
	  	case 'update_msg':
	  		$delegate->updateMessage($HTTP_GET_VARS);
	  	break;
	  	case 'update_global_sets':
	  		$delegate->updateGlobSets($HTTP_GET_VARS);
	  	break;
	  }	  
	}	
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/comment8r.js"></script>
<!-- this block is to populate the dropdowns -->
<script language="JavaScript">
var product_names = new Array();
var product_ids = new Array();

var msg_product_ids = new Array();
var msg_auth = new Array();
var msg_tit = new Array();
var msg_mess = new Array();
var msg_dat = new Array();
var msg_ids = new Array();
var glob_sets = new Array();
<?php
foreach($arr_glob_sets as $key => $value){
	echo 'glob_sets["' . $key . '"] = "'. $value .'";';
}
for ($i=0; $i < count($arr_msg_ids); $i++) {
echo 'msg_ids['.$i.']= "'. $arr_msg_ids[$i] .'";';
}
for ($i=0; $i < count($arr_prod_name); $i++) {
echo 'msg_product_ids['.$i.']= "'. $arr_prod_name[$i] .'";';
}
for ($i=0; $i < count($arr_auth); $i++) {
	
	$msge = $arr_auth[$i];
				
$msge = preg_replace("/(\r\n¦\n¦\r)/", "\n", $msge); 
$msge = preg_replace("/\n\n+/", "\n\n", $msge); 
$msge = preg_replace('/\n?(.+?)(\n\n¦\z)/s', "<p>$1</p>", $msge);
$msge = preg_replace('¦(?<!</p>)\s*\n¦', "<br />", $msge);

echo 'msg_auth['.$i.']= "'. $msge .'";';
}
for ($i=0; $i < count($arr_tit); $i++) {
	
$msge = $arr_tit[$i];
				
$msge = preg_replace("/(\r\n¦\n¦\r)/", "\n", $msge); 
$msge = preg_replace("/\n\n+/", "\n\n", $msge); 
$msge = preg_replace('/\n?(.+?)(\n\n¦\z)/s', "<p>$1</p>", $msge);
$msge = preg_replace('¦(?<!</p>)\s*\n¦', "<br />", $msge);

echo 'msg_tit['.$i.']= "'. $msge .'";';
}
for ($i=0; $i < count($arr_mess); $i++) {
	
$msge = $arr_mess[$i];
$msge = str_replace('"','',$msge);				
$msge = preg_replace("/(\r\n¦\n¦\r)/", "\n", $msge); 
$msge = preg_replace("/\n\n+/", "\n\n", $msge); 
$msge = preg_replace('/\n?(.+?)(\n\n¦\z)/s', "<p>$1</p>", $msge);
$msge = preg_replace('¦(?<!</p>)\s*\n¦', "<br />", $msge);
				
echo 'msg_mess['.$i.']= "'. stripslashes($msge) .'";';
}
for ($i=0; $i < count($arr_dat); $i++) {
echo 'msg_dat['.$i.']= "'. $arr_dat[$i] .'";';
}

for ($i=0; $i < count($arr_model_info); $i++) {
echo 'product_names['.$i.']= "'. str_replace('"', '\"',$arr_model_info[$i]) .'";';
}
for ($i=0; $i < count($arr_prodid_info); $i++) {
echo 'product_ids['.$i.']= "'. $arr_prodid_info[$i] .'";';
}
?>
</script>


</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    	<table border="0" width="100%" cellspacing="0" cellpadding="0">
<!--  //BODY OF HTML HERE!!!!! -->

<tr>
					<td align="center" width="100%">
					<table width="100%">
					<tr>
					<td align="left" class="smallText">
  					<table border="1" rules="none" frame="box">
  						<tr><td style="font-size: 12;font-weight: bold;" align="center"><?php echo C8R_OPTIONS; ?></td>
  						</tr>
  						<tr><td><a href="javascript:clear_scrn();"><?php echo C8R_CLEAR; ?></a></td>
  						</tr>
  						<tr><td><a href="javascript:new_msg();"><?php echo C8R_CREATE_MESS; ?></a></td>
  						</tr> 	
  						<tr><td><a href="javascript:show_all_msg(msg_product_ids,msg_auth,msg_tit,msg_mess,msg_dat);"><?php echo C8R_VIEW_ALL; ?></a></td>
  						</tr>
  						<tr><td><a href="javascript:show_glob_sets();"><?php echo C8R_EDIT_SETS; ?></a></td>
  						</tr>					
  					</table>
  				</td>
					
					
					<td width="80%" align="center" class="pageHeading"><?php echo C8R_TITLE; ?>
					</td>
					<td align="right" valign="top" class="smallText">
  					<table border="1" rules="none" frame="box">
  						<tr><td><a target="_blank" href="http://www.open-source-services.com/Products/OSS-Premium-Add-Ons/easyCommentz-v1.0-PLUS-for-osCommerce.html"><?php echo C8R_UPGRADE; ?></a></td>
  						</tr>
  						<tr><td><a target="_blank" href="http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/"><?php echo C8R_SUPPORT; ?></a></td>
  						</tr> 						
  					</table>
  				</td>
  				</tr>
  				</table>
  				</td>
				</tr>
				
				<tr>
					<td align="center">
						<span id="new_msg"></span>
					</td>
				</tr>
				<tr>
					<td align="center">
						<span id="edit_msg"></span>
					</td>
				</tr>
				<tr>
					<td align="center">
						<span id="display_msgs"></span>
					</td>
				</tr>
				<tr>
					<td align="center">
						<span id="display_glob_sets"></span>
					</td>
				</tr>

<!--  //END OF BODY OF HTML!!!!! -->
<tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      
  </table>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>