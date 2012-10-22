<?php
/*
  $Id: express.php 1803 2008-01-11 18:16:37Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  chdir('../../../../');
  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $snapshot = array('page' => 'ext/modules/payment/paypal/express.php',
                      'mode' => $request_type,
                      'get' => $HTTP_GET_VARS,
                      'post' => $HTTP_POST_VARS);

    $navigation->set_snapshot($snapshot);

    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
  
  require('includes/modules/payment/paypal_express.php');

  $paypal_express = new paypal_express();

  if (!$paypal_express->check() || !$paypal_express->enabled) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  if (MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER == 'Live') {
    $api_url = 'https://api-3t.paypal.com/nvp';
    $paypal_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout';
  } else {
    $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout';
  }

  if (!tep_session_is_registered('sendto')) {
    tep_session_register('sendto');
    $sendto = $customer_default_address_id;
  }

  if (!tep_session_is_registered('billto')) {
    tep_session_register('billto');
    $billto = $customer_default_address_id;
  }

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

  $params = array('USER' => MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME,
                  'PWD' => MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD,
                  'VERSION' => '60',
                  'SIGNATURE' => MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE);

  switch ($HTTP_GET_VARS['osC_Action']) {
    case 'retrieve':
      $params['METHOD'] = 'GetExpressCheckoutDetails';
      $params['TOKEN'] = $HTTP_GET_VARS['token'];

      $post_string = '';

      foreach ($params as $key => $value) {
        $post_string .= $key . '=' . urlencode(trim($value)) . '&';
      }

      $post_string = substr($post_string, 0, -1);

      $response = $paypal_express->sendTransactionToGateway($api_url, $post_string);
      $response_array = array();
      parse_str($response, $response_array);

      if (($response_array['ACK'] == 'Success') || ($response_array['ACK'] == 'SuccessWithWarning')) {
        include(DIR_WS_CLASSES . 'order.php');

        if ($cart->get_content_type() != 'virtual') {
        
/*
          $country_iso_code_2 = tep_db_prepare_input($response_array['SHIPTOCOUNTRYCODE']);
          $zone_code = tep_db_prepare_input($response_array['SHIPTOSTATE']);

          $country_query = tep_db_query("select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . TABLE_COUNTRIES . " where countries_iso_code_2 = '" . tep_db_input($country_iso_code_2) . "'");
          $country = tep_db_fetch_array($country_query);

          $zone_name = $response_array['SHIPTOSTATE'];
          $zone_id = 0;

          $zone_query = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country['countries_id'] . "' and zone_code = '" . tep_db_input($zone_code) . "'");
          if (tep_db_num_rows($zone_query)) {
            $zone = tep_db_fetch_array($zone_query);

            $zone_name = $zone['zone_name'];
            $zone_id = $zone['zone_id'];
          }
          
          $sendto = array('firstname' => substr($response_array['SHIPTONAME'], 0, strpos($response_array['SHIPTONAME'], ' ')),
                          'lastname' => substr($response_array['SHIPTONAME'], strpos($response_array['SHIPTONAME'], ' ')+1),
                          'company' => '',
                          'street_address' => $response_array['SHIPTOSTREET'],
                          'suburb' => '',
                          'postcode' => $response_array['SHIPTOZIP'],
                          'city' => $response_array['SHIPTOCITY'],
                          'zone_id' => $zone_id,
                          'zone_name' => $zone_name,
                          'country_id' => $country['countries_id'],
                          'country_name' => $country['countries_name'],
                          'country_iso_code_2' => $country['countries_iso_code_2'],
                          'country_iso_code_3' => $country['countries_iso_code_3'],
                          'address_format_id' => ($country['address_format_id'] > 0 ? $country['address_format_id'] : '1'));

          $billto = $sendto;*/

          $order = new order;
          
          $country_query = tep_db_query("select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . TABLE_COUNTRIES . " where countries_iso_code_2 = '" . tep_db_input($order->delivery['country']['iso_code_2']) . "'");
          $country = tep_db_fetch_array($country_query);
          
          $sendto = array('firstname' => $order->delivery['firstname'],
                          'lastname' => $order->delivery['lastname'],
                          'company' => $order->delivery['company'],
                          'street_address' => $order->delivery['street_address'],
                          'suburb' => $order->delivery['suburb'],
                          'digicode' => $order->delivery['digicode'],
                          'postcode' => $order->delivery['postcode'],
                          'city' => $order->delivery['city'],
                          'country_id' => $country['countries_id'],
                          'country_name' => $country['countries_name'],
                          'country_iso_code_2' => $country['countries_iso_code_2'],
                          'country_iso_code_3' => $country['countries_iso_code_3'],
                          'address_format_id' => ($country['address_format_id'] > 0 ? $country['address_format_id'] : '1'));

          if ($order->delivery['country']['iso_code_2'] != $order->billing['country']['iso_code_2'])
          {
              $country_query = tep_db_query("select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . TABLE_COUNTRIES . " where countries_iso_code_2 = '" . tep_db_input($order->billing['country']['iso_code_2']) . "'");
              $country = tep_db_fetch_array($country_query);
          }
          
          $billto = array('firstname' => $order->billing['firstname'],
                          'lastname' => $order->billing['lastname'],
                          'company' => $order->billing['company'],
                          'street_address' => $order->billing['street_address'],
                          'suburb' => $order->billing['suburb'],
                          'postcode' => $order->billing['postcode'],
                          'city' => $order->billing['city'],
                          'country_id' => $country['countries_id'],
                          'country_name' => $country['countries_name'],
                          'country_iso_code_2' => $country['countries_iso_code_2'],
                          'country_iso_code_3' => $country['countries_iso_code_3'],
                          'address_format_id' => ($country['address_format_id'] > 0 ? $country['address_format_id'] : '1'));;

          $total_weight = $cart->show_weight();
          $total_count = $cart->count_contents();

// load all enabled shipping modules
          include(DIR_WS_CLASSES . 'shipping.php');
          $shipping_modules = new shipping;

          $free_shipping = false;

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

            if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {
              $free_shipping = true;

              include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
            }
          }

          if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
          $shipping = false;

          if ( (tep_count_shipping_modules() > 0) || ($free_shipping == true) ) {
            if ($free_shipping == true) {
              $shipping = 'free_free';
            } else {
// get all available shipping quotes
              $quotes = $shipping_modules->quote();

// select cheapest shipping method
              $shipping = $shipping_modules->cheapest();
              $shipping = $shipping['id'];
            }
          }

          if (strpos($shipping, '_')) {
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

                tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
              } else {
                if ( (isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost'])) ) {
                  $shipping = array('id' => $shipping,
                                    'title' => (($free_shipping == true) ?  $quote[0]['methods'][0]['title'] : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                                    'cost' => $quote[0]['methods'][0]['cost']);
                }
              }
            }
          }

          if (!tep_session_is_registered('payment')) tep_session_register('payment');
          $payment = $paypal_express->code;

          if (!tep_session_is_registered('ppe_token')) tep_session_register('ppe_token');
          $ppe_token = $response_array['TOKEN'];

          if (!tep_session_is_registered('ppe_payerid')) tep_session_register('ppe_payerid');
          $ppe_payerid = $response_array['PAYERID'];

          //tep_redirect(tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'));
          tep_redirect(tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'));
        } else {
          if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
          $shipping = false;

          $sendto = false;

          if (!tep_session_is_registered('payment')) tep_session_register('payment');
          $payment = $paypal_express->code;

          if (!tep_session_is_registered('ppe_token')) tep_session_register('ppe_token');
          $ppe_token = $response_array['TOKEN'];

          if (!tep_session_is_registered('ppe_payerid')) tep_session_register('ppe_payerid');
          $ppe_payerid = $response_array['PAYERID'];

          //tep_redirect(tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'));
          tep_redirect(tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL'));
        }
      } else {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, 'error_message=' . stripslashes($response_array['L_LONGMESSAGE0']), 'SSL'));
      }

      break;

    default:
      include(DIR_WS_CLASSES . 'order.php');
      $order = new order;
      $params['METHOD'] = 'SetExpressCheckout';
      $params['PAYMENTACTION'] = ((MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD == 'Sale') ? 'Sale' : 'Authorization');
      $params['RETURNURL'] = tep_href_link('ext/modules/payment/paypal/express.php', 'osC_Action=retrieve', 'SSL', true, false);
      $params['CANCELURL'] = tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL', true, false);
      $params['CURRENCYCODE'] = $order->info['currency'];
  	  $params['LANDINGPAGE'] = 'billing';
  	  $params['LOCALECODE'] = $paypal_lang;
  	  $params['VERSION'] = 60;
      $params['PAGESTYLE'] = 'parfumrama';
	  
	  //$params['SHIPPINGAMT'] = $paypal_express->format_raw($order->info['shipping_cost']);
      $params['ITEMAMT'] = 0;

      $lasti = 0;
      $total_products = 0;
      foreach ($order->products as $index => $info) {
	       $params['L_NAME'.$index]    = $info['name'];
	       $params['L_AMT'.$index]     = $paypal_express->format_raw($info['final_price']);
	       $params['L_NUMBER'.$index]  = $info['model'];
	       $params['L_QTY'.$index]     = $info['qty'];
           $params['ITEMAMT']           += $paypal_express->format_raw($info['final_price']) * $info['qty'];
           $params['AMT']               += $paypal_express->format_raw($info['final_price']) * $info['qty'];
           $lasti = $index;
           if (!$cart->is_card($info['id']))
               $total_products += $info['final_price'] * $info['qty'];
	  }

	  $lasti++;
	  $reduc = -$paypal_express->format_raw($easy_discount->total() + $nb_products_discount->discount);

	  if ($reduc < 0) {
           $j = 1;
           if (!empty($easy_discount->discounts))
                foreach ($easy_discount->discounts as $infos) {
        	       $params['L_NAME'.$lasti]    = 'Code '.substr($infos["description"], strrpos($infos["description"], '(') + 1, -1);
        	       $params['L_AMT'.$lasti]     = -$paypal_express->format_raw($infos["amount"]);
        	       $params['ITEMAMT']           += $params['L_AMT'.$lasti];
                   $params['AMT']               += $params['L_AMT'.$lasti];
                   $lasti++;
                }

           if (!empty($nb_products_discount->discount)) {
    	       $params['L_NAME'.$lasti]    = $nb_products_discount->nb . ' items bought';
    	       $params['L_AMT'.$lasti]     = -$paypal_express->format_raw($nb_products_discount->discount);
    	       $params['ITEMAMT']           += $params['L_AMT'.$lasti];
               $params['AMT']               += $params['L_AMT'.$lasti];
               $lasti++;
            }
       }

	  if (is_promo_date()) {
          $params['L_NAME'.$lasti]    = SUB_TITLE_SUB_SPECIAL_DISCOUNT . ' ' .SPECIAL_DISCOUNT_PAYPAL;
          $params['L_AMT'.$lasti]     = -$paypal_express->format_raw(round2($total_products * get_promo('percent')));
          $params['ITEMAMT']           += $params['L_AMT'.$lasti];
          $params['AMT']               += $params['L_AMT'.$lasti];
          $lasti++;
	  }


      if (!$cart->card_only()) {
       $params['L_NAME'.$lasti]    = 'Port';
       $params['L_AMT'.$lasti]     = $paypal_express->format_raw($order->info['shipping_cost']);
       $params['ITEMAMT']           += $params['L_AMT'.$lasti];
       $params['AMT']               += $params['L_AMT'.$lasti];
      $lasti++;
      $params['L_NAME'.$lasti]    = 'Port sup';
      $params['L_AMT'.$lasti]     = $paypal_express->format_raw(country_cost($_SESSION['customer_country_id']));
      $params['ITEMAMT']           += $params['L_AMT'.$lasti];
      $params['AMT']               += $params['L_AMT'.$lasti];
      }

      if ($order->content_type == 'virtual') {
        $params['NOSHIPPING'] = '1';
      }
      
      $post_string = '';

      foreach ($params as $key => $value) {
        $post_string .= $key . '=' . urlencode(trim($value)) . '&';
      }

      if ($params['AMT'] <= 0)
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PROCESS));
        
      $post_string = substr($post_string, 0, -1);
      $response = $paypal_express->sendTransactionToGateway($api_url, $post_string);
      $response_array = array();
      parse_str($response, $response_array);

      if (($response_array['ACK'] == 'Success') || ($response_array['ACK'] == 'SuccessWithWarning')) {
        tep_redirect($paypal_url . '&token=' . $response_array['TOKEN']);
      } else {
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, 'error_message=' . stripslashes($response_array['L_LONGMESSAGE0']), 'SSL'));
      }

      break;
  }

  tep_redirect(tep_href_link(FILENAME_SHOPPING_CART, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
