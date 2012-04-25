<?php
/*
  $Id: checkout_shipping.php,v 1.16 2003/06/09 23:03:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require('includes/classes/http_client.php');
  
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  
   //Recalculate gift if needed (first order only for example, it will remove gift after login)
   $cart->gift();
  
// if there is nothing in the customers cart, redirect them to the shopping cart page
  if (!$cart->card_only() && $cart->count_contents(false) < 1) {
    $messageStack->add('cart', ERROR_TOO_FEW_ITEMS2, 'error');
    $messageStack->add_session('cart', ERROR_TOO_FEW_ITEMS2, 'error');
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
  elseif ($cart->can_buy(MIN_PRODUCTS)) {
    $messageStack->add('cart', ERROR_TOO_FEW_ITEMS1, 'error');
    $messageStack->add_session('cart', ERROR_TOO_FEW_ITEMS1, 'error');
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
  //Limite journaliere
  elseif (!$cart->check_daily_limit($customer_id)) {
    $messageStack->add('cart', ERROR_MAX_DAILY_LIMIT, 'error');
    $messageStack->add_session('cart', ERROR_MAX_DAILY_LIMIT, 'error');
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
  //Limite hebdomadaire
  elseif (!$cart->check_weekly_limit($customer_id)) {
    $messageStack->add('cart', ERROR_MAX_WEEKLY_LIMIT, 'error');
    $messageStack->add_session('cart', ERROR_MAX_WEEKLY_LIMIT, 'error');
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('sendto')) {
    tep_session_register('sendto');
    $sendto = $customer_default_address_id;
  } else {
// verify the selected shipping address
    if ( (is_array($sendto) && empty($sendto)) || is_numeric($sendto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $sendto = $customer_default_address_id;
        if (tep_session_is_registered('shipping')) tep_session_unregister('shipping');
      }
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
  if ($order->content_type == 'virtual') {
    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    $sendto = false;
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();

// load all enabled shipping modules
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {
    $pass = false;

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }

    $free_shipping = false;
    if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }
  if ($cart->card_only())
    $free_shipping = true;

  $shippable = country_shippable($order->delivery['country']['id'], $order->delivery['postcode']);

// process the selected shipping method
  if ( $shippable && isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process') ) {
    if (!tep_session_is_registered('comments')) tep_session_register('comments');
    if (tep_not_null($HTTP_POST_VARS['comments'])) {
      $comments = tep_db_prepare_input($HTTP_POST_VARS['comments']);
    }

    if (!tep_session_is_registered('shipping')) tep_session_register('shipping');

    if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
      if ( (isset($HTTP_POST_VARS['shipping'])) && (strpos($HTTP_POST_VARS['shipping'], '_')) ) {
        $shipping = $HTTP_POST_VARS['shipping'];

        list($module, $method) = explode('_', $shipping);
        if ( is_object($$module) || ($shipping == 'free_free') ) {
          if ($shipping == 'free_free') {
            $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
            $quote[0]['methods'][0]['cost'] = '0';
          } else {
            $quote = $shipping_modules->quote($method, $module);
          }
          if (isset($quote['error'])) {
            tep_session_unregister('shipping');
          } else {
            if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
              $shipping = array('id' => $shipping,
                                'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                'cost' => $quote[0]['methods'][0]['cost']);

              tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  }

// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
var selected;

function selectRowEffect(object, buttonSelect) {
  if (!selected) {
    if (document.getElementById) {
      selected = document.getElementById('defaultSelected');
    } else {
      selected = document.all['defaultSelected'];
    }
  }

  if (selected) selected.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selected = object;

// one button is not an array
  if (document.checkout_address.shipping[0]) {
    document.checkout_address.shipping[buttonSelect].checked=true;
  } else {
    document.checkout_address.shipping.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
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
    <td width="100%" class="col_center"><?php echo tep_draw_form('checkout_address', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . tep_draw_hidden_field('action', 'process'); ?>		<table border="0" width="100%" cellspacing="0" cellpadding="0">
	
			<tr><td>
			
<?php tep_draw_heading_top(901);?>
	
<?php new contentBoxHeading_ProdNew($info_box_contents);?>

<?php tep_draw_heading_top_1();?>
						
      <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <?php if (!$shippable) { ?>
			  <tr class="messageStackError">
				<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS.'error.gif') . ' ' .WARNING_NOT_SHIPPABLE; ?></td>
			  </tr>
			  <?php } ?>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td class="main"><b><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?></b></td>
				  </tr>
				</table></td>
			  </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="1" cellpadding="2">
				  <tr>
					<td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="bor">
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
						<td class="main" width="100%" valign="top"><?php //echo TEXT_CHOOSE_SHIPPING_DESTINATION . '<br><br><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>'; ?></td>
						
					  </tr>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="2">
							  <tr>
								<td class="main" align="center" valign="top"><?php echo '<b>' . TITLE_SHIPPING_ADDRESS . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
								<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
								<td class="main" valign="top"><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br>'); ?></td>
								<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
							  </tr>
							</table>
					  </td></tr>
					</table></td>
				  </tr>
				</table></td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
<?php
  if (tep_count_shipping_modules() > 0) {
?>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td class="main"><b><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></b></td>
				  </tr>
				</table></td>
			  </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="1" cellpadding="2">
				  <tr>
					<td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="bor">
<?php
	if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></td>
						<td class="main" width="50%" valign="top" align="right"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
<?php
	} elseif ($free_shipping == false) {
?>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main" width="100%" colspan="2"><?php //echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
<?php
	}

	if ($free_shipping == true) {
?>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
						  <tr>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php //echo $quotes[$i]['icon']; ?></td>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						  </tr>
						  <tr id="defaultSelected" class="moduleRowSelected" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="selectRowEffect(this, 0)">
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" width="100%"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						  </tr>
						</table></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
					  </tr>
<?php
	} else {
	  $radio_buttons = 0;
	  for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
					  <tr>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
						  <tr>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" colspan="3"><b><?php echo $quotes[$i]['module']; ?></b>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						  </tr>
<?php
		if (isset($quotes[$i]['error'])) {
?>
						  <tr>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" colspan="3"><?php echo $quotes[$i]['error']; ?></td>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						  </tr>
<?php
		} else {
		  for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
			$checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);
//Ajout clement
?>

		  <tr class="moduleRowSelected">
			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
			<td class="main"><?php echo EXPEDITION_DELAY_LABEL; ?></td>
			<td class="main" colspan="2" align="right"><?php echo EXPEDITION_DELAY_VALUE; ?></td>
			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		  </tr>
		  <tr class="moduleRowSelected">
			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
			<td class="main"><?php echo EXPEDITION_TYPE_LABEL; ?></td>
			<td class="main" colspan="2" align="right"><?php echo EXPEDITION_TYPE_VALUE; ?></td>
			<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		  </tr>
<?php
//fin ajout clement
			if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
			  echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
			} else {
			  echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
			}
?>
							<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
							<td class="main" width="25%"><b><?php echo $quotes[$i]['methods'][$j]['title']; ?></b></td>
<?php
			if ( ($n > 1) || ($n2 > 1) ) {
?>
							<td class="main"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
							<td class="main" align="right"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?></td>
<?php
			} else {
?>
							<td class="main" align="right" colspan="2"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></td>
<?php
			}
?>
							<td width="10"><b><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></b></td>
						  </tr>
<?php
			$radio_buttons++;
		  }
		}
?>
						</table></td>
						<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> 
					  </tr>
<?php
	  }
	}
?>
					</table></td>
				  </tr>
				  <tr><td style="height:30px;"></td></tr>
				</table></td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
<?php
  }
?>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td class="main"><b><?php //echo TABLE_HEADING_COMMENTS; ?></b></td>
				  </tr>
				</table></td>
			  </tr>
			  <tr>
				<td>
                
            
<?php //echo tep_draw_infoBox_top();?>
                    
                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td><?php //echo tep_draw_textarea_field('comments', 'soft', '60', '5'); ?></td>
					  </tr>
					</table>

<?php //echo tep_draw_infoBox_bottom();?>

	                
                </td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td>
            
<?php echo tep_draw_infoBox_top();?>

				<table border="0" width="100%" cellspacing="0" cellpadding="2">
					  <tr>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
						<td class="main"><?php //echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
						<td class="main vam bg_input" align="right"><?php echo tep_image_submit('button_continue1.gif', IMAGE_BUTTON_CONTINUE); ?></td>
						<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					  </tr>
				</table>
                
<?php echo tep_draw_infoBox_bottom();?>

						</td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
			  </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="50%" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
						<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
					  </tr>
					</table></td>
					<td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
					<td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
					<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
						<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
					  </tr>
					</table></td>
				  </tr>
				  <tr>
					<td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
					<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
					<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
					<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
				  </tr>
				</table></td>
			  </tr>
	  </table>
					
<?php tep_draw_heading_bottom_1();?>					
		
<?php tep_draw_heading_bottom();?>
	
			</td></tr>
		</table></form></td>
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
