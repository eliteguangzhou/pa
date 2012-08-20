<?php
/*
  $Id: checkout_process.php 1750 2007-12-21 05:20:28Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  include('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
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

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping') || !tep_session_is_registered('sendto')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if ( (tep_not_null(MODULE_PAYMENT_INSTALLED)) && (!tep_session_is_registered('payment')) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
 }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }


  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

// load selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment($payment);

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;
  
//Ajout clement : pays plus livrable
  if (!country_shippable($order->delivery['country']['id'], $order->delivery['postcode'])) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  //Ajout pour l'achat de cartes membres
  if ($cart->card_only())
    $order->info['order_status'] = 6;

// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (!$cart->is_card($order->products[$i]['id']) && tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

  $payment_modules->update_status();

  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }


  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;

  $order_totals = $order_total_modules->process();

//Total de produits pour SHopzilla.com

  $total_products = 0;
  $products_cost = 0;
  $total_products_price = 0;
  foreach ($order->products as $p) {
    if (!$cart->is_card($p['id'])) 
        $products_cost += $p['final_price'] * $p['qty'];
    if ($p['final_price'] > 0) {
        $total_products += $p['qty'];
		$total_products_price += round2($p['qty'] * $p['final_price'] / 1.196 * $currencies->currencies[$currency]['value']);
    }
  }
  tep_session_register('total_products');
  tep_session_register('total_products_price');
  
  $discount = -($easy_discount->total() + $nb_products_discount->discount);

  if ($discount < 0) {
   if (!empty($easy_discount->discounts))
        foreach ($easy_discount->discounts as $infos) {
            $order->products[] = array(
                'id' => 0,
                'model' => 0,
                'name' => 'Code '.substr($infos["description"], strrpos($infos["description"], '(') + 1, -1),
                'price' => -$infos["amount"],
                'final_price' => -$infos["amount"],
                'tax' => 0,
                'qty' => 1,
                'weight' => 0
            );
        }

    if (!empty($nb_products_discount->discount)) {
        $order->products[] = array(
            'id' => 0,
            'model' => 0,
            'name' => $nb_products_discount->nb . ' items bought',
            'price' => -$nb_products_discount->discount,
            'final_price' => -$nb_products_discount->discount,
            'tax' => 0,
            'qty' => 1,
            'weight' => 0
        );
    }

    foreach($order_totals as $index => $order_total) {
        if ($order_total["code"] == "ot_subtotal") {
            $order_totals[$index]["value"] += $discount;
            if ($order_totals[$index]["value"] <= 0)
                $order_totals[$index]["value"] = 0;
            $order_totals[$index]["text"] = $currencies->display_price($order_totals[$index]["value"]);
        }
        if ($order_total["code"] == "ot_total") {
            $order_totals[$index]["value"] += $discount;
            if ($order_totals[$index]["value"] <= 0)
                $order_totals[$index]["value"] = 0;
            $order_totals[$index]["text"] = '<b>'.$currencies->display_price($order_totals[$index]["value"]).'</b>';
        }
    }
  }
  
  if (is_promo_date()) {
    $promo_price = -round2($products_cost*get_promo('percent'));
    $order->products[] = array(
        'id' => 0,
        'model' => 0,
        'name' => SUB_TITLE_SUB_SPECIAL_DISCOUNT . ' ' . SPECIAL_DISCOUNT_PAYPAL,
        'price' => $promo_price,
        'final_price' => $promo_price,
        'tax' => 0,
        'qty' => 1,
        'weight' => 0
    );

    foreach($order_totals as $index => $order_total) {
        if ($order_total["code"] == "ot_subtotal") {
            $order_totals[$index]["value"] += $promo_price;
            if ($order_totals[$index]["value"] <= 0)
                $order_totals[$index]["value"] = 0;
            $order_totals[$index]["text"] = $currencies->display_price($order_totals[$index]["value"]);
        }
        if ($order_total["code"] == "ot_total") {
            $order_totals[$index]["value"] += $promo_price;
            if ($order_totals[$index]["value"] <= 0)
                $order_totals[$index]["value"] = 0;
            $order_totals[$index]["text"] = '<b>'.$currencies->display_price($order_totals[$index]["value"]).'</b>';
        }
    }
  }

  //NetAffiliation
  foreach($order_totals as $index => $order_total)
    if ($order_total["code"] == "ot_subtotal") {
        $netaffiliation = round($order_totals[$index]["value"]*$currencies->currencies[$currency]['value'] / 1.196 * 100) / 100;
        tep_session_register('netaffiliation');
    }
    //RSI Shopping & Shopzilla
    elseif ($order_total["code"] == "ot_total") {
        $rsi = $order_totals[$index]["value"];
        tep_session_register('rsi');
    }


  // load the before_process function from the payment modules
  //Ajout clement : Si la somme a paye est plus grande que 0 (en comptant les reductions) on passe par Paypal, sinon directement a l'enregistrement de la commande en base
  $transaction_id = 0;
  if($rsi > 0)
    $transaction_id = $payment_modules->before_process();

  $sql_data_array = array('customers_id' => $customer_id,
                          'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                          'customers_company' => $order->customer['company'],
                          'customers_street_address' => $order->customer['street_address'],
                          'customers_suburb' => $order->customer['suburb'],
                          'customers_city' => $order->customer['city'],
                          'customers_postcode' => $order->customer['postcode'],
                          'customers_state' => $order->customer['state'],
                          'customers_country' => $order->customer['country']['title'],
                          'customers_telephone' => $order->customer['telephone'],
                          'customers_email_address' => $order->customer['email_address'],
                          'customers_address_format_id' => $order->customer['format_id'],
                          'delivery_name' => trim($order->delivery['firstname'] . ' ' . $order->delivery['lastname']),
                          'delivery_company' => $order->delivery['company'],
                          'delivery_street_address' => $order->delivery['street_address'],
                          'delivery_suburb' => $order->delivery['suburb'],
                          'delivery_digicode' => $order->delivery['digicode'],
                          'delivery_city' => $order->delivery['city'],
                          'delivery_postcode' => $order->delivery['postcode'],
                          'delivery_state' => $order->delivery['state'],
                          'delivery_country' => $order->delivery['country']['title'],
                          'delivery_address_format_id' => $order->delivery['format_id'],
                          'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'],
                          'billing_company' => $order->billing['company'],
                          'billing_street_address' => $order->billing['street_address'],
                          'billing_suburb' => $order->billing['suburb'],
                          'billing_city' => $order->billing['city'],
                          'billing_postcode' => $order->billing['postcode'],
                          'billing_state' => $order->billing['state'],
                          'billing_country' => $order->billing['country']['title'],
                          'billing_address_format_id' => $order->billing['format_id'],
                          'payment_method' => $order->info['payment_method'],
                          'cc_type' => $order->info['cc_type'],
                          'cc_owner' => $order->info['cc_owner'],
                          'cc_number' => $order->info['cc_number'],
                          'cc_expires' => $order->info['cc_expires'],
                          'date_purchased' => 'now()',
                          'orders_status' => $order->info['order_status'],
                          'currency' => $order->info['currency'],
                          'currency_value' => $order->info['currency_value'],
                          'transaction_id' => $transaction_id,
                          'is_member' => $is_member || $cart->has_card() ? '1' : '0',
                          'site' => htmlentities($_SERVER['SERVER_NAME']));
  tep_db_perform(TABLE_ORDERS, $sql_data_array);
  $insert_id = tep_db_insert_id();
  tep_session_register('insert_id');
  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $sql_data_array = array('orders_id' => $insert_id,
                            'title' => $order_totals[$i]['title'],
                            'text' => $order_totals[$i]['text'],
                            'value' => $order_totals[$i]['value'],
                            'class' => $order_totals[$i]['code'],
                            'sort_order' => $order_totals[$i]['sort_order']);
    tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
    if ($ec_auto) {
      // steal order value for new coupon discount calculation later
      if ($order_totals[$i]['code'] == 'ot_total') $coupon_order_value = $order_totals[$i]['value'];
    }
  }

  $customer_notification = (SEND_EMAILS == 'true') ? '1' : '0';
  $sql_data_array = array('orders_id' => $insert_id,
                          'orders_status_id' => $order->info['order_status'],
                          'date_added' => 'now()',
                          'customer_notified' => $customer_notification,
                          'comments' => $order->info['comments']);
  tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

// initialized for the email confirmation
  $products_ordered = '';
  $subtotal = 0;
  $total_tax = 0;

  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
  //Ajout gestion carte membre
    if ($cart->is_card($order->products[$i]['id'])) {
        $card_query = tep_db_query("REPLACE INTO " . TABLE_MEMBERS . " SET
            customers_id = ".$customer_id.",
            card_type = '".$order->products[$i]['id']."',
            expiration_date = ADDDATE(NOW(), INTERVAL ".$order->products[$i]['duration']." MONTH)
            ");
        $is_member = true;
        tep_session_register('is_member');
        $duration = $order->products[$i]['duration'];
    }
// Stock Update - Joao Correia]
    elseif (STOCK_LIMITED == 'true') {
      if (DOWNLOAD_ENABLED == 'true') {
        $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename
                            FROM " . TABLE_PRODUCTS . " p
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                             ON p.products_id=pa.products_id
                            LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                             ON pa.products_attributes_id=pad.products_attributes_id
                            WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
// Will work with only one option for downloadable products
// otherwise, we have to build the query dynamically with a loop
        $products_attributes = $order->products[$i]['attributes'];
        if (is_array($products_attributes)) {
          $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
        }
        $stock_query = tep_db_query($stock_query_raw);
      } else {
        $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
      }
      if (tep_db_num_rows($stock_query) > 0) {
        $stock_values = tep_db_fetch_array($stock_query);
// do not decrement quantities if products_attributes_filename exists
        if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
          $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
        } else {
          $stock_left = $stock_values['products_quantity'];
        }
        tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
        if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
          tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
        }
      }
    }

// Update products_ordered (for bestsellers list)
    if ($order->products[$i]['id'] > 0)
        tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");

    $sql_data_array = array('orders_id' => $insert_id,
                            'products_id' => tep_get_prid($order->products[$i]['id']),
                            'products_model' => $order->products[$i]['model'],
                            'products_name' => $order->products[$i]['name'],
                            'products_price' => $order->products[$i]['price'],
                            'final_price' => $order->products[$i]['final_price'],
                            'products_tax' => $order->products[$i]['tax'],
                            'products_quantity' => $order->products[$i]['qty'],
                            'buy_price' => $order->products[$i]['buy_price']);
    tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);
    $order_products_id = tep_db_insert_id();

//------insert customer choosen option to order--------
    $attributes_exist = '0';
    $products_ordered_attributes = '';
    if (isset($order->products[$i]['attributes'])) {
      $attributes_exist = '1';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        if (DOWNLOAD_ENABLED == 'true') {
          $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename
                               from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                               left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                on pa.products_attributes_id=pad.products_attributes_id
                               where pa.products_id = '" . $order->products[$i]['id'] . "'
                                and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "'
                                and pa.options_id = popt.products_options_id
                                and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "'
                                and pa.options_values_id = poval.products_options_values_id
                                and popt.language_id = '" . $languages_id . "'
                                and poval.language_id = '" . $languages_id . "'";
          $attributes = tep_db_query($attributes_query);
        } else {
          $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
        }
        $attributes_values = tep_db_fetch_array($attributes);

        $sql_data_array = array('orders_id' => $insert_id,
                                'orders_products_id' => $order_products_id,
                                'products_options' => $attributes_values['products_options_name'],
                                'products_options_values' => $attributes_values['products_options_values_name'],
                                'options_values_price' => $attributes_values['options_values_price'],
                                'price_prefix' => $attributes_values['price_prefix']);
        tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

        if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
          $sql_data_array = array('orders_id' => $insert_id,
                                  'orders_products_id' => $order_products_id,
                                  'orders_products_filename' => $attributes_values['products_attributes_filename'],
                                  'download_maxdays' => $attributes_values['products_attributes_maxdays'],
                                  'download_count' => $attributes_values['products_attributes_maxcount']);
          tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
        }
        $products_ordered_attributes .= "\n\t" . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'];
      }
    }
//------insert customer choosen option eof ----
    $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
    $total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
    $total_cost += $total_products_price;

    $desc = '';
    if ($order->products[$i]['id'] > 0)
          $desc = tep_db_fetch_array(tep_db_query("select products_description
                               from " . TABLE_PRODUCTS_DESCRIPTION."
                               where products_id = '" . $order->products[$i]['id'] . "'
                                and language_id = '" . $languages_id . "'"));

    $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . (!empty($desc) ? ' - ' . $desc['products_description'] : '').(!empty($order->products[$i]['model']) ? ' (' . $order->products[$i]['model'] . ')':'').' = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
  }

// lets start with the email confirmation
  $email_order = STORE_NAME . "\n" .
                 EMAIL_SEPARATOR . "\n" .
                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
                 EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
  if ($order->info['comments']) {
    $email_order .= tep_db_output($order->info['comments']) . "\n\n";
  }
  $email_order .= EMAIL_TEXT_PRODUCTS . "\n" .
                  EMAIL_SEPARATOR . "\n" .
                  $products_ordered .
                  EMAIL_SEPARATOR . "\n";

  for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
    $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
  }

  if ($order->content_type != 'virtual') {
    $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" .
                    EMAIL_SEPARATOR . "\n" .
                    tep_address_label($customer_id, $sendto, 0, '', "\n") . "\n";
  }

  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                  EMAIL_SEPARATOR . "\n" .
                  tep_address_label($customer_id, $billto, 0, '', "\n") . "\n\n";
  if (is_object($$payment)) {
    $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" .
                    EMAIL_SEPARATOR . "\n";
    $payment_class = $$payment;
    $email_order .= $order->info['payment_method'] . "\n\n";
    if ($payment_class->email_footer) {
      $email_order .= $payment_class->email_footer . "\n\n";
    }
  }
// set the current coupon code to used if it was used
if (tep_session_is_registered('couponcode')) {
    $coupons_list = array();
    foreach ($couponcode as $coupon)
        tep_db_query("update " . TABLE_COUPONS . " set used = ".($coupon['generated_by'] == 'avoir' || !empty($coupon['email']) && DESACTIVATE_SPONSORSHIP_CODE || empty($coupon['email']) && DESACTIVATE_ANONYM_CODE ? 1 : 0).", used_date = NOW(), orders_id_used = ".$insert_id." where code = '".$coupon['code']."'");
}

//Si parrainage, creation des coupons de reduction pour le parrain
if (SPONSORSHIP_ACTIVATE) {
    $infos = $sponsorship->get_infos($customer_email_address);
    if ($infos !== false) {

        $var = explode(';', SPONSORSHIP_DISCOUNT_GODFATHER);
        $discounts = array();
        foreach ($var as $index => $discount) {
            $temp = explode(':', $discount);
            $discounts[$temp[0]] = $temp[1];
        }

        foreach ($discounts as $rank => $amount) {
			$amount /= $currencies->currencies["EUR"]['value']; 
            if (!empty($infos['gf_email'.$rank])) {
                $code = gen_coupon_code(SPONSORSHIP_CODE_LENGTH);
                $sponsorship->generate_discount($code, $amount, $infos['gf_email'.$rank], date("Y-m-d H:i:s", strtotime("+".SPONSORSHIP_GODCHILD_EXPIRATION." month")), $insert_id);
                tep_mail(
                    '',
                    $infos['gf_email'.$rank],
                    SPONSORSHIP_EMAIL_SUBJECT,
                    nl2br(sprintf(SPONSORSHIP_EMAIL_TEXT, $code, $currencies->display_price($amount), SPONSORSHIP_GODFATHER_EXPIRATION, constant('STR_GODCHILD_'.$rank), ucfirst($customers_first_name) . ' ' . ucfirst($customers_last_name))),
                    STORE_NAME,
                    STORE_OWNER_EMAIL_ADDRESS
                );
            }
        }
    }
}

  tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

  if ($cart->has_card()) {
      $card_order = sprintf(EMAIL_MEMBER, $order->customer['firstname'] . ' ' . $order->customer['lastname'], date("d/m/Y", strtotime('+'.$duration.' month')));

      tep_mail($order->customer['firstname'] . ' ' . $order->customer['lastname'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT_MEMBER, $card_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }
// send emails to other people
  if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
    tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT .' '.$insert_id, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

  //Send the discount mail
  if (ACTIVATE_DISCOUNT && ACTIVATE_FRIEND_DISCOUNT) {
      $fullname = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
	  $max_friend_discount = MAX_FRIEND_DISCOUNT / $currencies->currencies["EUR"]['value'];
      tep_mail($fullname, $order->customer['email_address'], sprintf(EMAIL_TEXT_DISCOUNT_SUBJECT, $currencies->display_price($max_friend_discount)), nl2br(sprintf(EMAIL_FRIEND_DISCOUNT, $fullname, $currencies->display_price($max_friend_discount), $insert_id, $insert_id)), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }

  //Creation invoice
  //If total of order < 0, client didn't use paypal so we use the order_id as the invoice number, otherwise the paypal receipt id
  if (CREATE_INVOICE) {
      require_once(DIR_WS_CLASSES . 'fpdf16/fpdf.php');
      create_invoice($rsi > 0 ? $transaction_id : $insert_id, $order, $insert_id);
  }

// load the after_process function from the payment modules
  $payment_modules->after_process();
  $newsletter_pr->save_newsletter_order($insert_id);

  $cart->reset(true);
  tep_session_unregister('couponcode');
  tep_session_unregister('easy_discount');

// unregister session variables used during checkout
  tep_session_unregister('sendto');
  tep_session_unregister('billto');
  tep_session_unregister('shipping');
  tep_session_unregister('payment');
  tep_session_unregister('comments');

  $order_valid = true;
  tep_session_register('order_valid');

  tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
