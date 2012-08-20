<?php
/*
  $Id: also_purchased_products.php,v 1.21 2003/02/12 23:55:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if (isset($HTTP_GET_VARS['products_id'])) {
    $orders_query = tep_db_query("select p.products_id, p.products_image, pd.products_description from " . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, " . TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p, ".TABLE_PRODUCTS_DESCRIPTION." pd where opa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and opa.orders_id = opb.orders_id and opb.products_id != '" . (int)$HTTP_GET_VARS['products_id'] . "' and opb.products_id = p.products_id and opb.orders_id = o.orders_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' group by p.products_id order by o.date_purchased desc limit " . MAX_DISPLAY_ALSO_PURCHASED);
   $num_products_ordered = tep_db_num_rows($orders_query);
    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {
?>
<!-- also_purchased_products //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('text' => TEXT_ALSO_PURCHASED_PRODUCTS);

     echo '<fieldset class="product_info_add_modules" ><legend class="related_products_title"><b>'.TEXT_ALSO_PURCHASED_PRODUCTS.'</b></legend>';
     
     
     
     //new contentBoxHeading($info_box_contents);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($orders = tep_db_fetch_array($orders_query)) {
        $orders['products_name'] = tep_get_products_name($orders['products_id']);
        $info_box_contents[$row][$col] = array('align' => 'center',
                                               'params' => 'class="smallText" width="33%" valign="top"',
                                               'text' => '<a href="' . $orders['products_id']. '-p-'.str_replace(' ','_',$orders['products_name']) . '-'.str_replace(' ','_',$orders['products_description'] ). '.html">' . 
                                               tep_image(DIR_WS_PWS_IMAGE . $orders['products_image'], $orders['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>
                                               <a href="' . $orders['products_id']. '-p-'.str_replace(' ','_',$orders['products_name']). '-'.str_replace(' ','_',$orders['products_description'] ) . '.html">' . $orders['products_name'] . '</a>');

        $col ++;
        if ($col > 2) {
          $col = 0;
          $row ++;
        }
      }

      new contentBox($info_box_contents);
     echo '</fieldset>';
?>
<!-- also_purchased_products_eof //-->
<?php
    }
  }
?>
