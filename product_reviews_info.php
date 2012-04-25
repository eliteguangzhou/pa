<?php
/*
  $Id: product_reviews_info.php,v 1.50 2003/06/20 14:25:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (isset($HTTP_GET_VARS['reviews_id']) && tep_not_null($HTTP_GET_VARS['reviews_id']) && isset($HTTP_GET_VARS['products_id']) && tep_not_null($HTTP_GET_VARS['products_id'])) {
    $review_check_query = tep_db_query("select count(*) as total from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "' and r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");
    $review_check = tep_db_fetch_array($review_check_query);

    if ($review_check['total'] < 1) {
      tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
    }
  } else {
    tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
  }

  tep_db_query("update " . TABLE_REVIEWS . " set reviews_read = reviews_read+1 where reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "'");

  $review_query = tep_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, p.products_id, p.products_price, p.products_tax_class_id, p.products_image, p.products_model, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where r.reviews_id = '" . (int)$HTTP_GET_VARS['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and r.products_id = p.products_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '". (int)$languages_id . "'");
  $review = tep_db_fetch_array($review_query);

  if ($new_price = tep_get_products_special_price($review['products_id'])) {
    $products_price = '<s>' . $currencies->display_price($review['products_price'], tep_get_tax_rate($review['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($review['products_tax_class_id'])) . '</span>';
  } else {
    $products_price = $currencies->display_price($review['products_price'], tep_get_tax_rate($review['products_tax_class_id']));
  }

  if (tep_not_null($review['products_model'])) {
    $products_name = $review['products_name'] . '<br><span class="smallText">[' . $review['products_model'] . ']</span>';
  } else {
    $products_name = $review['products_name'];
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS_INFO);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
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
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			
<tr><td> 
<?php /*
<?php echo $products_name; ?>
*/ ?>
<?php tep_draw_heading_top();?>

<?php echo tep_draw_title_top();?>

			<?php echo $products_name; ?>
			
<?php echo tep_draw_title_bottom();?>

<?php tep_draw_heading_top_1();?>
								
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="100%">
					<table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td class="product"><?php echo '<em style="text-decoration:none;text-transform:none;">' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($review['customers_name'])) . '</em>'; ?></td>
						<td class="smallText" align="right">&nbsp;<?php echo sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_long($review['date_added'])); ?></td>
					  </tr>
					</table>
					<br style="line-height:1px;"><br style="line-height:10px;">
  <table border="0" cellspacing="0" cellpadding="2" class="product">
              <tr>
                <td align="center">
<?php
  if (tep_not_null($review['products_image'])) {
?>
												
												
												<table cellpadding="0" cellspacing="0" border="0" align="left" class="prod_info">
													<tr><td align="center" class="pic">
													
<?php   echo tep_draw_prod_pic_top();?>													
													
												<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $review['products_id']) . '\\\')">' . tep_image(DIR_WS_PWS_IMAGE . $review['products_image'], addslashes($review['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="0" vspace="0"') . '</a>'; ?>');
//--></script>

<?php  echo tep_draw_prod_pic_bottom(); ?>

</td></tr>
<tr><td align="center"><script language="javascript"><!--
document.write('<?php echo '<div><a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $review['products_id']) . '\\\')">'.TEXT_CLICK_TO_ENLARGE.'</a></div>'; ?>');
//--></script></td></tr>

												</table>												
												
				

<?php
  }
?>
                </td>

              <td height="10"><?php echo tep_draw_separator('spacer.gif', '1', '1'); ?></td>
				<td align="right" width="100%"><a href="<?php tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now')?>"><?php tep_image_button('button_add_to_cart.gif', IMAGE_BUTTON_IN_CART)?></a></td></tr>
            </table>
				<br style="line-height:1px;"><br style="line-height:10px;">
					<table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                       
                        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params()) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                        <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review1.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?></td>
                      </tr>
                    </table>
					
				</td>
				
              </tr>

            </table>
			
			
          </td>
        </table></td></tr>
		
      	</table>
 
<?php tep_draw_heading_bottom_1();?>
      		
<?php tep_draw_heading_bottom();?>
	
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
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
