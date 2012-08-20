<?php
/*
  $Id: reviews.php,v 1.37 2003/06/09 22:20:28 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- reviews //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_REVIEWS);

  new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_REVIEWS));

  $random_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name, pd.Brand, pd.Gender, pd.Gamme, pd.Prix_achat, pd.Note, pd.Annee, pd.Item_size from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'";
  if (isset($HTTP_GET_VARS['products_id'])) {
    $random_select .= " and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'";
  }
  $random_select .= " order by r.reviews_id desc limit " . MAX_RANDOM_SELECT_REVIEWS;
  $random_product = tep_random_select($random_select);
  
  
  
  $info_box_contents = array();

  if ($random_product) {
// display random review box
    $rand_review_query = tep_db_query("select substring(reviews_text, 1, 60) as reviews_text from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$random_product['reviews_id'] . "' and languages_id = '" . (int)$languages_id . "'");
    $rand_review = tep_db_fetch_array($rand_review_query);

    $rand_review_text = tep_break_string(tep_output_string_protected($rand_review['reviews_text']), 15, '-<br>');
	
	 $name_prod = '<span><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . '&reviews_id=' . $random_product['reviews_id']) . '">' . $random_product['products_name']. '...</a></span><br />';
	 
	 $review_prod = substr(strip_tags($rand_review_text),0,MAX_DESCR_REVIEWS) ;

	 $pic_prod = '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . '&reviews_id=' . $random_product['reviews_id']) . '">' . tep_image(DIR_WS_PWS_IMAGE . $random_product['products_image'], $random_product['products_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</a>';

    $info_box_contents[] = array('text' => '
	
									<table cellspacing="0" cellpadding="0" align="center" border="0">
										<tr><td align="center" class="vam"><br style="line-height:1px;"><br style="line-height:5px;">'.tep_draw_box_prod_top().''.$pic_prod.''.tep_draw_box_prod_bottom().'<br style="line-height:5px;">
										</td></tr>
										<tr><td height="38" class="vam" align="center">'.$name_prod.'
											<br style="line-height:1px;"><br style="line-height:5px;">
											'.$review_prod.'
											</td></tr>
										<tr><td align="center"><br style="line-height:1px;"><br style="line-height:5px;">
' . tep_image(DIR_WS_IMAGES . 'stars_' . $random_product['reviews_rating'] . '.gif' , sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $random_product['reviews_rating'])) . '										
										<br style="line-height:1px;"><br style="line-height:5px;"></td></tr>
									</table>								 
									');
									
  } elseif (isset($HTTP_GET_VARS['products_id'])) {
// display 'write a review' box
    $info_box_contents[] = array('text' => '
	
	<table border="0" cellspacing="5" cellpadding="0">
		<tr><td class=""><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $HTTP_GET_VARS['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'box_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a></td>
			<td width="100%"><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $HTTP_GET_VARS['products_id']) . '">' . BOX_REVIEWS_WRITE_REVIEW .'</a></td>
		</tr>
	</table>
	');
  } else {
// display 'no reviews' box
    $info_box_contents[] = array('text' => '
							<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr><td>'.BOX_REVIEWS_NO_REVIEWS.'</td></tr>
							</table>');
  }

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- reviews_eof //-->
