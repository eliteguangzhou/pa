<?php
/*
  $Id: new_products.php,v 1.34 2003/06/09 22:49:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));

//  new contentBoxHeading($info_box_contents);

  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("
        select
            p.products_id,
            p.products_model,
            p.products_quantity,
            p.products_image,
            p.products_tax_class_id,
            pd.products_name,
            p.products_price,
            p2c.categories_id,
            pd.products_description,
            pd.Brand,
            pd.Gender,
            pd.Gamme,
            pd.Prix_conseille,
            pd.Type,
            pd.Prix_achat,
            pd.Note, pd.Annee,
            pd.Item_size
        from
            " . TABLE_PRODUCTS . " p,
            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
            " . TABLE_SELECTIONS . " s
        where  p.products_id = p2c.products_id
        and p.products_status = '1'
        and p.products_id = pd.products_id
        and pd.language_id = '" . (int)$languages_id . "'
        and p.products_quantity > 2
        and s.products_model = p.products_model
        and s.type = 'prix_en_folie'
        order by p.products_date_added desc
        limit " . MAX_DISPLAY_NEW_PRODUCTS);
  } else {
    $new_products_query = tep_db_query("
        select distinct
            p.products_id,
            p.products_model,
            p.products_quantity,
            p.products_image,
            p.products_tax_class_id,
            pd.products_name,
            p.products_price,
            p2c.categories_id,
            pd.products_description,
            pd.Brand,
            pd.Gender,
            pd.Gamme,
            pd.Prix_conseille,
            pd.Type,
            pd.Prix_achat
        from
            " . TABLE_PRODUCTS . " p,
            " . TABLE_PRODUCTS_DESCRIPTION . " pd,
            " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
            " . TABLE_CATEGORIES . " c
        where p.products_id = p2c.products_id
        and p2c.categories_id = c.categories_id
        and c.parent_id = '" . (int)$new_products_category_id . "'
        and p.products_status = '1'
        and p.products_id = pd.products_id
        and pd.language_id = '" . (int)$languages_id . "'
        and p.products_quantity > 2
        order by p.products_date_added desc
        limit " . MAX_DISPLAY_NEW_PRODUCTS);
  }

  $row = 0;
  $col = 0;

  $info_box_contents = array();
  while ($new_products = tep_db_fetch_array($new_products_query)) {
  
  $p_pic = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $new_products['categories_id'].'&products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_PWS_IMAGE . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';

  $p_desc = ''.substr(strip_tags($new_products['products_description']), 0, MAX_DESCR_1).' ...';

  $p_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $new_products['categories_id'].'&products_id=' . $new_products['products_id']) . '">' .display_product_name($new_products['products_name'] , $new_products).'</a>';

  $p_price = '<span class="productSpecialPrice">'.$currencies->display_price(get_price($new_products['products_price']), tep_get_tax_rate($new_products['products_tax_class_id'])).'</span>';

    $advised_price = get_adviced_price($new_products['Prix_conseille'], $new_products['products_model']);

    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'style="width:34%;"',
                                           'text' => '
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td style="height:86px;">'.tep_draw_prod_pic_top().''.$p_pic.''.tep_draw_prod_pic_bottom().'</td>
                        <td class="products_gender">'.display_gender($new_products['Gender'], false).'</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border:1px solid #FFFFFF; border-width:0 15px 0 0px;">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="height:40px " class="vam"><span>'.$p_name.'</span></td>
                                </tr>
                                <tr>
                                    <td class="product_price">'.MEMBER_PRICE.$p_price.'</td>
                                </tr>
                                '.(
                                $advised_price > $new_products['products_price'] && $check_server != 'en'
                                ? '
                                <tr>
                                    <td class="vam instead_of">'.TEXT_INSTEAD_OF.' '.$currencies->display_price($advised_price, tep_get_tax_rate($new_products['products_tax_class_id'])).'</td>
                                </tr>'
                                : '').
                                (
                                $advised_price > $new_products['products_price'] && $check_server != 'en'
                                ? '
                                <tr>
                                    <td class="vam instead_of"><i>'.TEXT_SAVING.' '.$currencies->display_price($advised_price - $new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])).' (<span class="fushia">'. (100 - floor($new_products['products_price'] / $advised_price * 100)) .'%</span>)</i></td>
                                </tr>'
                                : '').
                                (
                                $new_products['products_quantity'] > 0
                                ? '<tr><td class="en_stock">'.TEXT_EN_STOCK.'</td></tr>'
                                : ''
                                ).'
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

  new contentBox($info_box_contents);
?>
<!-- new_products_eof //-->
