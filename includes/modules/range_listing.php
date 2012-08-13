<?php
/*
  $Id: product_listing.php,v 1.44 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>

<?php echo tep_draw_title_top();?>

				<?php echo $breadcrumb->trail(' &raquo; ')?>

<?php echo tep_draw_title_bottom();?>

<? tep_draw_heading_top_3();?>

<?php
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS_RANGE, 'pd.Gamme');

  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '2') ) ) {

  ?>
<?php echo tep_draw_result_top_1(); ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="result">
  <tr>
    <td><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RANGES); ?></td>
    <td class="result_right" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php echo tep_draw_result_bottom_1(); ?>
<?php echo tep_draw_result_top(); ?>

<?php
  }

$info_box_contents = array();
$my_row = 0;
$my_col = 0;

  if ($listing_split->number_of_rows > 0) {
  $string_query = get_url_cPath2();
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
        $rows++;

        $product_query = tep_db_query("select products_description, products_id, Brand, Gender, Gamme, Prix_achat, Note, Annee, Item_size from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$listing['products_id'] . "' and language_id = '" . (int)$languages_id . "' group by Gamme");
        $product = tep_db_fetch_array($product_query);


        for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {


            $lc_align = '';

            switch ($column_list[$col]) {
              case 'PRODUCT_LIST_MODEL':
                $lc_align = '';
                $lc_text = '&nbsp;' . $listing['products_model'] . '&nbsp;';
                break;
              case 'PRODUCT_LIST_NAME':
		$string_query2 = get_url_cPath2_urlre2($HTTP_GET_VARS);
                $lc_align = '';
                $p_name = $lc_text = '<a href="' . $string_query2.'-m-'.$listing['products_id'] . '-'. $listing['Gamme'].'html">' . $listing['Gamme'] . '</a>';

                break;
              case 'PRODUCT_LIST_MANUFACTURER':
                $lc_align = '';
                $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] . '</a>&nbsp;';
                break;
              case 'PRODUCT_LIST_PRICE':
                $lc_align = 'right';
                if (tep_not_null($listing['specials_new_products_price'])) {
               $p_price = $lc_text = '<s>' .  $currencies->display_price(get_price($listing['products_price']), tep_get_tax_rate($listing['products_tax_class_id'])) . '</s>&nbsp; <span class="productSpecialPrice">' . $currencies->display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>';
                } else {
               $p_price = $lc_text = '<span class="productSpecialPrice">' . $currencies->display_price(get_price($listing['products_price']), tep_get_tax_rate($listing['products_tax_class_id'])) . '</span>';
                }
                break;
              case 'PRODUCT_LIST_QUANTITY':
                $lc_align = 'right';
                $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
                break;
              case 'PRODUCT_LIST_WEIGHT':
                $lc_align = 'right';
                $lc_text = '&nbsp;' . $listing['products_weight'] . '&nbsp;';
                break;
              case 'PRODUCT_LIST_IMAGE':
                $lc_align = 'center';
                  $p_pic = '<a href="' . $string_query2.'-m-'.$listing['products_id'] . '-'. $listing['Gamme'].'html">' . tep_image(DIR_WS_PWS_IMAGE . $listing['products_image'], $listing['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
                break;
              case 'PRODUCT_LIST_BUY_NOW':
                $lc_align = 'center';
                $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;';
                break;
            }


           	$p_desc = substr(strip_tags($product['products_description']), 0, MAX_DESCR_1);
            $p_id = $product['products_id'];
     }

 $info_box_contents[$my_row][$my_col] = array('align' => 'center',
                                           'params' => 'style="width:50%;"',
                                           'text' => '
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="height:86px;">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td>
                        <td style="border:1px solid #FFFFFF; border-width:0 15px 0 0;">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="height:25px " class="vam range" valign="middle" align="center"><span>'.$p_name .'</span></td>
                                </tr>
                                <tr>
                                    <td style="height:30px;vertical-align:top; " class="vam" align="center"><span>'.TEXT_PRICE_FROM.' '.$currencies->display_price(get_price($listing['min_price']), tep_get_tax_rate($listing['products_tax_class_id'])).'</span></td>
                                </tr>
                                <tr>
                                    <td style="height:47px " align="center" valign="middle" ><a href="' . $string_query2.'-m-'.$listing['products_id'] . '-'. $listing['Gamme'].'html">'.tep_image_button("button_products_list.gif").'</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>');

    $my_col ++;
    if ($my_col > 1) {//paramètre le nbr de colonnes

      $my_col = 0;
 	$my_row ++;
      }
    }

new contentBox($info_box_contents);
 } else {  ?>

<br style="line-height:11px;">



				<table cellpadding="0" cellspacing="0" class="product">
					<tr><td class="padd_22"><?php echo TEXT_NO_PRODUCTS ?></td></tr>
				</table>


<br style="line-height:1px;"><br style="line-height:10px;">
<?php
  }
  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>

<?php echo tep_draw_result_bottom();
echo tep_draw_result_top_2(); ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="result">
  <tr>
    <td><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_RANGES); ?></td>
    <td class="result_right" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php echo tep_draw_result_bottom_2();
  }
?>
