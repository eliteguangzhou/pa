<?php
/*
  $Id: products_new.php,v 1.27 2003/06/09 22:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_NEW);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCTS_NEW));
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
    <td width="100%" class="col_center">
	
<?php   /*  require(DIR_WS_BOXES . 'panel_top.php');  */  ?>

<?php tep_draw_heading_top();?>
	
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_3();?>
		
<?php
  $products_new_array = array();

  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC, pd.products_name";

  $products_new_split = new splitPageResults($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '2'))) {
?>
<?php echo tep_draw_result_top_1(); ?>		
		<table border="0" cellspacing="0" cellpadding="0" class="result">
          <tr>
            <td><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td class="result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>

<?php echo tep_draw_result_top(); ?>
<?php echo tep_draw_result_bottom_1(); ?>			  				
			  				
<?php
  }
?>
<?php
  if ($products_new_split->number_of_rows > 0) {
    $products_new_query = tep_db_query($products_new_split->sql_query);
   
   
   
   
   
   
   
   
   
   $row = 0;
  $col = 0;
  $info_box_contents = array();
  while ($products_new = tep_db_fetch_array($products_new_query)) {
 
 $product_query = tep_db_query("select products_description, products_id, Brand, Gender, Gamme, Prix_achat, Note, Annee, Item_size from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_new['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
      $product = tep_db_fetch_array($product_query);

       	$p_desc = substr(strip_tags($product['products_description']), 0, MAX_DESCR_1);
        $p_id = $product['products_id'];
		$p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">' . tep_image(DIR_WS_PWS_IMAGE . $products_new['products_image'], $products_new['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
		$p_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">' .display_product_name($products_new['products_name'], $product) . '</a>';
		

 
   if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
        $products_price = '<s>' . $currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
      } else {
        $products_price = '<span class="productSpecialPrice">'.$currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id']).'</span>');
      }
	  
	$p_price = $products_price;
	
    $products_new['products_name'] = tep_get_products_name($products_new['products_id']);
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
                                    <td style="height:40px " class="vam"><span>'.$p_name.'</sppan></td>
                                </tr>
                                <tr>
                                    <td style="height:26px " class="vam">'.$p_price.'</td>
                                </tr>
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
   
  } else  {
?>
				  <table border="0" cellspacing="0" cellpadding="0" class="box_width_cont">
					  <tr><td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td></tr>
					  <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
				  </table>
<?php
  }
?>

			  
<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<?php echo tep_draw_result_bottom(); ?>
<?php echo tep_draw_result_top_2(); ?>        
        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="result">
          <tr>
            <td><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td class="result_right"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
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