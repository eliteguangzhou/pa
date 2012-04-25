<?php
/*
  $Id: shopping_cart.php,v 1.18 2003/02/10 22:31:06 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- shopping_cart //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_SHOPPING_CART);

  new infoBoxHeading($info_box_contents, false, true, tep_href_link(FILENAME_SHOPPING_CART));

  $cart_contents_string = '';
  if ($cart->count_contents() > 0) {
    $cart_contents_string = '<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">';
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $cart_contents_string .= '<tr><td align="right" valign="top">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span class="">';
      }

      $cart_contents_string .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $cart_contents_string .= '<span class="newItemInCart">';
      } else {
        $cart_contents_string .= '<span>';
      }

      $cart_contents_string .= $products[$i]['name'] . '</span></a></td></tr>';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }
    $cart_contents_string .= '</table>';
  } else {
    $cart_contents_string = ' &nbsp; 0 '.BOX_SHOPPING_CART_EMPTY;
  }

 $temp1 = '<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center"><tr><td>'.$cart_contents_string .'</td></tr></table>';
 $temp2 = '';

  if ($cart->count_contents() > 0) {
   
    $temp2 = '<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center"><tr><td align="right" height="30" class="vam"><span class="productSpecialPrice">'.$currencies->format($cart->show_total()).'</span></td></tr></table>';
  }

$info_box_contents = array();
  $info_box_contents[] = array('text' => $temp1.$temp2);

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- shopping_cart_eof //-->
