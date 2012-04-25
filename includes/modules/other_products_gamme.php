<?php
/*
  $Id: also_purchased_products.php,v 1.21 2003/02/12 23:55:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

global $languages_id, $cPath, $currencies;

        $product_info_query = tep_db_query("
            select
                p.products_id,
                p2c.categories_id,
                p.products_quantity,
                pd.products_name,
                pd.Prix_conseille,
                pd.Brand,
                pd.Gender,
                pd.Gamme,
                pd.Prix_achat,
                pd.Note,
                pd.Annee,
                pd.Item_size,
                pd.products_description,
                p.products_model,
                p.products_image,
                pd.products_url,
                p.products_price,
                p.products_tax_class_id,
                p.products_date_added,
                p.products_date_available,
                p.manufacturers_id
            from
                " . TABLE_PRODUCTS . " p,
                " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            where   p.products_status = '1'
            and ".(!$is_cat ? "p.products_id"  : "p2c.categories_id")." != '" . $product_info['products_id'] . "'
            and     p.products_id = p2c.products_id
            and pd.products_id = p.products_id
            and pd.language_id = '" . (int)$languages_id . "'
            and pd.Gamme = '".addslashes($product_info['Gamme'])."'"
        );
?>
<!-- also_purchased_products //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('text' => OTHERS_LIST_PRODUCTS);

     
     
     
     //new contentBoxHeading($info_box_contents);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($orders = tep_db_fetch_array($product_info_query)) {
        $orders['products_name'] = tep_get_products_name($orders['products_id']);
        $info_box_contents[$row][$col] = array('align' => 'center',
                                               'params' => 'class="smallText" width="33%" valign="top"',
                                               'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id']) . '">' . tep_image(DIR_WS_PWS_IMAGE . $orders['products_image'], $orders['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $orders['products_id']) . '">' . $orders['products_name'] . '</a>');

        $col ++;
        if ($col > 2) {
          $col = 0;
          $row ++;
        }
      }
if ($info_box_contents[0][0]){
     echo '<fieldset class="product_info_add_modules" ><legend class="related_products_title"><b>'.OTHERS_LIST_PRODUCTS.'</b></legend>';
      new contentBox($info_box_contents);
     echo '</fieldset>';
     }
?>
<!-- also_purchased_products_eof //-->
<?php
    
//   }
?>
