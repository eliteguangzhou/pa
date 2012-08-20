<?php
/*
  $Id: paypal_wpp.php,v 0.5 2005/10/31 Brian Burton brian@dynamoeffects.com Exp $

  Copyright (c) 2005 Brian Burton - brian@dynamoeffects.com

  Released under the GNU General Public License
*/

  //If the user installed the included pear modules, make sure it's in the include path
  if (trim(MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH) != '') {
    if (is_dir(MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH)) {
    
      $inc = ini_get('include_path');
      $inc_exp = explode(PATH_SEPARATOR, $inc); 
      
      if(!in_array(MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH, $inc_exp)) {
        ini_set('include_path', MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH . PATH_SEPARATOR . $inc);
      }
    }
  }
  
  class paypal_wpp {
    var $code, $title, $description, $enabled;
    
    function paypal_wpp() {
      global $order;
      $this->code = 'paypal_wpp';
      $this->codeTitle = 'PayPal Direct Payment & Express Checkout Payment Module';
      $this->codeVersion = '0.5';
      
      //Change this to '1' and a vardump of PayPal's response will be emailed to the store owner when an error occurs.
      //'0' = Disabled
      $this->enableDebugging = '0';
      
      $this->title = MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PAYPAL_DP_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYPAL_DP_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYPAL_DP_STATUS == 'True') ? true : false);
      if ((int)MODULE_PAYMENT_PAYPAL_DP_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYPAL_DP_ORDER_STATUS_ID;
      }
      if (is_object($order)) $this->update_status();
    }  
    
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYPAL_DP_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYPAL_DP_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      global $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;

      if (tep_session_is_registered('paypal_ec_token') && tep_session_is_registered('paypal_ec_payer_id') && tep_session_is_registered('paypal_ec_payer_info')) {
        return false;
      } else {
        $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
              '    var cc_owner = document.checkout_payment.paypalwpp_cc_firstname.value + " " + document.checkout_payment.paypalwpp_cc_lastname.value;' . "\n" .
              '    var cc_number = document.checkout_payment.paypalwpp_cc_number.value;' . "\n" .
              '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
              '      error_message = error_message + "' . MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_OWNER . '";' . "\n" .
              '      error = 1;' . "\n" .
              '    }' . "\n" .
              '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
              '      error_message = error_message + "' . MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_NUMBER . '";' . "\n" .
              '      error = 1;' . "\n" .
              '    }' . "\n" .
              '  }' . "\n";
  
        return $js;
      }
    }

    function selection() {
      global $order;

      for ($i=1; $i < 13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $selection = array('id' => $this->code,
                         'module' => MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE,
                         'fields' => array(array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_FIRSTNAME,
                                                 'field' => tep_draw_input_field('paypalwpp_cc_firstname', $order->billing['firstname'])),
                                           array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_LASTNAME,
                                                 'field' => tep_draw_input_field('paypalwpp_cc_lastname', $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_TYPE,
                                                 'field' => tep_draw_pull_down_menu('paypalwpp_cc_type', array(array('id' => 'Visa', 'text' => 'Visa'),
                                                                                                               array('id' => 'MasterCard', 'text' => 'MasterCard'),
                                                                                                               array('id' => 'Discover', 'text' => 'Discover'),
                                                                                                               array('id' => 'Amex', 'text' => 'American Express')))),                                                                                                              
                                           array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('paypalwpp_cc_number', '')),
                                           array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('paypalwpp_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('paypalwpp_cc_expires_year', $expires_year)),
                                           array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER,
                                                 'field' => tep_draw_input_field('paypalwpp_cc_checkcode', '', 'size="4" maxlength="4"') . '&nbsp;<small>' . MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION . '</small>')));
      
      if (MODULE_PAYMENT_PAYPAL_DP_BUTTON_PAYMENT_PAGE == 'Yes') {
        $selection['fields'][] = array('title' => '<b>' . MODULE_PAYMENT_PAYPAL_DP_TEXT_EC_HEADER . '</b>',
                                       'field' => '<a href="' . tep_href_link('ec_process.php', '', 'SSL') . '"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" border=0 style="padding-right:10px;padding-bottom:10px"></a><br><span style="font-size:11px; font-family: Arial, Verdana;">' . MODULE_PAYMENT_PAYPAL_DP_TEXT_BUTTON_TEXT . '</span></td>');
      }

      return $selection;
    }
    
//This is the credit card check done between checkout_payment.php and checkout_confirmation.php (called from checkout_confirmation.php)
    function pre_confirmation_check() {
      global $HTTP_POST_VARS, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;
      //If this is an EC checkout, do nuttin'
      if (tep_session_is_registered('paypal_ec_token') && tep_session_is_registered('paypal_ec_payer_id') && tep_session_is_registered('paypal_ec_payer_info')) {
        return false;
      } else {
        include(DIR_WS_CLASSES . 'cc_validation.php');
  
        $cc_validation = new cc_validation();
        $result = $cc_validation->validate($HTTP_POST_VARS['paypalwpp_cc_number'], $HTTP_POST_VARS['paypalwpp_cc_expires_month'], $HTTP_POST_VARS['paypalwpp_cc_expires_year']);
  
        $error = '';
        switch ($result) {
          case -1:
            $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
            break;
          case -2:
          case -3:
          case -4:
            $error = TEXT_CCVAL_ERROR_INVALID_DATE;
            break;
          case false:
            $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
            break;
        }
  
        if ( ($result == false) || ($result < 1) ) {          
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_CARD_ERROR . '<br><br>' . $error, false, true);
        }
  
        $this->cc_card_type = $cc_validation->cc_type;
        $this->cc_card_number = $cc_validation->cc_number;
        $this->cc_expiry_month = $cc_validation->cc_expiry_month;
        $this->cc_expiry_year = $cc_validation->cc_expiry_year;
      }
    }

    function confirmation() {
      global $HTTP_POST_VARS, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;

      if (tep_session_is_registered('paypal_ec_token') && tep_session_is_registered('paypal_ec_payer_id') && tep_session_is_registered('paypal_ec_payer_info')) {
        $confirmation = array('title' => MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE, 'fields' => array());
      } else {
        $confirmation = array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE,
                              'fields' => array(array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_FIRSTNAME,
                                                      'field' => $HTTP_POST_VARS['paypalwpp_cc_firstname']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_LASTNAME,
                                                      'field' => $HTTP_POST_VARS['paypalwpp_cc_lastname']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_TYPE,
                                                      'field' => $HTTP_POST_VARS['paypalwpp_cc_type']),
                                                array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_NUMBER,
                                                      'field' => substr($HTTP_POST_VARS['paypalwpp_cc_number'], 0, 4) . str_repeat('X', (strlen($HTTP_POST_VARS['paypalwpp_cc_number']) - 8)) . substr($HTTP_POST_VARS['paypalwpp_cc_number'], -4)),
                                                array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_EXPIRES,
                                                      'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['paypalwpp_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['paypalwpp_cc_expires_year'])))));
  
        if (tep_not_null($HTTP_POST_VARS['paypalwpp_cc_checkcode'])) {
          $confirmation['fields'][] = array('title' => MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER,
                                            'field' => $HTTP_POST_VARS['paypalwpp_cc_checkcode']);
        }
      }
      return $confirmation;
    }
    
    //Be gone with yo stank self
    function away_with_you($error_msg = '', $kill_sess_vars = false, $goto_payment = false) {
      global $customer_first_name, $customer_id, $navigation, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info, $paypal_error, $paypal_ec_temp;
      
      if ($kill_sess_vars) {
        if ($paypal_ec_temp) { 
          $this->ec_delete_user($customer_id);
        }
        //Unregister the paypal session variables making the user start over
        if (tep_session_is_registered('paypal_ec_temp')) tep_session_unregister('paypal_ec_temp');
        if (tep_session_is_registered('paypal_ec_token')) tep_session_unregister('paypal_ec_token');
        if (tep_session_is_registered('paypal_ec_payer_id')) tep_session_unregister('paypal_ec_payer_id');
        if (tep_session_is_registered('paypal_ec_payer_info')) tep_session_unregister('paypal_ec_payer_info');
      }
      
      if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
        if ($goto_payment) {
          $redirect_path = FILENAME_CHECKOUT_PAYMENT;
        } else {
          $redirect_path = FILENAME_CHECKOUT_SHIPPING;
        }
      } else {
        $navigation->set_snapshot(FILENAME_CHECKOUT_SHIPPING);
        $redirect_path = FILENAME_LOGIN;
      }
      if ($error_msg) {
        if (!tep_session_is_registered('paypal_error')) tep_session_register('paypal_error');
        $_SESSION['paypal_error'] = $error_msg;
      } else {
        if (tep_session_is_registered('paypal_error')) tep_session_unregister('paypal_error');
      }
      tep_redirect(tep_href_link($redirect_path, '', 'SSL', true, false));
    }
    
    function process_button() {
      global $HTTP_POST_VARS, $order, $currencies, $currency, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;

      if (tep_session_is_registered('paypal_ec_token') && tep_session_is_registered('paypal_ec_payer_id') && tep_session_is_registered('paypal_ec_payer_info')) {
        return '';
      } else {
        switch (MODULE_PAYMENT_PAYPAL_DP_CURRENCY) {
          case 'Always EUR':
            $wpp_currency = 'EUR';
            break;
          case 'Always USD':
            $wpp_currency = 'USD';
            break;
          case 'Either EUR or USD, else EUR':
            if ( ($currency == 'EUR') || ($currency == 'USD') ) {
              $wpp_currency = $currency;
            } else {
              $wpp_currency = 'EUR';
            }
            break;
          case 'Either EUR or USD, else USD':
            if ( ($currency == 'EUR') || ($currency == 'USD') ) {
              $wpp_currency = $currency;
            } else {
              $wpp_currency = 'USD';
            }
            break;
        }
  
        $process_button_string = tep_draw_hidden_field('wpp_cc_type', $HTTP_POST_VARS['paypalwpp_cc_type']) .
                                 tep_draw_hidden_field('wpp_cc_expdate_month', $HTTP_POST_VARS['paypalwpp_cc_expires_month']) .
                                 tep_draw_hidden_field('wpp_cc_expdate_year', $HTTP_POST_VARS['paypalwpp_cc_expires_year']) .
                                 tep_draw_hidden_field('wpp_cc_number', $HTTP_POST_VARS['paypalwpp_cc_number']) .
                                 tep_draw_hidden_field('wpp_cc_checkcode', $HTTP_POST_VARS['paypalwpp_cc_checkcode']) .
                                 tep_draw_hidden_field('wpp_payer_firstname', $HTTP_POST_VARS['paypalwpp_cc_firstname']) .
                                 tep_draw_hidden_field('wpp_payer_lastname', $HTTP_POST_VARS['paypalwpp_cc_lastname']) .
                                 tep_draw_hidden_field('wpp_redirect_url', tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true));
  
        return $process_button_string;
      }
    }
    
    //Initialize the connection with PayPal
    function paypal_init() {
      global $customer_id, $customer_first_name;

      require_once ('Services/PayPal.php');
      require_once ('Services/PayPal/Profile/Handler/Array.php');
      require_once ('Services/PayPal/Profile/API.php');

      $handler =& ProfileHandler_Array::getInstance(array(
        'username' => MODULE_PAYMENT_PAYPAL_DP_API_USERNAME,
        'certificateFile' => MODULE_PAYMENT_PAYPAL_DP_CERT_PATH,  //This needs to be an absolute path i.e. /home/user/cert.txt
        'subject' => '',
        'environment' => MODULE_PAYMENT_PAYPAL_DP_SERVER));
      
      $profile = APIProfile::getInstance(MODULE_PAYMENT_PAYPAL_DP_API_USERNAME, $handler);
      $profile->setAPIPassword(MODULE_PAYMENT_PAYPAL_DP_API_PASSWORD);
      
      $caller =& Services_PayPal::getCallerServices($profile); //Create a caller object.  Ring ring, who's there?

      if(Services_PayPal::isError($caller))  {
        $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_GEN_ERROR  . $caller->Errors->ShortMessage . '<br>' . $caller->Errors->LongMessage . ' (' . $caller->Errors->ErrorCode . ')', true);
        
        if ($this->enableDebugging == '1') {
          tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Error Dump', "In function: paypal_init()\r\n\r\n" . var_dump($caller), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
      } else {
        return $caller;
      }
    }

    //This function sends the user to PayPal's site
    function ec_step1() {
      global $order, $customer_first_name, $customer_id, $languages_id;

      require(DIR_WS_CLASSES . 'order.php');
      $order = new order;
      
      //Find out the user's language so that if PayPal supports it, it'll be the language used on PayPal's site.
      $lang_query = tep_db_query("SELECT CODE FROM " . TABLE_LANGUAGES . " WHERE languages_id = '".$languages_id."' LIMIT 1");

      if(tep_db_num_rows($lang_query)) {
        $lang_id = tep_db_fetch_array($lang_query);

        //Only these 5 country codes are valid, so default to the good ol' US of A if they're from Krazakalakstan
        switch ($lang_id['code']) {
          case 'de':
            $lang_code = 'DE';
            break;
          case 'fr':
            $lang_code = 'FR';
            break;
          case 'it':
            $lang_code = 'IT';
            break;
          case 'ja':
            $lang_code = 'JP';
            break;
          default:
            $lang_code = 'US';
            break;
        }
      } else {
        $lang_code = 'US';
      }      
      
      $caller = $this->paypal_init();
      $ot =& Services_PayPal::getType('BasicAmountType');
      $ot->setval(number_format($order->info['total'], 2));
      
      //As PayPal only accepts USD at this time, this conditional is useless, but written for when they start accepting other forms of currency
      switch (MODULE_PAYMENT_PAYPAL_DP_CURRENCY) {
      default:
        $currency_id = 'USD';
        break;
      }
      
      $ot->setattr('currencyID', $currency_id);

      $ecdt =& Services_PayPal::getType('SetExpressCheckoutRequestDetailsType');
      $ecdt->setOrderTotal($ot);
      $ecdt->setReturnURL(tep_href_link(FILENAME_EC_PROCESS, '', 'SSL'));
      
      if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
        $redirect_path = FILENAME_CHECKOUT_SHIPPING;
        $redirect_attr = 'ec_cancel=1';
      } else {
        $redirect_path = FILENAME_LOGIN;
        $redirect_attr = 'ec_cancel=1';
      }
      $ecdt->setCancelURL(tep_href_link($redirect_path, $redirect_attr, 'SSL'));
      
      if(MODULE_PAYMENT_PAYPAL_DP_CONFIRMED == 'Yes') {
        $ecdt->setReqConfirmShipping(1);
      }

      $ecdt->setLocaleCode($lang_code);
      
      $ec =& Services_PayPal::getType('SetExpressCheckoutRequestType');
      $ec->setSetExpressCheckoutRequestDetails($ecdt);

      $response = $caller->SetExpressCheckout($ec);

      if(Services_PayPal::isError($response) || ($response->Ack != 'Success' && $response->Ack != 'SuccessWithWarning')) {
        $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_GEN_ERROR . $response->Errors->ShortMessage . '<br>' . $response->Errors->LongMessage . ' (' . $response->Errors->ErrorCode . ')', true);
        
        if ($this->enableDebugging == '1') {
          tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Error Dump', "In function: ec_step1()\r\n\r\n" . var_dump($response), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
        
      } else {
        tep_session_register('paypal_ec_token');
        $paypal_ec_token = $response->getToken();
        if(MODULE_PAYMENT_PAYPAL_DP_SERVER == 'live') {
          $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        } else {
          $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }
        tep_redirect($paypal_url."?cmd=_express-checkout&token=".$paypal_ec_token);
      }
    }
    
    function ec_step2() {
      global $HTTP_GET_VARS, $paypal_ec_token, $customer_id, $customer_first_name, $language;
      global $customer_default_address_id, $sendto;
      //Visitor just came back from PayPal and so we collect all the info returned, create an account if necessary, 
      //then log them in, and then send them to checkout_shipping.php.  What a long, strange trip it's been.
      
      if ($paypal_ec_token == '') {
        if (isset($HTTP_GET_VARS['token'])) {
          $paypal_ec_token = $HTTP_GET_VARS['token'];
        } else {
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE, true);
        }
      }
      //Make sure the token is in the correct format
      if (!ereg("([C-E]{2})-([A-Z0-9]{17})", $paypal_ec_token)){
        $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE, true);
      }
      
      $caller = $this->paypal_init();
      $ecdt =& Services_PayPal::getType('GetExpressCheckoutDetailsRequestType');
      $ecdt->setToken($paypal_ec_token);
      
      $response = $caller->GetExpressCheckoutDetails($ecdt);
      if(strlen(Services_PayPal::isError($response)) > 0  || ($response->Ack != 'Success' && $response->Ack != 'SuccessWithWarning')) {
        $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_GEN_ERROR . $response->Errors->ShortMessage . '<br>' . $response->Errors->LongMessage . ' (' . $response->Errors->ErrorCode . ')', true);

        if ($this->enableDebugging == '1') {
          tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Error Dump', "In function: ec_step2()\r\n\r\n" . var_dump($response), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }

      } else {
        tep_session_register('paypal_ec_payer_id');
        
        //This is an array of all the info sent back by PayPal
        tep_session_register('paypal_ec_payer_info');

        $details = $response->getGetExpressCheckoutDetailsResponseDetails();
        $payer_info = $details->getPayerInfo();

        if(MODULE_PAYMENT_PAYPAL_DP_REQ_VERIFIED == 'Yes' && strtolower($payer_info->PayerStatus) != 'verified') {
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_EC_TEXT_UNVERIFIED, true);
        }

        $paypal_ec_payer_id = $payer_info->getPayerID();

        $_SESSION['paypal_ec_payer_id'] = $paypal_ec_payer_id;

        $fullname = $payer_info->getPayerName();
        $address_info = $payer_info->getAddress();
        //I didn't include the international variables since PayPal only supports USD at this time
        $paypal_ec_payer_info = array(
            'payer_id' => $payer_info->PayerID, 
            'payer_email' => $payer_info->Payer, 
            'payer_firstname' => $fullname->FirstName,
            'payer_lastname' => $fullname->LastName,
            'payer_business' => $payer_info->PayerBusiness,
            'payer_status' => $payer_info->PayerStatus,
            'ship_owner' => $address_info->AddressOwner,
            'ship_name' => $address_info->Name,
            'ship_street_1' => $address_info->Street1,
            'ship_street_2' => $address_info-> Street2,
            'ship_city' => $address_info->CityName,
            'ship_state' => $address_info->StateOrProvince,
            'ship_postal_code' => $address_info->PostalCode,
            'ship_country' => $address_info->Country,
            'ship_country_name' => $address_info->CountryName,
            'ship_phone' => $address_info->Phone,
            'ship_address_status' => $address_info->AddressStatus);

        $_SESSION['paypal_ec_payer_info'] = $paypal_ec_payer_info;

        //Get the customer's country ID.
        $country_query = tep_db_query("SELECT countries_id, address_format_id FROM ".TABLE_COUNTRIES." WHERE countries_name = '".$paypal_ec_payer_info['ship_country_name']."' LIMIT 1");
        if (tep_db_num_rows($country_query) > 0) {
          $country = tep_db_fetch_array($country_query);
          $country_id = $country['countries_id'];
          $address_format_id = $country['address_format_id'];
        } else {
          $country_id = '';
          $address_format_id = '2'; //2 is the American format
        }
        
        $states_query = tep_db_query("SELECT zone_id FROM ".TABLE_ZONES." WHERE zone_code = '".$paypal_ec_payer_info['ship_state']."' AND zone_country_id = '".$country_id."' LIMIT 1");
        if (tep_db_num_rows($states_query) > 0) {
          $states = tep_db_fetch_array($states_query);
          $state_id = $states['zone_id'];
        } else {
          $state_id = '';
        }

        $order->customer['name'] = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
        $order->customer['company'] = $paypal_ec_payer_info['payer_business'];
        $order->customer['street_address'] = $paypal_ec_payer_info['ship_street_1'];
        $order->customer['suburb'] = $paypal_ec_payer_info['ship_street_2'];
        $order->customer['city'] = $paypal_ec_payer_info['ship_city'];
        $order->customer['postcode'] = $paypal_ec_payer_info['ship_postal_code'];
        $order->customer['state'] = $paypal_ec_payer_info['ship_state'];
        $order->customer['country'] = $paypal_ec_payer_info['ship_country_name'];
        $order->customer['format_id'] = $address_format_id;
        $order->customer['email_address'] = $paypal_ec_payer_info['payer_email'];
        //TODO: Dig up customer's telephone number
        $order->customer['telephone'] = '';

        //For some reason, $order->billing gets erased between here and checkout_confirmation.php
        $order->billing['name'] = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
        $order->billing['company'] = $paypal_ec_payer_info['payer_business'];
        $order->billing['street_address'] = $paypal_ec_payer_info['ship_street_1'];
        $order->billing['suburb'] = $paypal_ec_payer_info['ship_street_2'];
        $order->billing['city'] = $paypal_ec_payer_info['ship_city'];
        $order->billing['postcode'] = $paypal_ec_payer_info['ship_postal_code'];
        $order->billing['state'] = $paypal_ec_payer_info['ship_state'];
        $order->billing['country'] = $paypal_ec_payer_info['ship_country_name'];
        $order->billing['format_id'] = $address_format_id;

        $order->delivery['name'] = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'];
        $order->delivery['company'] = $paypal_ec_payer_info['payer_business'];
        $order->delivery['street_address'] = $paypal_ec_payer_info['ship_street_1'];
        $order->delivery['suburb'] = $paypal_ec_payer_info['ship_street_2'];
        $order->delivery['city'] = $paypal_ec_payer_info['ship_city'];
        $order->delivery['postcode'] = $paypal_ec_payer_info['ship_postal_code'];
        $order->delivery['state'] = $paypal_ec_payer_info['ship_state'];
        $order->delivery['country'] = $paypal_ec_payer_info['ship_country_name'];
        $order->delivery['format_id'] = $address_format_id;


        if (!tep_session_is_registered('paypal_ec_temp')) tep_session_register('paypal_ec_temp');
        
        if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
          //They're logged in, so forward them straight to checkout_shipping.php
          $order->customer['id'] = $customer_id;
          
          if (!tep_session_is_registered('sendto')) tep_session_register('sendto'); 
          $_SESSION['sendto'] = $customer_default_address_id;
          $_SESSION['paypal_ec_temp'] = false;
          $this->away_with_you();
        } else {
          //They're not logged in.  Create an account if necessary, and then log them in.
          //First, see if they're an existing customer

          //If Paypal didn't send an email address, something went wrong
          if (trim($paypal_ec_payer_info['payer_email']) == '') $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE, true);
          $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_lastname, customers_paypal_payerid, customers_paypal_ec from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($paypal_ec_payer_info['payer_email']) . "'");
          $check_customer = tep_db_fetch_array($check_customer_query);
          if (tep_db_num_rows($check_customer_query) > 0) {
            $check_customer = tep_db_fetch_array($check_customer_query);
            $acct_exists = true;
            if ($check_customer['customers_paypal_ec'] == '1') {
              //Delete the existing temporary account
              $this->ec_delete_user($check_customer['customers_id']);
              $acct_exists = false;
            }
          }
          
          
          
          //Create an account
          if (!$acct_exists) {
            //Generate a random 8-char password
            $salt = "46z3haZzegmn676PA3rUw2vrkhcLEn2p1c6gf7vp2ny4u3qqfqBh5j6kDhuLmyv9xf";
            srand((double)microtime()*1000000); 
            $password = '';
            for ($x = 0; $x < 7; $x++) {
              $num = rand() % 33;
              $tmp = substr($salt, $num, 1);
              $password = $password . $tmp;
            }

            $sql_data_array = array('customers_firstname' => $paypal_ec_payer_info['payer_firstname'],
                                    'customers_lastname' => $paypal_ec_payer_info['payer_lastname'],
                                    'customers_email_address' => $paypal_ec_payer_info['payer_email'],
                                    'customers_telephone' => $paypal_ec_payer_info['ship_phone'],
                                    'customers_fax' => '',
                                    'customers_newsletter' => '0',
                                    'customers_password' => tep_encrypt_password($password),
                                    'customers_paypal_payerid' => $paypal_ec_payer_id);

            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
      
            $customer_id = tep_db_insert_id();
      
            $sql_data_array = array('customers_id' => $customer_id,
                                    'entry_firstname' => $paypal_ec_payer_info['payer_firstname'],
                                    'entry_lastname' => $paypal_ec_payer_info['payer_lastname'],
                                    'entry_street_address' => $paypal_ec_payer_info['ship_street_1'],
                                    'entry_suburb' => $paypal_ec_payer_info['ship_street_2'],
                                    'entry_city' => $paypal_ec_payer_info['ship_city'],
                                    'entry_zone_id' => $state_id,
                                    'entry_postcode' => $paypal_ec_payer_info['ship_postal_code'],
                                    'entry_country_id' => $country_id);
      
            tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
      
            $address_id = tep_db_insert_id();
      
            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");
      
            tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");
  
            
            
            if (MODULE_PAYMENT_PAYPAL_DP_NEW_ACCT_NOTIFY == 'Yes') {
              require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
              
              $email_text = sprintf(EMAIL_GREET_NONE, $paypal_ec_payer_info['payer_firstname']) . EMAIL_WELCOME . EMAIL_TEXT;
              $email_text .= EMAIL_EC_ACCOUNT_INFORMATION . "Username: " . $paypal_ec_payer_info['payer_email'] . "\nPassword: " . $password . "\n\n";
              $email_text .= EMAIL_CONTACT;
              
              tep_mail($paypal_ec_payer_info['payer_firstname'] . " " . $paypal_ec_payer_info['payer_lastname'], $paypal_ec_payer_info['payer_email'], EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
              
              $_SESSION['paypal_ec_temp'] = false;
            } else {
              //Make it a temporary account that'll be deleted once they've checked out
              tep_db_query("UPDATE " . TABLE_CUSTOMERS . " SET customers_paypal_ec = '1' WHERE customers_id = '" . (int)$customer_id . "'");
              
              $_SESSION['paypal_ec_temp'] = True;
            }
          } else {
            $_SESSION['paypal_ec_temp'] = false;
          }
          
          if (!tep_session_is_registered('sendto')) tep_session_register('sendto');
          $_SESSION['sendto'] = $address_id;
          $this->user_login($paypal_ec_payer_info['payer_email']);
        }
      }
    }
    
    function user_login($email_address) {
    global $order, $customer_id, $customer_default_address_id, $customer_first_name, $customer_country_id, $customer_zone_id;
      /*
                This allows the user to login with only a valid email (the email address sent back by PayPal)
                Their PayPal payerID is stored in the database, but I still don't know if that number changes.  If it doesn't, it could be used to
                help identify an existing customer who hasn't logged in.  Until I know for sure, the email address is enough
                */
                
      global $session_started, $language, $cart;
      if ($session_started == false) {
        tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
      }
    
      require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
    
      $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id, customers_paypal_payerid from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_customer = tep_db_fetch_array($check_customer_query);

      if (!tep_db_num_rows($check_customer_query)) {
        $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_LOGIN, true);
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

        $order->customer['id'] = $customer_id;

        tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

        $cart->restore_contents();
        
        $this->away_with_you();
      }
    }
    
    function ec_delete_user($cid) {
      global $customer_id, $customers_default_address_id, $customer_first_name, $customer_country_id, $customer_zone_id, $comments;
      tep_session_unregister('customer_id');
      tep_session_unregister('customer_default_address_id');
      tep_session_unregister('customer_first_name');
      tep_session_unregister('customer_country_id');
      tep_session_unregister('customer_zone_id');
      tep_session_unregister('comments');
      //$cart->reset();
      tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$cid . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$cid . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$cid . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$cid . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$cid . "'");
      tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$cid . "'");
    }

    function before_process() {
      global $HTTP_POST_VARS, $order, $paypal_ec_token, $paypal_ec_payer_id, $paypal_ec_payer_info;
      include(DIR_WS_CLASSES . 'cc_validation.php');

      $caller = $this->paypal_init();
      if (tep_session_is_registered('paypal_ec_token') && tep_session_is_registered('paypal_ec_payer_id') && tep_session_is_registered('paypal_ec_payer_info')) {
        //Do EC checkout

        $pdt =& Services_PayPal::getType('PaymentDetailsType');

        $at =& Services_PayPal::getType('AddressType');
        $at->setName($paypal_ec_payer_info['ship_name']);
        $at->setStreet1($paypal_ec_payer_info['ship_street_1']);
        $at->setStreet2($paypal_ec_payer_info['ship_street_2']);
        $at->setCityName($paypal_ec_payer_info['ship_city']);
        $at->setStateOrProvince($paypal_ec_payer_info['ship_state']);
        $at->setCountry($paypal_ec_payer_info['ship_country']);
        $at->setPostalCode($paypal_ec_payer_info['ship_postal_code']);
        $pdt->setShipToAddress($at);

        $order_total =& Services_PayPal::getType('BasicAmountType');
        $order_total->setval(number_format($order->info['total'], 2));
        $order_total->setattr('currencyID', $order->info['currency']);
        $pdt->setOrderTotal($order_total);

        $item_total =& Services_PayPal::getType('BasicAmountType');
        $item_total->setval(number_format($order->info['subtotal'], 2));
        $item_total->setattr('currencyID', $order->info['currency']);
        $pdt->setItemTotal($item_total);
        
        $ship_total =& Services_PayPal::getType('BasicAmountType');
        $ship_total->setval(number_format($order->info['shipping_cost'], 2));
        $ship_total->setattr('currencyID', $order->info['currency']);
        $pdt->setShippingTotal($ship_total);
        
        $tax_total =& Services_PayPal::getType('BasicAmountType');
        $tax_total->setval(number_format($order->info['tax'], 2));
        $tax_total->setattr('currencyID', $order->info['currency']);
        $pdt->setTaxTotal($tax_total);
        
        $details =& Services_PayPal::getType('DoExpressCheckoutPaymentRequestDetailsType');
        $details->setPaymentAction('Sale');
        $details->setToken($paypal_ec_token);
        $details->setPayerID($paypal_ec_payer_id);
        $details->setPaymentDetails($pdt);
    
        $ecprt =& Services_PayPal::getType('DoExpressCheckoutPaymentRequestType');
        $ecprt->setDoExpressCheckoutPaymentRequestDetails($details);
    
        $response = $caller->DoExpressCheckoutPayment($ecprt);

        if(Services_PayPal::isError($response)  || ($response->Ack != 'Success' && $response->Ack != 'SuccessWithWarning')) {
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR . $response->Errors->ShortMessage . '<br>' . $response->Errors->LongMessage . ' (' . $response->Errors->ErrorCode . ')', true);

          if ($this->enableDebugging == '1') {
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Error Dump', "In function: before_process() - Express Checkout\r\n\r\n" . var_dump($response), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          }
        } else {
          $details = $response->getDoExpressCheckoutPaymentResponseDetails();
          $payment_info = $details->getPaymentInfo();
          $this->payment_type = 'PayPal Express Checkout';
          $this->trans_id = $payment_info->getTransactionID();
          $this->payment_status = $payment_info->getPaymentStatus();
          $this->avs = 'N/A';
          $this->cvv2 = 'N/A';
          
          if ($this->payment_status == 'Pending') {
            $this->pending_reason = $payment_info->getPendingReason();
            $this->payment_status .= ' (' . $this->pending_reason . ')';
            $order->info['order_status'] = 1;
          }
        }
      } else {  // Do DP checkout
        $cc_type = $HTTP_POST_VARS['wpp_cc_type'];
        $cc_number = $HTTP_POST_VARS['wpp_cc_number'];
        $cc_checkcode = $HTTP_POST_VARS['wpp_cc_checkcode'];
        $cc_first_name = $HTTP_POST_VARS['wpp_payer_firstname'];
        $cc_last_name = $HTTP_POST_VARS['wpp_payer_lastname'];
        $cc_owner_ip = $_SERVER['REMOTE_ADDR'];
        $cc_expdate_month = $HTTP_POST_VARS['wpp_cc_expdate_month'];
        $cc_expdate_year = $HTTP_POST_VARS['wpp_cc_expdate_year'];
        if (strlen($cc_expdate_year) < 4) $cc_expdate_year = '20'.$cc_expdate_year;
        
        //Paypal only accepts two character state codes
        if (strlen($order->billing['state']) > 2) {
          $state_query = tep_db_query("SELECT zone_code FROM " . TABLE_ZONES . " WHERE zone_name = '".$order->billing['state']."'");
          if (tep_db_num_rows($state_query) > 0) {
            $state = tep_db_fetch_array($state_query);
            $order->billing['state'] = $state['zone_code'];
          } else {
            $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_STATE_ERROR);
          }
        }
  
        switch (MODULE_PAYMENT_PAYPAL_DP_CURRENCY) {
          case 'Always EUR':
            $wpp_currency = 'EUR';
            break;
          case 'Always USD':
            $wpp_currency = 'USD';
            break;
          case 'Either EUR or USD, else EUR':
            if ( ($currency == 'EUR') || ($currency == 'USD') ) {
              $wpp_currency = $currency;
            } else {
              $wpp_currency = 'EUR';
            }
            break;
          case 'Either EUR or USD, else USD':
            if ( ($currency == 'EUR') || ($currency == 'USD') ) {
              $wpp_currency = $currency;
            } else {
              $wpp_currency = 'USD';
            }
            break;
        }

        //If the cc type sent in the post var isn't any one of the accepted cards, send them back to the payment page
        //This error should never come up unless the visitor is  playing with the post vars
        if ($cc_type != 'Visa' && $cc_type != 'MasterCard' && $cc_type != 'Discover' && $cc_type != 'Amex') {
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_BAD_CARD, false, true);
        }
  
        //If they're still here, and awake, set some of the order object's variables
        $order->info['cc_type'] = $cc_type;
        $order->info['cc_number'] = substr($cc_number, 0, 4) . str_repeat('X', (strlen($cc_number) - 8)) . substr($cc_number, -4);
        $order->info['cc_owner'] = $cc_first_name . ' ' . $cc_last_name;
        $order->info['cc_expires'] = $cc_expdate_month . substr($cc_expdate_year, -2);
  
        //It's time to start a'chargin.  Initialize the paypal caller object
        $caller = $this->paypal_init();
  
        $ot =& Services_PayPal::getType('BasicAmountType');
        $ot->setattr('currencyID', $wpp_currency);
        $ot->setval(number_format($order->info['total'], 2));
  
        $pdt =& Services_PayPal::getType('PaymentDetailsType');
        $pdt->setOrderTotal($ot);
        
        $at =& Services_PayPal::getType('AddressType');
        $at->setStreet1($order->billing['street_address']);
        $at->setStreet2($order->billing['suburb']);
        $at->setCityName($order->billing['city']);
        $at->setStateOrProvince($order->billing['state']);
        $at->setCountry($order->billing['country']['iso_code_2']);
        $at->setPostalCode($order->billing['postcode']);
  
        $pnt =& Services_PayPal::getType('PersonNameType');
        $pnt->setFirstName($cc_first_name);
        $pnt->setLastName($cc_last_name);
  
        $pit =& Services_PayPal::getType('PayerInfoType');
        $pit->setPayerName($pnt);
        $pit->setAddress($at);
  
        $ccdt =& Services_PayPal::getType('CreditCardDetailsType');
        $ccdt->setCardOwner($pit);
        $ccdt->setCreditCardType($cc_type);
        $ccdt->setCreditCardNumber($cc_number);
        $ccdt->setExpMonth($cc_expdate_month);
        $ccdt->setExpYear($cc_expdate_year);
        $ccdt->setCVV2($cc_checkcode);
  
        $ddp_req =& Services_PayPal::getType('DoDirectPaymentRequestDetailsType');
        //Should the action be a variable? Uhmmm....I'm thinking no
        $ddp_req->setPaymentAction('Sale');
        $ddp_req->setPaymentDetails($pdt);
        $ddp_req->setCreditCard($ccdt);
        $ddp_req->setIPAddress($cc_owner_ip);
  
        $ddp_details =&Services_PayPal::getType('DoDirectPaymentRequestType');
        $ddp_details->setVersion('2.0');
        $ddp_details->setDoDirectPaymentRequestDetails($ddp_req);
        
        $final_req = $caller->DoDirectPayment($ddp_details);
        
        if ($final_req->Ack != 'Success' && $final_req->Ack != 'SuccessWithWarning') {
          $this->away_with_you(MODULE_PAYMENT_PAYPAL_DP_TEXT_DECLINED . $final_req->Errors->ShortMessage . '<br>' . $final_req->Errors->LongMessage . ' (' . $final_req->Errors->ErrorCode . ')', false, true);
          if ($this->enableDebugging == '1') {
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'PayPal Error Dump', "In function: before_process() - Direct Payment\r\n\r\n" . var_dump($final_req), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          }
        }
        $this->payment_type = 'PayPal Direct Payment';     
        $this->trans_id = $final_req->TransactionID;
        $this->payment_status = 'Completed';
        $ret_avs = $final_req->AVSCode;
        $ret_cvv2 = $final_req->CVV2Code;
        
        switch ($ret_avs) {
        case 'A':
          $ret_avs_msg = 'Address Address only (no ZIP)';
          break;
        case 'B':
          $ret_avs_msg = 'International “A” Address only (no ZIP)';
          break;
        case 'C':
          $ret_avs_msg = 'International “N” None';
          break;
        case 'D':
          $ret_avs_msg = 'International “X” Address and Postal Code';
          break;
        case 'E':
          $ret_avs_msg = 'Not allowed for MOTO (Internet/Phone)';
          break;
        case 'F':
          $ret_avs_msg = 'UK-specific “X” Address and Postal Code';
          break;
        case 'G':
          $ret_avs_msg = 'Global Unavailable Not applicable';
          break;
        case 'I':
          $ret_avs_msg = 'International Unavailable Not applicable';
          break;
        case 'N':
          $ret_avs_msg = 'No None';
          break;
        case 'P':
          $ret_avs_msg = 'Postal (International “Z”) Postal Code only (no Address)';
          break;
        case 'R':
          $ret_avs_msg = 'Retry Not applicable';
          break;
        case 'S':
          $ret_avs_msg = 'Service not Supported Not applicable';
          break;
        case 'U':
          $ret_avs_msg = 'Unavailable Not applicable';
          break;
        case 'W':
          $ret_avs_msg = 'Whole ZIP Nine-digit ZIP code (no Address)';
          break;
        case 'X':
          $ret_avs_msg = 'Exact match Address and nine-digit ZIP code';
          break;
        case 'Y':
          $ret_avs_msg = 'Yes Address and five-digit ZIP';
          break;
        case 'Z':
          $ret_avs_msg = 'ZIP Five-digit ZIP code (no Address)';
          break;
        default:
          $ret_avs_msg = 'Error';
        }

        switch ($ret_cvv2) {
        case 'M':
          $ret_cvv2_msg = 'Match CVV2';
          break;
        case 'N':
          $ret_cvv2_msg = 'No match None';
          break;
        case 'P':
          $ret_cvv2_msg = 'Not Processed Not applicable';
          break;
        case 'S':
          $ret_cvv2_msg = 'Service not Supported Not applicable';
          break;
        case 'U':
          $ret_cvv2_msg = 'Unavailable Not applicable';
          break;
        case 'X':
          $ret_cvv2_msg = 'No response Not applicable';
          break;
        default:
          $ret_cvv2_msg = 'Error';
          break;
        }

        $this->avs = $ret_avs_msg;
        $this->cvv2 = $ret_cvv2_msg;
      }
    }

    function after_process() {
      global $insert_id;

      tep_db_query("update ".TABLE_ORDERS_STATUS_HISTORY. " set comments = concat(if(trim(comments) != '', concat(trim(comments), '\n'), ''), 'Transaction ID: ".$this->trans_id."\nPayment Type: ".$this->payment_type."\nPayment Status: ".$this->payment_status.($this->avs != 'N/A' ? "\nAVS Code: ".$this->avs."\nCVV2 Code: ".$this->cvv2 : '')."') where orders_id = ".$insert_id);
    }

    function get_error() {
      global $HTTP_GET_VARS, $language;
      require(DIR_WS_LANGUAGES . $language . '/modules/payment/' . FILENAME_PAYPAL_WPP);

      $error = array('title' => MODULE_PAYMENT_PAYPAL_DP_ERROR_HEADING,
                     'error' => ((isset($HTTP_GET_VARS['error'])) ? stripslashes(urldecode($HTTP_GET_VARS['error'])) : MODULE_PAYMENT_PAYPAL_DP_TEXT_CARD_ERROR));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_DP_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_PAYPAL_DP_STATUS', 'True', 'Do you want to enable this payment module?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Live or Sandbox API', 'MODULE_PAYMENT_PAYPAL_DP_SERVER', 'live', 'Live: Live transactions<br>Sandbox: For developers and testing', '6', '1', 'tep_cfg_select_option(array(\'live\', \'sandbox\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Certificate', 'MODULE_PAYMENT_PAYPAL_DP_CERT_PATH', '" . DIR_FS_CATALOG . DIR_WS_INCLUDES . "modules/payment/wpp_cert/cert_key_pem.txt', 'Type in the filename of your API certificate<br>(this must be an ABSOLUTE path)', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Username', 'MODULE_PAYMENT_PAYPAL_DP_API_USERNAME', '', 'Your Paypal WPP API Username', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('API Password', 'MODULE_PAYMENT_PAYPAL_DP_API_PASSWORD', '', 'Your Paypal WPP API Password', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Button Placement', 'MODULE_PAYMENT_PAYPAL_DP_BUTTON_PAYMENT_PAGE', 'No', 'Do you want to display the Express Checkout button on the payment page?', '6', '5',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Verified Accounts Only', 'MODULE_PAYMENT_PAYPAL_DP_REQ_VERIFIED', 'Yes', 'Do you want to limit Express Checkout payments to only verified PayPal account owners? (HIGHLY RECOMMENDED: Yes)', '6', '6',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Confirmed Address', 'MODULE_PAYMENT_PAYPAL_DP_CONFIRMED', 'Yes', 'Do you want to require that your customers\' shipping address with PayPal is confirmed? (HIGHLY RECOMMENDED: Yes)', '6', '7',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Display Payment Page', 'MODULE_PAYMENT_PAYPAL_DP_DISPLAY_PAYMENT_PAGE', 'No', 'If someone\'s checking out with Express Checkout, do you want to display the checkout_payment.php page?  The payment options will be hidden.  (Yes, if you have CCGV installed)', '6', '8',  'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Express Checkout: Automatic Account Creation', 'MODULE_PAYMENT_PAYPAL_DP_NEW_ACCT_NOTIFY', 'Yes', 'If a visitor is not an existing customer, an account is created for them.  Would you like make it a permanent account and send them an email containing their login information?', '6', '9', 'tep_cfg_select_option(array(\'Yes\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pear Modules', 'MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH', '".(is_dir(DIR_FS_CATALOG . "pear") ? DIR_FS_CATALOG . 'pear/' : '')."', 'If you installed the included pear modules, where are they stored?  Should be:<br>" . DIR_FS_CATALOG . "pear/<br>Leaving this blank will use the server\'s default include path.', '6', '10', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Currency', 'MODULE_PAYMENT_PAYPAL_DP_CURRENCY', 'Always USD', 'The currency to use for credit card transactions.  (Currently, PayPal\'s API only supports USD)', '6', '11', 'tep_cfg_select_option(array(\'Always USD\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_DP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '12', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_DP_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '13', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYPAL_DP_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '14', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PAYPAL_DP_STATUS', 'MODULE_PAYMENT_PAYPAL_DP_SERVER', 'MODULE_PAYMENT_PAYPAL_DP_CERT_PATH', 'MODULE_PAYMENT_PAYPAL_DP_API_USERNAME', 'MODULE_PAYMENT_PAYPAL_DP_API_PASSWORD', 'MODULE_PAYMENT_PAYPAL_DP_BUTTON_PAYMENT_PAGE', 'MODULE_PAYMENT_PAYPAL_DP_REQ_VERIFIED', 'MODULE_PAYMENT_PAYPAL_DP_CONFIRMED', 'MODULE_PAYMENT_PAYPAL_DP_DISPLAY_PAYMENT_PAGE', 'MODULE_PAYMENT_PAYPAL_DP_DISPLAY_PAYMENT_PAGE', 'MODULE_PAYMENT_PAYPAL_DP_NEW_ACCT_NOTIFY', 'MODULE_PAYMENT_PAYPAL_DP_PEAR_PATH', 'MODULE_PAYMENT_PAYPAL_DP_CURRENCY', 'MODULE_PAYMENT_PAYPAL_DP_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_DP_ZONE', 'MODULE_PAYMENT_PAYPAL_DP_ORDER_STATUS_ID');
    }
}
