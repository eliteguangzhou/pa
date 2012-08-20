<?php
/*
  $Id: best_sellers.php,v 1.21 2003/06/09 22:07:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (isset($current_category_id) && ($current_category_id > 0)) {
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  } else {
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  }

  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- best_sellers //-->
          <tr>
            <td valign="top">
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_BESTSELLERS);

    new infoBoxHeading2($info_box_contents, false, false);
?>


<?php
    $rows = 0;
    $bestsellers_list = '<ul>';
    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
if ($count ==0 ) $kk=' class="bg_list"'; else $kk=' class="bg_list"';

 	$count++;
	$bestsellers_list .= '<li'.$kk.'><a href="'.$best_sellers['products_id']. '-p-' .str_replace(' ','_',$best_sellers['products_name']).'.html">' .
	substr(strip_tags($best_sellers['products_name']),0,MAX_DESCR_BESTS) .
	'</a></li>';
}
			   $bestsellers_list .= '</ul>';




    $info_box_contents = array();
    $info_box_contents[] = array('text' => $bestsellers_list);

    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- best_sellers_eof //-->
<?php
  }
?>
