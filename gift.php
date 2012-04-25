<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:37:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
    //Recuperation des produits cadeaux
    $product_query = tep_db_query('select p.products_id, p.products_quantity, p.products_image, p.products_tax_class_id, pd.products_name, p.products_price, p2c.categories_id, products_description, pd.Brand, pd.Gender, pd.Gamme, pd.Prix_conseille, pd.Type, pd.Prix_achat, pd.Note, pd.Annee, pd.Item_size from ' . TABLE_PRODUCTS . ' p, ' . TABLE_PRODUCTS_DESCRIPTION . ' pd, ' . TABLE_PRODUCTS_TO_CATEGORIES . ' p2c where  p.products_id = p2c.products_id and p.products_status = "1" and p.products_id = pd.products_id and pd.language_id = "' . (int)$languages_id . '" AND products_model IN ('.GIFT_MODELS.')');
    $info_box_contents2 = array();
  $row = 0;
  $col = 0;
    while($product = tep_db_fetch_array($product_query)) {
    
    $p_id = $product['products_id'];

    $p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $product['categories_id'].'&products_id=' . $product['products_id']) . '">' . tep_image(DIR_WS_PWS_IMAGE . $product['products_image'], $product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';

    $p_desc = ''.substr(strip_tags($product['products_description']), 0, MAX_DESCR_1).' ...';

    $p_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $product['categories_id'].'&products_id=' . $product['products_id']) . '">' .display_product_name($product['products_name'] , $product).'</a>';

    $p_price = '<span class="productSpecialPrice">'.$currencies->display_price(get_price($product['products_price']), tep_get_tax_rate($product['products_tax_class_id'])).'</span>';


    $info_box_contents2[$row][$col] = array('align' => 'center',
                                           'params' => 'style="width:34%;"',
                                           'text' => '
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="height:86px;">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td>
                        <td class="products_gender">'.display_gender($product['Gender'], false).'</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border:1px solid #FFFFFF; border-width:0 15px 0 0px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="height:40px " class="vam"><span>'.$p_name.'</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>');

    $col ++;
    if ($col > 2) {
      $col = 0;
      $row ++;
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GIFT);
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
    <td valign="top" class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->

    <td width="100%" class="col_center">



<?php /* require(DIR_WS_BOXES . 'panel_top.php'); */ ?>


<?php tep_draw_heading_top($cPath);?>

<?php tep_draw_heading_top_3();?>

<?php echo '<br /><h2 class="text_rose">'.TEXT_TITLE.'</h2>'.TEXT_INFO1.'<br />';

new contentBox($info_box_contents2);

echo '<br />'.TEXT_INFO2; ?>

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
