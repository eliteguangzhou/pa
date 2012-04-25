<?php /*
  $Id: checkout_shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
//  require('includes/classes/http_client.php');
        
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }
        
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);
  // needs to be included earlier to set the success message in the messageStack
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SHIPPING_ADDRESS);
  // needs to be included earlier to set the success message in the messageStack
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT_ADDRESS);
  // needs to be included earlier to set the success message in the messageStack
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
  // needs to be included earlier to set the success message in the messageStack
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADDRESS_BOOK_PROCESS);
  // needs to be included earlier to set the message for the tax and others
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);
  
  $error = false;
  $address_count = 0;
        
  // if there is nothing in the customers cart, redirect them to the shopping cart page
//  echo $cart->count_contents() . "Enteringasfddasf"; 
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }
   
 //---------------LOGIN--------------------//
 
   if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
    $password = tep_db_prepare_input($HTTP_POST_VARS['password']);

// Check if email exists
    $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
        
    if (!tep_db_num_rows($check_customer_query)) {
      $error = true;
    } else {
      $check_customer = tep_db_fetch_array($check_customer_query);
// Check that password is good
      if (!tep_validate_password($password, $check_customer['customers_password'])) {
        $error = true;
                
      } else {
        if (SESSION_RECREATE == 'True') {
          tep_session_recreate();
        }
        
        $check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
                
        $check_country = tep_db_fetch_array($check_country_query);

        $customer_id = $check_customer['customers_id'];
        $customer_default_address_id = $check_customer['customers_default_address_id'];
        $customer_first_name = $check_customer['customers_firstname'];
        $customer_country_id = $check_country['entry_country_id'];
        $customer_zone_id = $check_country['entry_zone_id'];
        tep_session_register('customer_id');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_first_name');
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');

        tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");
        
// restore cart contents
        $cart->restore_contents();

        if (sizeof($navigation->snapshot) > 0) {
                   $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
          $navigation->clear_snapshot();
          tep_redirect($origin_href);
        } else {
                  tep_redirect(tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
        }
      }
    }
        
        if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }
  }else{
        $messageStack->reset(true);
  }
 if(tep_session_is_registered('customer_id')){
 
 
 
 $check_customer_bill_qry = tep_db_query("select * from " . TABLE_ADDRESS_BOOK . " where customers_id=".$customer_id."");
 //echo "select * from " . TABLE_ADDRESS_BOOK . " where customers_id=".$customer_id."";
 
 $check_bill = tep_db_fetch_array($check_customer_bill_qry);
 
 //print_r($HTTP_POST_VARS);
 //print_r($check_bill);
 if(empty($HTTP_POST_VARS) || (empty($HTTP_POST_VARS['firstname']) && empty($HTTP_POST_VARS['lastname']) && empty($HTTP_POST_VARS['street_address']))  ){
 $gender        =       $check_bill['entry_gender'];
 $firstname     =       $check_bill['entry_firstname'];
 $lastname      =       $check_bill['entry_lastname'];  
 $company       =       $check_bill['entry_company'];   
 $street_address        =  $check_bill['entry_street_address'];
 $suburb        =       $check_bill['entry_suburb'];            
 $city          =   $check_bill['entry_city'];  
 $postcode      =       $check_bill['entry_postcode'];
 $country       =       $check_bill['entry_country_id'];
 $zone_id       =   $check_bill['entry_zone_id'];       
 $state         =       $check_bill['entry_state'];
 
 $state = tep_get_zone_code($country, $zone_id, $state);
 

 }
 
 if(empty($HTTP_POST_VARS) || (empty($HTTP_POST_VARS['ship_firstname']) && empty($HTTP_POST_VARS['ship_lastname']) && empty($HTTP_POST_VARS['ship_street_address']))  ){
  $ship_firstname       =       $check_bill['entry_firstname'];
 $ship_lastname =       $check_bill['entry_lastname'];  
 $ship_company  =       $check_bill['entry_company'];   
 $ship_street_address   =  $check_bill['entry_street_address'];
 $ship_suburb   =       $check_bill['entry_suburb'];            
 $ship_city             =   $check_bill['entry_city'];  
 $ship_postcode =       $check_bill['entry_postcode'];
 $ship_country  =       $check_bill['entry_country_id'];
 $ship_zone_id  =   $check_bill['entry_zone_id'];       
 $ship_state            =       $check_bill['entry_state'];

  $ship_state = tep_get_zone_code($ship_country, $ship_zone_id, $ship_state);

        }
 }
 
 
 // echo $state."state";
        
 //$state = tep_get_zone_code($check_bill['entry_country_id'], $check_bill['entry_zone_id'], $state);
// echo $state;
 
 /*echo $check_bill['entry_state'];
 echo $state."state";
 echo $check_bill['entry_firstname'];*/

 //---------------LOGIN ENDS--------------------//
  

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed

//   if ($order->content_type == 'virtual') {
//     if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
//     $shipping = false;
//     $sendto = false;
//    // tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
//   }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();
 
// load all enabled shipping modules
  require_once(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

  
/*// load all enabled payment modules
if(empty($HTTP_POST_VARS['payment'])){
    require(DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment;
  }*/
  
  // load all enabled payment modules
  if(!empty($HTTP_POST_VARS['payment'])){
  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($HTTP_POST_VARS['payment'])) $payment = $HTTP_POST_VARS['payment'];
  
        require(DIR_WS_CLASSES . 'payment.php');
        $payment_modules = new payment($payment);  
        //echo "entering if";
  }     else{
         require(DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment;
        //echo "entering else";
  }
 
 
 if(empty($HTTP_POST_VARS)){

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;


  require(DIR_WS_CLASSES . 'order_total.php');
@  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();
 
} 
  
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
  
 /*if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($HTTP_POST_VARS['payment'])) $payment = $HTTP_POST_VARS['payment'];*/

// process the selected shipping method

  if ( !empty($HTTP_POST_VARS) ) {
  
        //echo $HTTP_POST_VARS['shipping']."shipping";
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

             // tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
            }
          }
        } else {
          tep_session_unregister('shipping');
        }
      }
    } else {
      $shipping = false;
                
      //tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }    
  }


// get all available shipping quotes
  $quotes = $shipping_modules->quote();

// if no shipping method has been selected, automatically select the cheapest method.
// if the modules status was changed when none were available, to save on implementing
// a javascript force-selection method, also automatically select the cheapest shipping
// method if more than one module is now enabled
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ) $shipping = $shipping_modules->cheapest();
  
  require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);
  
  
  

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
 // $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT, '', 'SSL'));
 


//--------------- billing address validation  myth -------------//

$error = false;
$process = false;

/* if(!empty($HTTP_POST_VARS)){
 print_r($order->delivery);
  echo "shipping"."<br>";
        print_r($order->billing);
  echo "billing"."<br>";        
        print_r($order->info)."info";
  echo "info"."<br>";   
  exit;
}
*/
//print_r($messageStack);

// load the before_process function from the payment modules
//$payment_modules->before_process();
  
  // print_r($messageStack->messages);          
        
  
  
  
 //---------------validation ------------------------------------//
        
  if (!empty($HTTP_POST_VARS)) {
      $process = true;
          
        if(!tep_session_is_registered('customer_id')) { 
        
                $messageStack->add('checkout_payment', LOGIN_ERROR);
                
        }
         if (!tep_session_is_registered('customer_id')) {
          $telephone = tep_db_prepare_input($HTTP_POST_VARS['telephone']);              
          $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);              
          $new_password = tep_db_prepare_input($HTTP_POST_VARS['new_password']);
          $confirmation = tep_db_prepare_input($HTTP_POST_VARS['confirmation']);                
          
          if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
            $error = true;

        $messageStack->add('checkout_payment', ENTRY_TELEPHONE_NUMBER_ERROR);
      }
          
          if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_payment', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('checkout_payment', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }
        
        
         if (strlen($new_password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_payment', ENTRY_PASSWORD_ERROR);
    } elseif ($new_password != $confirmation) {
      $error = true;

      $messageStack->add('checkout_payment', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }
        
        
          }
        
        
          
          
           if ( (tep_not_null($HTTP_POST_VARS['firstname']) && tep_not_null($HTTP_POST_VARS['lastname']) && tep_not_null($HTTP_POST_VARS['street_address'])) || (tep_not_null($HTTP_POST_VARS['telephone']) && tep_not_null($HTTP_POST_VARS['email_address']) && tep_not_null($HTTP_POST_VARS['new_password']) && tep_not_null($HTTP_POST_VARS['confirmation']) ) ) {
          
      if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
      if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($HTTP_POST_VARS['company']);
      if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($HTTP_POST_VARS['dob']);
      $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
      $lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
      $street_address = tep_db_prepare_input($HTTP_POST_VARS['street_address']);
      if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($HTTP_POST_VARS['suburb']);
      $postcode = tep_db_prepare_input($HTTP_POST_VARS['postcode']);
      $city = tep_db_prepare_input($HTTP_POST_VARS['city']);
      $country = tep_db_prepare_input($HTTP_POST_VARS['country']);
      if (ACCOUNT_STATE == 'true') {
        if (isset($HTTP_POST_VARS['zone_id'])) {
          $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
        } else {
          $zone_id = false;
        }
        $state = tep_db_prepare_input($HTTP_POST_VARS['state']);
      }
          
          if($HTTP_POST_VARS['ship_same'] == 'on'){
          if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
      if (ACCOUNT_COMPANY == 'true') $ship_company = tep_db_prepare_input($HTTP_POST_VARS['company']);
           $ship_firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
      $ship_lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
          
      $ship_street_address = tep_db_prepare_input($HTTP_POST_VARS['street_address']);
      if (ACCOUNT_SUBURB == 'true') $ship_suburb = tep_db_prepare_input($HTTP_POST_VARS['suburb']);
      $ship_postcode = tep_db_prepare_input($HTTP_POST_VARS['postcode']);
      $ship_city = tep_db_prepare_input($HTTP_POST_VARS['city']);
      $ship_country = tep_db_prepare_input($HTTP_POST_VARS['country']);
      if (ACCOUNT_STATE == 'true') {
        if (isset($HTTP_POST_VARS['zone_id'])) {
          $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
        } else {
          $zone_id = false;
        }
        $ship_state = tep_db_prepare_input($HTTP_POST_VARS['state']);
      }
          }
          /*    echo $country."country";
                echo $zone_id."zoneid";
                echo $state."state";*/
                //exit;
       if (ACCOUNT_GENDER == 'true') {
        if ( ($gender != 'm') && ($gender != 'f') ) {
          $error = true;

          $messageStack->add('checkout_payment', ENTRY_GENDER_ERROR);
        }
      }
           if (ACCOUNT_DOB == 'true' && !tep_session_is_registered('customer_id')) {
      if (checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false) {
        $error = true;

        $messageStack->add('checkout_payment', tep_date_raw($dob).ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }
      
      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
            $error = true;

        $messageStack->add('checkout_payment', ENTRY_FIRST_NAME_ERROR);
      }

      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
            $error = true;

        $messageStack->add('checkout_payment', ENTRY_LAST_NAME_ERROR);
      }

      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_STREET_ADDRESS_ERROR);
      }

      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_POST_CODE_ERROR);
      }

     if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_CITY_ERROR);
      }
        
     if (ACCOUNT_STATE == 'true') {
         
        $zone_id = 0;
        $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
                $check = tep_db_fetch_array($check_query);
                $entry_state_has_zones = ($check['total'] > 0);
        
          if ($entry_state_has_zones == true) {
              $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
                    if (tep_db_num_rows($zone_query) == 1) {
                    $zone = tep_db_fetch_array($zone_query);
            $zone_id = $zone['zone_id'];
                  } else {
                    $error = true;

            $messageStack->add('checkout_payment', ENTRY_STATE_ERROR_SELECT);
          }
        } else {
          if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
            $error = true;
                
            $messageStack->add('checkout_payment', ENTRY_STATE_ERROR);
          }
        }
      }

       if ( (is_numeric($country) == false) || ($country < 1) ) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_COUNTRY_ERROR);
      }
          
          }
          
          
          //-------validation for New shipping address-----------//
           if ( ((tep_not_null($HTTP_POST_VARS['ship_firstname']) && tep_not_null($HTTP_POST_VARS['ship_lastname']) && tep_not_null($HTTP_POST_VARS['ship_street_address']))  || (tep_not_null($HTTP_POST_VARS['telephone']) && tep_not_null($HTTP_POST_VARS['email_address']) && tep_not_null($HTTP_POST_VARS['new_password']) && tep_not_null($HTTP_POST_VARS['confirmation']) )) && (tep_not_null($HTTP_POST_VARS['ship_same']!='on'))) {
          //   shipping address validation  myth  //
          
          if (ACCOUNT_GENDER == 'true') $ship_gender = tep_db_prepare_input($HTTP_POST_VARS['ship_gender']);
      if (ACCOUNT_COMPANY == 'true') $ship_company = tep_db_prepare_input($HTTP_POST_VARS['ship_company']);
      $ship_firstname = tep_db_prepare_input($HTTP_POST_VARS['ship_firstname']);
      $ship_lastname = tep_db_prepare_input($HTTP_POST_VARS['ship_lastname']);
      $ship_street_address = tep_db_prepare_input($HTTP_POST_VARS['ship_street_address']);
      if (ACCOUNT_SUBURB == 'true') $ship_suburb = tep_db_prepare_input($HTTP_POST_VARS['ship_suburb']);
      $ship_postcode = tep_db_prepare_input($HTTP_POST_VARS['ship_postcode']);
      $ship_city = tep_db_prepare_input($HTTP_POST_VARS['ship_city']);
      $ship_country = tep_db_prepare_input($HTTP_POST_VARS['ship_country']);
      if (ACCOUNT_STATE == 'true') {
        if (isset($HTTP_POST_VARS['zone_id'])) {
          $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
        } else {
          $zone_id = false;
        }
        $ship_state = tep_db_prepare_input($HTTP_POST_VARS['ship_state']);
      }

      if (ACCOUNT_GENDER == 'true') {
        if ( ($ship_gender != 'm') && ($ship_gender != 'f') ) {
          $error = true;

          $messageStack->add('checkout_payment', ENTRY_SHIP_GENDER_ERROR);
        }
      }
           
      if (strlen($ship_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
            $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_FIRST_NAME_ERROR);
      }

      if (strlen($ship_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
            $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_LAST_NAME_ERROR);
      }
          
      if (strlen($ship_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_STREET_ADDRESS_ERROR);
      }

      if (strlen($ship_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_POST_CODE_ERROR);
      }

      if (strlen($ship_city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_CITY_ERROR);
      }

      if (ACCOUNT_STATE == 'true') {
        $zone_id = 0;
        $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$ship_country . "'");
        $check = tep_db_fetch_array($check_query);
        $entry_state_has_zones_ship = ($check['total'] > 0);
        if ($entry_state_has_zones_ship == true) {
          $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$ship_country . "' and (zone_name = '" . tep_db_input($ship_state) . "' or zone_code = '" . tep_db_input($ship_state) . "')");
          if (tep_db_num_rows($zone_query) == 1) {
            $zone = tep_db_fetch_array($zone_query);
            $zone_id = $zone['zone_id'];
          } else {
            $error = true;

            $messageStack->add('checkout_payment', ENTRY_SHIP_STATE_ERROR_SELECT);
          }
        } else {
          if (strlen($ship_state) < ENTRY_STATE_MIN_LENGTH) {
            $error = true;

            $messageStack->add('checkout_payment', ENTRY_SHIP_STATE_ERROR);
          }
        }
      }

      if ( (is_numeric($ship_country) == false) || ($ship_country < 1) ) {
        $error = true;

        $messageStack->add('checkout_payment', ENTRY_SHIP_COUNTRY_ERROR);
      }
          
        }
        //-------End of validation for New shipping address----//
        
        /*if ( empty($order->info['payment_method']) ) {
       $error = true;

       $messageStack->add('checkout_payment', ENTRY_PAYMENTMETHOD_ERROR);
    }*/
        
        if ( tep_not_null($HTTP_POST_VARS['firstname']) && tep_not_null($HTTP_POST_VARS['lastname']) && tep_not_null($HTTP_POST_VARS['street_address']) ) {
                $address_count++;
        }
        
        if (tep_not_null($HTTP_POST_VARS['ship_firstname']) && tep_not_null($HTTP_POST_VARS['ship_lastname']) && tep_not_null($HTTP_POST_VARS['ship_street_address'])) {
                $address_count++;
        }
        
                $address_count = $address_count+tep_count_customer_address_book_entries();
        
         if ( $address_count > MAX_ADDRESS_BOOK_ENTRIES )  {
                $error = true;
                
                $messageStack->add('checkout_payment', ERROR_ADDRESS_BOOK_FULL);
          }
        
 //---------------validation ends------------------------------------//
 
 
 //if($messageStack->size('checkout_payment') > 0 && $messageStack->output('checkout_payment')!=''){
 if($error == true){

// echo $messageStack->size('checkout_payment');
// exit;
  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;


  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();
 
} 
 
 
        
if ($error == false) {

  
    //-----------new billing address----------------------------//
    if ( tep_not_null($HTTP_POST_VARS['firstname']) && tep_not_null($HTTP_POST_VARS['lastname']) && tep_not_null($HTTP_POST_VARS['street_address']) ) {
        

        //---------------------new account----------------------//
        
        if(!tep_session_is_registered('customer_id')){
         $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_password' => tep_encrypt_password($new_password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

           /*if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
          $sql_data_array['customers_id'] = (int)$customer_id;
          tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

          $new_address_book_id = tep_db_insert_id();
                  }*/
                  
      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      tep_session_register('customer_id');
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');

// restore cart contents
      $cart->restore_contents();

// build the message content
      $name = $firstname . ' ' . $lastname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $lastname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $lastname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }

      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
      tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

      //tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
    }
        
        //--------------------new accont ends-----------------//
        
        else{
        
        $sql_data_array1 = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array1['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array1['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array1['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array1['entry_zone_id'] = $zone_id;
          $sql_data_array1['entry_state'] = '';
        } else {
          $sql_data_array1['entry_zone_id'] = '0';
          $sql_data_array1['entry_state'] = $state;
        }
      }
        
      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array1);
                //print_r($sql_data_array1);
                
      $address_id = tep_db_insert_id();
          }
           if (!tep_session_is_registered('billto')) tep_session_register('billto');
          $billto =     $address_id;
          
        //  echo $billto."billto in checkout";
         // exit;
           $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) tep_session_unregister('payment');
       // tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        tep_session_unregister('billto');
      }
          
          } else{ 
          // selected shipping address //
        
  if (isset($HTTP_POST_VARS['address']) ) {
      $reset_shipping = false;
      if (tep_session_is_registered('billto')) {
        if ($sendto != $HTTP_POST_VARS['address']) {
          if (tep_session_is_registered('payment')) {
            $reset_shipping = true;
          }
        }
      } else {
        tep_session_register('billto');
      }
           if (!tep_session_is_registered('billto')) tep_session_register('billto');    
      $billto = $HTTP_POST_VARS['address'];

      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) tep_session_unregister('payment');
       // tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        tep_session_unregister('billto');
      }
    } else {
      if (!tep_session_is_registered('billto')) tep_session_register('billto');
      $billto = $customer_default_address_id;
          
          
        

     // tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
        
  }
  /*print_r($HTTP_POST_VARS);
  exit;*/

        //-------------end of new billing address-------------//
        
          
          
        //-------------new shipping address--------------------//
        $ship_same      =       $HTTP_POST_VARS['ship_same'];
        //echo $ship_same."same";
        if($ship_same   ==      ''){
                if (tep_not_null($HTTP_POST_VARS['ship_firstname']) && tep_not_null($HTTP_POST_VARS['ship_lastname']) && tep_not_null($HTTP_POST_VARS['ship_street_address']) ) {
          //   shipping address validation  myth  //
          
        $sql_data_array2 = array('customers_id' => $customer_id,
                              'entry_firstname' => $ship_firstname,
                              'entry_lastname' => $ship_lastname,
                              'entry_street_address' => $ship_street_address,
                              'entry_postcode' => $ship_postcode,
                              'entry_city' => $ship_city,
                              'entry_country_id' => $ship_country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array2['entry_gender'] = $ship_gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array2['entry_company'] = $ship_company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array2['entry_suburb'] = $ship_suburb;
        if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array2['entry_zone_id'] = $zone_id;
          $sql_data_array2['entry_state'] = '';
        } else {
          $sql_data_array2['entry_zone_id'] = '0';
          $sql_data_array2['entry_state'] = $state;
        }
      }
        
      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array2);

      $address_id = tep_db_insert_id();
          $sendto = $address_id;
          
         
          $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) tep_session_unregister('shipping');
        //tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        tep_session_unregister('sendto');
      }
        
        
         } 
         
         
         else{
        
           if (isset($HTTP_POST_VARS['ship_address'])  ) {
          $reset_shipping = false;
      if (tep_session_is_registered('sendto')) {
            if ($sendto != $HTTP_POST_VARS['ship_address']) {
          if (tep_session_is_registered('ship_address')) {
                 
              $reset_shipping = true;
          }
        }
      } else {
            tep_session_register('sendto');
      }
          
     if (!tep_session_is_registered('sendto')) tep_session_register('sendto');
          $sendto = $HTTP_POST_VARS['ship_address'];
          
         
          $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$sendto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] == '1') {
        if ($reset_shipping == true) tep_session_unregister('ship_address');
        //tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        tep_session_unregister('sendto');
      }
    } else {
     // if (!tep_session_is_registered('sendto')) tep_session_register('sendto');
      $sendto = $customer_default_address_id;
          if($HTTP_POST_VARS['ship_same']=='on'){
                tep_session_register('sendto');
                }
     // tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
        
        //selected shipping address end //
        
          /* // if no shipping destination address was selected, use the customers own address as default
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
  }*/
        
         
       } 
         } // ship_same if ends
        else{ 
                 if (!tep_session_is_registered('sendto')) {
                 tep_session_register('sendto');
                 $sendto = $billto;
                 }
                //exit; 
                
         }
         
        
                //-------------end of new shipping address-------------//
          
  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;


  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();         
        
        
        // Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    //if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
  //    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    //}
  }
  
  
//*****************************************************************************************************************************************  
// Mani Coding  
  $payment_modules->update_status();
  
  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }


  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }
  //tep_redirect(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL');
 //print_r( $payment_modules->update_status());
 
//  require(DIR_WS_CLASSES . 'order_total.php');
//  $order_total_modules = new order_total;

//  $order_totals = $order_total_modules->process();

// load the before_process function from the payment modules
//  $payment_modules->before_process();
  
// Mani Coding    
//*****************************************************************************************************************************************


  
  /* if(!empty($HTTP_POST_VARS['payment'])){
  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($HTTP_POST_VARS['payment'])) $payment = $HTTP_POST_VARS['payment'];
  
        require(DIR_WS_CLASSES . 'payment.php');
        $payment_modules = new payment($payment);  
  
  }     */



        // ----------------- order conirmation-----------------------//
 
 
  
        
  //$order = new order;
//      
// 
//  $sql_data_array = array('customers_id' => $customer_id,
//                          'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
//                          'customers_company' => $order->customer['company'],
//                          'customers_street_address' => $order->customer['street_address'],
//                          'customers_suburb' => $order->customer['suburb'],
//                          'customers_city' => $order->customer['city'],
//                          'customers_postcode' => $order->customer['postcode'], 
//                          'customers_state' => $order->customer['state'], 
//                          'customers_country' => $order->customer['country']['title'], 
//                          'customers_telephone' => $order->customer['telephone'], 
//                          'customers_email_address' => $order->customer['email_address'],
//                          'customers_address_format_id' => $order->customer['format_id'], 
//                          'delivery_name' => trim($order->delivery['firstname'] . ' ' . $order->delivery['lastname']),
//                          'delivery_company' => $order->delivery['company'],
//                          'delivery_street_address' => $order->delivery['street_address'], 
//                          'delivery_suburb' => $order->delivery['suburb'], 
//                          'delivery_city' => $order->delivery['city'], 
//                          'delivery_postcode' => $order->delivery['postcode'], 
//                          'delivery_state' => $order->delivery['state'], 
//                          'delivery_country' => $order->delivery['country']['title'], 
//                          'delivery_address_format_id' => $order->delivery['format_id'], 
//                          'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'], 
//                          'billing_company' => $order->billing['company'],
//                          'billing_street_address' => $order->billing['street_address'], 
//                          'billing_suburb' => $order->billing['suburb'], 
//                          'billing_city' => $order->billing['city'], 
//                          'billing_postcode' => $order->billing['postcode'], 
//                          'billing_state' => $order->billing['state'], 
//                          'billing_country' => $order->billing['country']['title'], 
//                          'billing_address_format_id' => $order->billing['format_id'], 
//                          'payment_method' => $order->info['payment_method'], 
//                          'cc_type' => $order->info['cc_type'], 
//                          'cc_owner' => $order->info['cc_owner'], 
//                          'cc_number' => $order->info['cc_number'], 
//                          'cc_expires' => $order->info['cc_expires'], 
//                          'date_purchased' => 'now()', 
//                          'orders_status' => $order->info['order_status'], 
//                                                'currency' => $order->info['currency'], 
//                          'currency_value' => $order->info['currency_value']);
//                                              /*print_r($sql_data_array); 
//                                              exit;*/
//  tep_db_perform(TABLE_ORDERS, $sql_data_array);
//  $insert_id = tep_db_insert_id();
//  
//  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
// 
//    $sql_data_array = array('orders_id' => $insert_id,
//                            'title' => $order_totals[$i]['title'],
//                            'text' => $order_totals[$i]['text'],
//                            'value' => $order_totals[$i]['value'], 
//                            'class' => $order_totals[$i]['code'], 
//                            'sort_order' => $order_totals[$i]['sort_order']);
//                                              
//    tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
//  }
//
//  $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
//  $comments   = $HTTP_POST_VARS['comments'];
//  
//  $sql_data_array = array('orders_id' => $insert_id, 
//                          'orders_status_id' => $order->info['order_status'], 
//                          'date_added' => 'now()', 
//                          'customer_notified' => $customer_notification,
//                          'comments' => $comments);
//                                                
//  tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
//
//// initialized for the email confirmation
//  $products_ordered = '';
//  $subtotal = 0;
//  $total_tax = 0;
//
//  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
//// Stock Update - Joao Correia
//    if (STOCK_LIMITED == 'true') {
//      if (DOWNLOAD_ENABLED == 'true') {
//        $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename 
//                            FROM " . TABLE_PRODUCTS . " p
//                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
//                             ON p.products_id=pa.products_id
//                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
//                             ON pa.products_attributes_id=pad.products_attributes_id
//                            WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
//// Will work with only one option for downloadable products
//// otherwise, we have to build the query dynamically with a loop
//        $products_attributes = $order->products[$i]['attributes'];
//        if (is_array($products_attributes)) {
//          $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
//        }
//        $stock_query = tep_db_query($stock_query_raw);
//      } else {
//        $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//      }
//      if (tep_db_num_rows($stock_query) > 0) {
//        $stock_values = tep_db_fetch_array($stock_query);
//// do not decrement quantities if products_attributes_filename exists
//        if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
//          $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
//        } else {
//          $stock_left = $stock_values['products_quantity'];
//        }
//        tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//        if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
//          tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//        }
//      }
//    }
//
//// Update products_ordered (for bestsellers list)
//    tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//
//    $sql_data_array = array('orders_id' => $insert_id, 
//                            'products_id' => tep_get_prid($order->products[$i]['id']), 
//                            'products_model' => $order->products[$i]['model'], 
//                            'products_name' => $order->products[$i]['name'], 
//                            'products_price' => $order->products[$i]['price'], 
//                            'final_price' => $order->products[$i]['final_price'], 
//                            'products_tax' => $order->products[$i]['tax'], 
//                            'products_quantity' => $order->products[$i]['qty']);
//    tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
//    $order_products_id = tep_db_insert_id();
//
////------insert customer choosen option to order--------
//    $attributes_exist = '0';
//    $products_ordered_attributes = '';
//    if (isset($order->products[$i]['attributes'])) {
//      $attributes_exist = '1';
//      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
//        if (DOWNLOAD_ENABLED == 'true') {
//          $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename 
//                               from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa 
//                               left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
//                                on pa.products_attributes_id=pad.products_attributes_id
//                               where pa.products_id = '" . $order->products[$i]['id'] . "' 
//                                and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' 
//                                and pa.options_id = popt.products_options_id 
//                                and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' 
//                                and pa.options_values_id = poval.products_options_values_id 
//                                and popt.language_id = '" . $languages_id . "' 
//                                and poval.language_id = '" . $languages_id . "'";
//          $attributes = tep_db_query($attributes_query);
//        } else {
//          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
//        }
//        $attributes_values = tep_db_fetch_array($attributes);
//
//        $sql_data_array = array('orders_id' => $insert_id, 
//                                'orders_products_id' => $order_products_id, 
//                                'products_options' => $attributes_values['products_options_name'],
//                                'products_options_values' => $attributes_values['products_options_values_name'], 
//                                'options_values_price' => $attributes_values['options_values_price'], 
//                                'price_prefix' => $attributes_values['price_prefix']);
//        tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);
//
//        if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
//          $sql_data_array = array('orders_id' => $insert_id, 
//                                  'orders_products_id' => $order_products_id, 
//                                  'orders_products_filename' => $attributes_values['products_attributes_filename'], 
//                                  'download_maxdays' => $attributes_values['products_attributes_maxdays'], 
//                                  'download_count' => $attributes_values['products_attributes_maxcount']);
//          tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
//        }
//        $products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
//      }
//    }
////------insert customer choosen option eof ----
//    $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
//    $total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
//    $total_cost += $total_products_price;
//
//    $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' (' . $order->products[$i]['model'] . ') = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
//  }
//
// include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);
//
//// lets start with the email confirmation
//  $email_order = STORE_NAME . "\n" . 
//                 EMAIL_SEPARATOR . "\n" . 
//                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
//                 EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
//                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
//                               
//  if ($order->info['comments']) {
//    $email_order .= tep_db_output($order->info['comments']) . "\n\n";
//  }
//  $email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
//                  EMAIL_SEPARATOR . "\n" . 
//                  $products_ordered . 
//                  EMAIL_SEPARATOR . "\n";
//
//  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
//    $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
//  }
//
//  if ($order->content_type != 'virtual') {
//    $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" . 
//                    EMAIL_SEPARATOR . "\n" .
//                    tep_address_label($customer_id, $sendto, 0, '', "\n") . "\n";
//  }
//
//  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
//                  EMAIL_SEPARATOR . "\n" .
//                  tep_address_label($customer_id, $billto, 0, '', "\n") . "\n\n";
//  if (is_object($$payment)) {
//    $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" . 
//                    EMAIL_SEPARATOR . "\n";
//    $payment_class = $$payment;
//    $email_order .= $order->info['payment_method'] . "\n\n";
//    if ($payment_class->email_footer) { 
//      $email_order .= $payment_class->email_footer . "\n\n";
//    }
//  }
// // echo $email_order;
//  /*echo $order->customer['email_address']."customer";
//  echo STORE_OWNER_EMAIL_ADDRESS."owner";
//  exit;*/
//  tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
//
//// send emails to other people
//  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
//    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
//  }
//
//// load the after_process function from the payment modules
//  $payment_modules->after_process();
//
////  $cart->reset(true);
//
//// unregister session variables used during checkout
//  tep_session_unregister('sendto');
//  tep_session_unregister('billto');
//  tep_session_unregister('shipping');
//  tep_session_unregister('payment');
//  tep_session_unregister('comments');
        
        
        
        // tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS));
// tep_redirect(tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'));      
        
 /* if (isset($$payment->form_action_url)) {
    $form_action_url = $$payment->form_action_url;
        // print_r($HTTP_POST_VARS);
 //exit;
  }else{
   $url_val = $_SERVER['REQUEST_URI'];
        $url_val = explode('?',$url_val);
        //print_r($url_val[1]);
        $form_action_url = "checkout_confirmation.php?".$url_val[1];
  }*/
   
   

    $url_val = $_SERVER['REQUEST_URI'];
        $url_val = explode('?',$url_val);
        //print_r($url_val[1]);
        $form_action_url = "checkout_confirmation.php?".$url_val[1];
 
//  $form_action_url = "test.php?".$url_val[1];;
  //print_r($HTTP_POST_VARS);
  //tep_redirect(tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'));
  ?>
        
  <form name="checkout_confirmation" id="checkout_confirmation" action="<?php echo $form_action_url;?>" method="post" >
  <?php //echo tep_draw_form('checkout_confirmation', $form_action_url, 'post');
  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }

  ?>

 <input type="submit" name="fakeSubmitButton" style="display: none"/>
 <?php echo tep_draw_hidden_field('comments', $comments);
           echo tep_draw_hidden_field('payment', $payment);     
  ?>
 <script type="text/javascript">
//instead of calling document.forms['form name'].submit(); call
document.checkout_confirmation.fakeSubmitButton.click();
 </script>
 </form>

  <?php
  /* if(!empty($HTTP_POST_VARS['payment'])){
  echo $form_action_url."form url";
  exit;
        }*/
  /*echo "<script>";
  echo "document.getElementById('checkout_confirmation').submit()";
  echo "</script>";*/
 
  }

 }
 
 $addresses_count = tep_count_customer_address_book_entries();

/* if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }*/
  
  
?>
<?
                //print_r($HTTP_POST_VARS);
                /*if(!empty($HTTP_POST_VARS['payment'])){*/
 if ( (isset($$payment->form_action_url)) && ($error == '') && (tep_session_is_registered('customer_id'))) {
    $form_action_url = $payment->form_action_url;
//      echo "Entering";
//      exit;
//    tep_redirect('checkout_payment_form.php'); 
  } else {
    $form_action_url = tep_href_link(FILENAME_CHECKOUT, '', 'SSL');
  }
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
var selectedbilling;
var selectedshipping;
var selectedshipmethod;
var selectedpaymentmethod;

<!-------------------- SELECTION AND CSS FOR PAYMENT ---------------------------------->
function selectRowEffect_payment(object, buttonSelect) {
  if (!selectedpaymentmethod) {
    if (document.getElementById) {
      selectedpaymentmethod = document.getElementById('defaultSelected_payment');
    } else {
      selectedpaymentmethod = document.all['defaultSelected_payment'];
    }
  }

  if (selectedpaymentmethod) selectedpaymentmethod.className = 'moduleRow_payment';
  object.className = 'moduleRowSelected_payment';
  selectedpaymentmethod = object;

// one button is not an array
  if (document.checkout_payment.payment[0]) {
    document.checkout_payment.payment[buttonSelect].checked=true;
  } else {
    document.checkout_payment.payment.checked=true;
  }
}

function rowOverEffect_payment(object) {
  if (object.className == 'moduleRow_payment') object.className = 'moduleRowOver_payment';
}

function rowOutEffect_payment(object) {
  if (object.className == 'moduleRowOver_payment') object.className = 'moduleRow_payment';
}

<!-------------------- SELECTION AND CSS FOR SHIPPING METHODS ---------------------------------->

function selectRowEffect(object, buttonSelect) {
  if (!selectedshipmethod) {
    if (document.getElementById) {
      selectedshipmethod = document.getElementById('defaultSelected');
    } else {
      selectedshipmethod = document.all['defaultSelected'];
    }
  }

  if (selectedshipmethod) selectedshipmethod.className = 'moduleRow';
  object.className = 'moduleRowSelected';
  selectedshipmethod = object;

// one button is not an array
  if (document.checkout_payment.shipping[0]) {
    document.checkout_payment.shipping[buttonSelect].checked=true;
  } else {
    document.checkout_payment.shipping.checked=true;
  }
}

function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}

<!-------------------- SELECTION AND CSS FOR NEW SHIPPING ADDRESS ---------------------------------->

function selectRowEffect_ship(object, buttonSelect) {
  if (!selectedshipping) {
    if (document.getElementById) {
      selectedshipping = document.getElementById('defaultSelected_ship');
    } else {
      selectedshipping = document.all['defaultSelected_ship'];
    }
  }

  if (selectedshipping) selectedshipping.className = 'moduleRow_ship';
  object.className = 'moduleRowSelected_ship';
  selectedshipping = object;

// one button is not an array
  if (document.checkout_payment.ship_address[0]) {
    document.checkout_payment.ship_address[buttonSelect].checked=true;
  } else {
    document.checkout_payment.ship_address.checked=true;
  }
}

function rowOverEffect_ship(object) {
  if (object.className == 'moduleRow_ship') object.className = 'moduleRowOver_ship';
}

function rowOutEffect_ship(object) {
  if (object.className == 'moduleRowOver_ship') object.className = 'moduleRow_ship';
}

<!-------------------- SELECTION AND CSS FOR NEW BILLING ADDRESS ---------------------------------->

function selectRowEffect_bill(object, buttonSelect) {
  if (!selectedbilling) {
    if (document.getElementById) {
      selectedbilling = document.getElementById('defaultSelected_bill');
    } else {
      selectedbilling = document.all['defaultSelected_bill'];
    }
  }

  if (selectedbilling) selectedbilling.className = 'moduleRow_bill';
  object.className = 'moduleRowSelected_bill';
  selectedbilling = object;

// one button is not an array
  if (document.checkout_payment.address[0]) {
    document.checkout_payment.address[buttonSelect].checked=true;
  } else {
    document.checkout_payment.address.checked=true;
  }
}

function rowOverEffect_bill(object) {
  if (object.className == 'moduleRow_bill') object.className = 'moduleRowOver_bill';
}

function rowOutEffect_bill(object) {
  if (object.className == 'moduleRowOver_bill') object.className = 'moduleRow_bill';
}







function toggleShipping() {
        if(document.getElementById('ship_same').checked==true )
        {
                $('.address_shipping_new_onpage').hide();
                $('input[name=ship_firstname]').val($('input[name=firstname]').val());
                $('input[name=ship_lastname]').val($('input[name=lastname]').val());
                <?php if (ACCOUNT_COMPANY == 'true') {?>
                $('input[name=ship_company]').val($('input[name=company]').val());
                <?php } ?>
                $('input[name=ship_street_address]').val($('input[name=street_address]').val());
                <?php if (ACCOUNT_SUBURB == 'true') {?>
                $('input[name=ship_suburb]').val($('input[name=suburb]').val());
                <?php } ?>
                $('input[name=ship_city]').val($('input[name=city]').val());
                $('input[name=ship_postcode]').val($('input[name=postcode]').val());
                <?php if (ACCOUNT_STATE == 'true') {?>
                $('input[name=ship_state]').val($('input[name=state]').val());
                <?php } ?>
                $('input[name=ship_country]').val($('input[name=country]').val());
                <?php if(ACCOUNT_GENDER == 'true'){?>
                if($('input[name=genderm').checked==true){
                        $('input[name=ship_genderm').checked=true;
                }
                if($('input[name=genderf').checked==true){
                        $('input[name=ship_genderf').checked=true;
                }
                $('#ship_new').removeAttr("checked");
                
                $('.ship_address_show').hide();
                <?php } ?>    
        }else {
                $('.address_shipping_new_onpage').hide();
                $('input[name=ship_firstname]').val($('input[name=firstname]').val());
                $('input[name=ship_lastname]').val($('input[name=lastname]').val());
                <?php if (ACCOUNT_COMPANY == 'true') {?>
                $('input[name=ship_company]').val($('input[name=company]').val());
                <?php } ?>
                $('input[name=ship_street_address]').val($('input[name=street_address]').val());
                <?php if (ACCOUNT_SUBURB == 'true') {?>
                $('input[name=ship_suburb]').val($('input[name=suburb]').val());
                <?php } ?>
                $('input[name=ship_city]').val($('input[name=city]').val());
                $('input[name=ship_postcode]').val($('input[name=postcode]').val());
                <?php if (ACCOUNT_STATE == 'true') {?>
                $('input[name=ship_state]').val($('input[name=state]').val());
                <?php } ?>
                $('input[name=ship_country]').val($('input[name=country]').val());
                <?php if(ACCOUNT_GENDER == 'true'){?>
                if($('input[name=genderm').checked==true){
                        $('input[name=ship_genderm').checked=true;
                }
                if($('input[name=genderf').checked==true){
                        $('input[name=ship_genderf').checked=true;
                }
                <?php } ?>    
                $('.address_shipping_new_onpage').show();
                <?php if (!tep_session_is_registered('customer_id')): ?>
                $('.ship_address_show').show();
                <?php endif; ?> 
       
        }
}

// Data filling on key up for each field
function toggleShipping_fields(bill,ship){
        if(document.getElementById('ship_same').checked==true)
        {
              //  document.getElementById(ship).value =document.getElementById(bill).value;
        }
}
// Data filling onclick for radio fields
function toggleShipping_radioFields(){
        
        if(document.getElementById('ship_genderm').disabled==true){
        
        if(document.getElementById('genderm').checked==true){
                document.getElementById('ship_genderm').checked=true;
                document.getElementById('ship_genderf').checked=false;
        }
        if(document.getElementById('genderf').checked==true){
                document.getElementById('ship_genderf').checked=true;
                document.getElementById('ship_genderm').checked=false;
        }
        
        }
}

// For new shipping/billing address
function toggle_ship_new(addr){
        //alert(addr);
        var addr = addr
        var tmp;
        if(addr=='ship'){
                 tmp      =     'ship_';
        }else{ tmp = '';  }
        //alert("entering");
        
        if( document.getElementById(addr+'_new').checked==true )
        {       
               $('.'+addr+'_address_show').show();
        }
        
   
        else{
                //alert("entering else");
               $('.'+addr+'_address_show').hide();
                
        }
        
         if((addr=='ship') && (document.getElementById("ship_same").checked==true))
        {
              
        }
}

//--></script>

<?PHP 

/*require(DIR_WS_CLASSES . 'payment.php');
$payment_modules        = new payment;
echo is_object($payment_modules)."object";*/
//exit;
echo $payment_modules->javascript_validation(); 
if(!empty($HTTP_POST_VARS['payment'])){


  if (isset($HTTP_POST_VARS['payment_error']) && is_object(${$HTTP_POST_VARS['payment_error']}) && ($error = ${$HTTP_POST_VARS['payment_error']}->get_error())) {
        echo tep_output_string_protected($error['error']);
        }
        }
?>



<script src="AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<center>
<div id="centish">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><div id='leftlll'><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php //require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></div></td>
    
<!-- body_text //-->



    <td width="100%" valign="top">
        
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_delivery.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      
      
      <?php
  if ($messageStack->size('checkout_payment') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('checkout_payment'); ?></td>
      </tr>
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
<?php
  } if(tep_session_is_registered('customer_id')){
  ?>
  <tr>
        <td class="main"><?php echo ENTRY_TIP; ?></td>
      </tr>
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
  
  <?php }
  ?>
      
      
      
         <!------------------login ------------------------>  
         <?php if (!tep_session_is_registered('customer_id')) { ?>
         <tr>
                 <td class="main" colspan="2"><b><?php echo TEXT_RETURNING_CUSTOMER; ?></b></td>
                 </tr>
         <tr >
         
         <tr>
           <td >
                <?php echo tep_draw_form('login', tep_href_link(FILENAME_CHECKOUT, 'action=process', 'SSL')); ?>
                <table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContents">
                  
                 
                  <tr>
                    <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                    <td class="main"><?php echo tep_draw_input_field('email_address'); ?></td>
                    <td align=""><?php echo tep_image_submit('button_sign_in1.gif', IMAGE_BUTTON_LOGIN); ?></td>
                  </tr>
                  <tr>
                    <td class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
                    <td class="main"><?php echo tep_draw_password_field('password'); ?></td>
                     <td class="smallText" colspan=""><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
                  </tr>

                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      
                    </table></td>
                  </tr>
                </table>
                </form>
            </td>
          </tr>
            
       <!------------------login end------------------------>  
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
      
      <?php } ?>
       <!------------------new user------------------------>  
        <?php 
  /*}else{
        $form_action_url = tep_href_link(FILENAME_CHECKOUT, '', 'SSL');
  }*/
 
//  $form_action_url = 'checkout_payment_form.php';
  echo tep_draw_form('checkout_payment', $form_action_url, 'post', 'onsubmit="return check_form();"'). tep_draw_hidden_field('action', 'post'); 
                
                
                //echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT, '', 'SSL'), 'post', 'onsubmit="return check_form();"') . tep_draw_hidden_field('action', 'post'); ?>
       
       <?php if (!tep_session_is_registered('customer_id')) { ?> 
           
          <tr>
            <td class="main" style="color:red;"><b><?php echo TITLE_NEW_CUSTOMER; ?></b></td>
          </tr>
           
             <tr class="infoBoxContents"><td>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
              
       <?php
  if (ACCOUNT_DOB == 'true') {
?>
              <tr>
                <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
                <td class="main"><?php echo tep_draw_input_field('dob') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  }
?>
             <tr>
                <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('telephone') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
             </tr>
             <tr>
                <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                <td class="main"><?php echo tep_draw_input_field('email_address') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
             </tr>
            
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD; ?></td>
                <td class="main"><?php echo tep_draw_password_field('new_password') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
                <td class="main"><?php echo tep_draw_password_field('confirmation') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
              </tr>     
              </table>
            </td></tr>
        <? } ?>
       <!------------------Billing------------------------>  
       
       
<?php
    if ($addresses_count) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_ADDRESS; ?>:</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!--               <tr> -->
                
<!--                 <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_OTHER_PAYMENT_DESTINATION; ?></td> -->
<!--                 <td class="main" width="50%" valign="top" align="right"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td> -->
                
<!--               </tr> -->
<?php
      $radio_buttons_bill = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $customer_id . "'");
          
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);
?>
              <tr>
                
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
       if ($addresses['address_book_id'] == $billto) {
          echo '                  <tr id="defaultSelected_bill" class="moduleRowSelected_bill" onmouseover="rowOverEffect_bill(this)" onmouseout="rowOutEffect_bill(this)" onclick="selectRowEffect_bill(this, ' . $radio_buttons_bill . ')">' . "\n";
                  // echo '                  <tr id="defaultSelected_bill" onmouseover="rowOverEffect_bill(this)" onmouseout="rowOutEffect_bill(this)" onclick="selectRowEffect_bill(this, ' . $radio_buttons_bill . ')">' . "\n";
        } else {
          echo '                  <tr class="moduleRow_bill" onmouseover="rowOverEffect_bill(this)" onmouseout="rowOutEffect_bill(this)" onclick="selectRowEffect_bill(this, ' . $radio_buttons_bill . ')">' . "\n";
        }
?>
                    
                    <td class="main" colspan="2"><b><?php echo $addresses['firstname'] . ' ' . $addresses['lastname']; ?></b></td>
<!--                     <td class="main" align="right"><?php echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $billto)); ?></td> -->
                    
                  </tr>
                  <tr>
                    
                    <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        
                        <td class="main"><?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?></td>
                        
                      </tr>
                    </table></td>
                    
                  </tr>
                 
                </table></td>
                
              </tr>
<?php
        $radio_buttons_bill++;
      }
?> 
            </table></td>
          </tr>
        </table></td>
      </tr>
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
<?php
    } if(tep_session_is_registered('customer_id')){
 ?>
         
    <!-- <tr class="infoBoxContents">
          <td>
       
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="infoBoxContents">
                    <td class="main" ><?PHP echo tep_draw_checkbox_field('bill_new','','','onclick="toggle_ship_new(\'bill\');" id="bill_new"');?><b><?php echo TITLE_NEW_BILLING_ADDRESS; ?></b></td>
                  </tr>
                </table>
         
                </td>  
           </tr>-->
<?php } else {?>
                  
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
      
      <tr>
      
        <td>
      
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main <?php if (tep_session_is_registered('customer_id')) echo "bill_address_show";?>"><b><?php echo TITLE_BILLING_ADDRESS; ?></b></td>
          </tr>
        </table>
      
        </td>
      </tr>
     
     
     

      <tr>
        <td>
        
  
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
            
            
            
            
            
    
         <tr class="infoBoxContents <?php if (tep_session_is_registered('customer_id')) echo "bill_address_show";?>">
                <td>
         
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><?php require(DIR_WS_MODULES . 'checkout_new_address.php');//require(DIR_WS_MODULES . 'checkout_billing_address.php'); ?></td>
                  </tr>
                </table>
         
                </td>
                  </tr>
       <?php } ?> 
    <!------------------Billing end------------------------>  
    
        
        <tr class="infoBoxContents">
        <td class="main" style="display:none">
        <?PHP 
                 echo tep_draw_checkbox_field('ship_same','',true,'onclick="toggleShipping();" id="ship_same"').TITLE_CHKBOX_SAMEAS;    ?>
        </td>
        </tr>
    <!---------------------shipping address-------------------------->  
        
        <?php if ($addresses_count > 1) {?>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main address_shipping_new_onpage"><b><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></b></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
                  <tr class="infoBoxContents address_shipping_new_onpage">
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        
                        <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_OTHER_SHIPPING_DESTINATION; ?></td>
                        <td class="main" width="50%" valign="top" align="right"><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
                        
                      </tr>
        <?php
              $radio_buttons_ship = 0;
        
              $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'");
              while ($addresses = tep_db_fetch_array($addresses_query)) {
                $format_id = tep_get_address_format_id($addresses['country_id']);
        ?>
                      <tr>
                        
                        <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <?php
               if ($addresses['address_book_id'] == $sendto) {
                  echo '                  <tr id="defaultSelected_ship" class="moduleRowSelected_ship" onmouseover="rowOverEffect_ship(this)" onmouseout="rowOutEffect_ship(this)" onclick="selectRowEffect_ship(this, ' . $radio_buttons_ship . ')">' . "\n";
                                //  echo '                  <tr id="defaultSelected_ship" onmouseover="rowOverEffect_ship(this)" onmouseout="rowOutEffect_ship(this)" onclick="selectRowEffect_ship(this, ' . $radio_buttons_ship . ')">' . "\n";
                } else {
                  echo '                  <tr class="moduleRow_ship" onmouseover="rowOverEffect_ship(this)" onmouseout="rowOutEffect_ship(this)" onclick="selectRowEffect_ship(this, ' . $radio_buttons_ship . ')">' . "\n";
                }
        ?>
                            
                            <td class="main" colspan="2"><b><?php echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></b></td>
                            <td class="main" align="right"><?php echo tep_draw_radio_field('ship_address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto)); ?></td>
                            
                          </tr>
                          <tr>
                            
                            <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
                              <tr>
                                
                                <td class="main"><?php echo tep_address_format($format_id, $addresses, true, ' ', ', '); ?></td>
                                
                              </tr>
                            </table></td>
                            
                          </tr>
                        </table></td>
                        
                      </tr>
        <?php
                $radio_buttons_ship++;
              }
        ?>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
<tr height="10"><td></td></tr>
<!--         <tr> -->
<!--         <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td> -->
<!--         </tr> -->
<!--       <tr height="30"><td></td></tr> -->
        <?php } ?>         
         
    <!---------------------end shipping address-------------------------->  

    <!---------------------New shipping address-------------------------->  
    
        <!--<?php 
                if(tep_session_is_registered('customer_id')){ ?>
        <tr><td>
       <table border="0" width="100%" cellspacing="0" cellpadding="2" >
                  <tr class="infoBoxContents">
                   <td class="main address_shipping_new_onpage"><?PHP echo tep_draw_checkbox_field('ship_new','','','onclick="toggle_ship_new(\'ship\');" id="ship_new"');?><b><?php echo TITLE_NEW_SHIPPING_ADDRESS; ?></b></td>
                  </tr>
                </table>
          </td></tr>
          <?php } ?>    
        <tr><td width="10" class="main ship_address_show"><b><?php echo TITLE_SHIPPING_ADDRESS; ?></b></td></tr>
                
         <tr class="infoBoxContents ship_address_show">
          <td>
         
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><?php require(DIR_WS_MODULES . 'checkout_shipping_address.php'); ?></td>
                  </tr>
                </table>
         
                </td>  
           </tr>
            
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>-->
      
      <!--shipping method-->           
            
       <tr style="display:none">
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php 
  if (tep_count_shipping_modules() > 0) {
?>
      <tr style="display:none">
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr style="display:none">
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php //print_r($quotes);
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
<?php
    } elseif ($free_shipping == false) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
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
                    <td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
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
              <tr style="display:none">
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

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
                          //echo '                  <tr id="defaultSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            } else {
              echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
            }
?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" width="75%"><?php echo $quotes[$i]['methods'][$j]['title']; ?></td>
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
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
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
        </table></td>
      </tr>
      <tr style="display:none">
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
        }
 ?>        
 
    <!------------------Payment------------------------>  
        
        <tr><td width="10" class="main"><b><?php echo TITLE_PAYMENT_METHOD; ?></b></td></tr>
                <tr><td><?php // tep_address_label($customer_id, $customer_default_address_id, true, ' ', '<br>'); ?></td></tr>
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php 

$selection = $payment_modules->selection();
//print_r($selection);

  if (sizeof($selection) > 1) {
?>
              <tr>
                
                <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></td>
<!--                 <td class="main" width="50%" valign="top" align="right"><b><?php echo TITLE_PLEASE_SELECT; ?></b><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td> -->
                
              </tr>
<?php
  } else {
?>
              <tr>
                
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></td>
                
              </tr>
<?php
  }

  $radio_buttons_pay = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
              <tr>
                
                <td colspan="2" ><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '                  <tr id="defaultSelected_payment"  class="moduleRowSelected_payment" onmouseover="rowOverEffect_payment(this)" onmouseout="rowOutEffect_payment(this)" onclick="selectRowEffect_payment(this, ' . $radio_buttons_pay . ')">' . "\n";
          //echo '                  <tr id="defaultSelected_payment" onmouseover="rowOverEffect_payment(this)" onmouseout="rowOutEffect_payment(this)" onclick="selectRowEffect_payment(this, ' . $radio_buttons_pay . ')">' . "\n";
    } else {
      echo '                  <tr class="moduleRow_payment" onmouseover="rowOverEffect_payment(this)" onmouseout="rowOutEffect_payment(this)" onclick="selectRowEffect_payment(this, ' . $radio_buttons_pay . ')">' . "\n";
    }
?>
                    
<!--                     <td class="main" colspan="3"><b><?php echo $selection[$i]['module']; ?></b></td> -->
                    <td class="main" align="right">
<?php 
    if (sizeof($selection) > 1) {
      echo tep_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $payment));
    } else {
      echo tep_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>
<?php
    if (isset($selection[$i]['error'])) {
?>
                  <tr>
                    
                    <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
                    
                  </tr>
<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>
                  <tr>
                    
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
                      <tr>
                        
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                        
                      </tr>
<?php
      }
?>
                    </table></td>
                    
                  </tr>
<?php
    }
?>
                </table></td>
                
              </tr>
<?php
    $radio_buttons_pay++;
  }
?>
            </table></td>
          </tr>
           
           
    <!------------------Payment end------------------------>  
            
<tr height="10"><td></td></tr>
        <tr>
        <td colspan=""><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
        </tr>
      <tr height="30"><td></td></tr>
      
         
    
     <!-----------------confirmation--------------------------->
       
           <tr> 
                <td width="<?php echo (($sendto != false) ? '70%' : '100%'); ?>" valign="top" class="main"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBox">
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
                  <tr>
                    <td class="main" colspan="2"><?php echo '<b>' . HEADING_PRODUCTS . '</b> <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
<!--                     <td class="smallText" align="right"><b><?php echo HEADING_TAX; ?></b></td> -->
                    <td class="smallText" align="right"><b><?php echo HEADING_TOTAL; ?></b></td>
                  </tr>
<?php
  } else { 
?>
                  <tr>
                    <td class="main" colspan="3"><?php echo '<b>' . HEADING_PRODUCTS . '</b> <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '"><span class="orderEdit">(' . TEXT_EDIT . ')</span></a>'; ?></td>
                  </tr>
<?php
  }
        
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
  
    echo '          <tr>' . "\n" .
         '            <td class="main" align="right" valign="top" width="30"><b>' . $order->products[$i]['qty'] . '</b>&nbsp;x&nbsp;</td>' . "\n" .
         '            <td class="main" valign="top">' . $order->products[$i]['name'];

    if (STOCK_CHECK == 'true') {
      echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
    }

    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></small></nobr>';
      }
    }

    echo '</td>' . "\n";
    echo '<td class="main" valign="top">' . get_description($order->products[$i]['id']).'</td>';
//     if (sizeof($order->info['tax_groups']) > 1) echo '            <td class="main" valign="top" align="left">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";

    echo '            <td class="main" align="left" valign="top">' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</td>' . "\n" .
         '          </tr>' . "\n";
  }
?>     
 
</table>
<table >

<tr>

<td class="infoBox"  colspan="2">
<?php 
 
  if (MODULE_ORDER_TOTAL_INSTALLED) {
   // echo $order_total_modules->output();
  }
?>

<?php 
    // $shipping_modules = new shipping;
    $subtotal_cart = $cart->show_total();
    $quote = $shipping_modules->quote('flat', 'flat');
    $fp = $quote[0]['methods'][0]['cost'];
    $nb_discount_cart = $nb_products_discount->discount;
    $discount_cart = $easy_discount->total() + $nb_discount_cart;
    $total_cart = $subtotal_cart - $discount_cart + $fp; 
    function  get_description($id){
//         print_r( $_SESSION);
        $sql = "SELECT products_description FROM products_description WHERE products_id = '".$id."' and language_id = '".(int)$_SESSION['languages_id']."';";
       // print_r($sql) ;
        
        $attributes = tep_db_query($sql);
        $attributes_values = tep_db_fetch_array($attributes);
        $description = $attributes_values['products_description'];
        return $description;
    }
    ?>
                                                
<table cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                        <strong><?php echo SUB_TITLE_SUB_TOTAL; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span class="productSpecialPrice"><?php echo $currencies->format($cart->show_total()); ?></span>
                                                </td>
                                        </tr>
                    <?php
                    if ($discount_cart > 0) {
                        if (sizeof($discounts) > 1 || $nb_discount_cart > 0 && sizeof($discounts) > 0)
                            foreach ($discounts as $discount) {
                        ?>
                                        <tr>
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                            <strong><?php echo $discount['description']; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span class="productSpecialPrice">-<?php echo $currencies->format($discount['amount']); ?></span>
                                                </td>
                                        </tr>
                        <?php }
                        if ($nb_discount_cart > 0) { ?>
                                        <tr>
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                        <strong><?php echo SUB_TITLE_NB_PRODUCTS_DISCOUNT; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span class="productSpecialPrice">-<?php echo $currencies->format($nb_discount_cart); ?></span>
                                                </td>
                                        </tr>
                    <?php }
                        if (sizeof($discounts) > 0) { ?>
                                        <tr>
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                        <strong><?php echo SUB_TITLE_EASY_DISCOUNT; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span class="productSpecialPrice">-<?php echo $currencies->format($discount_cart); ?></span>
                                                </td>
                                        </tr>
                    <?php }
                        } ?>
                                        <tr>
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                        <strong><?php echo SUB_TITLE_FRAIS_PORT; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span class="productSpecialPrice"><?php echo $fp <= 0 ? FREE_SHIPPING_COST : $currencies->format($fp); ?></span>
                                                </td>
                                        </tr>
                                        <tr>
                                                
                                                <td width="80%" align="right" class="cart_total_left" nowrap>
                        <strong><?php echo SUB_TITLE_TOTAL; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="20%" align="center" class="cart_total_right">
                                                        <span id="order_total" class="productSpecialPrice"><?php echo $currencies->format($total_cart <= 0 ? 0 : $total_cart);?></span>
                                                </td>
                                        </tr>
    </table>


</td></tr>
                </table></td>
              </tr>
              <tr>
                <td width="70%" valign="top" align="left"><table border="0" cellspacing="0" cellpadding="2">
           
            </table></td> </tr>
            </table>
      </td></tr>
      
     <!-----------------confirmation end--------------------------->
      
    
      
                           
            
            <tr><td>
           <?php   echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONFIRM_ORDER) . "\n"; ?>
           </td></tr>
            
            </td>
          </tr>
        </table>   </form>
        </td>
      </tr>
  
     
     
    
    
    
    
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><div id="rightlll"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></div></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>