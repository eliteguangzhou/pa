<?php
/*
  $Id: specials.php,v 1.49 2003/06/09 22:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPECIALS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SPECIALS));
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
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->
    <td width="100%" class="col_center">
	
<?php   /*  require(DIR_WS_BOXES . 'panel_top.php');  */  ?>

<?php tep_draw_heading_top(901);?>
	
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_3();?>		

<?php
  $specials_query_raw = "select p.products_quantity, p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC";
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);

  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '2'))) {
?>
<?php echo tep_draw_result_top_1(); ?>        
		<table border="0" width="100%" cellspacing="0" cellpadding="0" class="result box_width_cont">
          <tr>
            <td><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
            <td class="result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
<?php echo tep_draw_result_bottom_1(); ?>        
<?php echo tep_draw_result_top(); ?>
			  		
<?php
  }
?>

<?php
    $row = 0;
    $specials_query = tep_db_query($specials_split->sql_query);

  $row = 0;
  $col = 0;
  $info_box_contents = array();
   while ($specials = tep_db_fetch_array($specials_query)) {
    $specials['products_name'] = tep_get_products_name($specials['products_id']);
// ----------	
	$product_query = tep_db_query("select products_description, products_id, Brand, Gender, Gamme, Prix_achat, Note, Annee, Item_size, Prix_conseille, Type from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$specials['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
	$product = tep_db_fetch_array($product_query);
	$p_desc = substr(strip_tags($product['products_description']), 0, MAX_DESCR_1) . '<br />' .strip_tags($product['Item_size']). '<br />[' . strip_tags($product['product_id']) . ']';
	$p_id = $product['products_id'];
	
	$p_pic = '<a href="' . $specials['products_id'] . '-p-'.str_replace(' ','_',$specials['products_name']) . '.html">' . tep_image(DIR_WS_PWS_IMAGE . $specials['products_image'], $specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	
	$p_name = '<a href="' . $specials['products_id'] . '-p-'.str_replace(' ','_',$specials['products_name']) . '.html">' .display_product_name($specials['products_name'], $product)  .'</a>';
	
	$p_price = '<span class="productSpecialPrice">'.$currencies->display_price($specials['specials_new_products_price'],'').'</span> <s>'.$currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])).'</s>';
	
// ----------	
    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'style="width:50%;"',
                                           'text' => '
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="height:86px;">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #FFFFFF; border-width:0 0 0 15px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="height:40px " class="vam"><span>'.$p_name.'</span></td>
                                </tr>
                                <tr>
                                    <td class="vam product_price">'.$p_price.'</td>
                                </tr>
                                '.(
                                $product['Prix_conseille'] > $product['Prix_achat'] && $check_server != 'en'
                                ? '<tr>
                                    <td class="instead_of">'.TEXT_INSTEAD_OF.' '.$currencies->display_price(get_adviced_price($product['Prix_conseille']), tep_get_tax_rate($specials['products_tax_class_id'])).'</td>
                                </tr>'
                                : '').
                                (
                                $specials['products_quantity'] > 0
                                ? '<tr><td class="en_stock">'.TEXT_EN_STOCK.'</td></tr>'
                                : ''
                                ).'
                                <tr>
                                    <td style="height:47px "><a href="' . tep_href_link('product_info.php?products_id='.$p_id) . '">'.tep_image_button("button_details.gif").'</a><br />'.tep_draw_separator('spacer.gif', '1', '3').'</td>
                                </tr>
                            </table> 
                        </td>
                    </tr>
                </table>');

    $col ++;
    if ($col > 1) {
      $col = 0;
      $row ++;
    }
  }

  new contentBox($info_box_contents);

?>

			  
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<?php echo tep_draw_result_bottom(); ?>
<?php echo tep_draw_result_top_2(); ?>        
     	<table border="0" cellspacing="0" cellpadding="0" class="result box_width_cont">
          <tr>
            <td><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
            <td class="result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
<?php echo tep_draw_result_bottom_2(); ?>                
<?php
  }
?>

<?php tep_draw_heading_bottom_3();?>   
	
<?php tep_draw_heading_bottom();?>

	</td>
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
