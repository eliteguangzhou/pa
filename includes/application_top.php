<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// start the timer for the page parse time log

  define('PAGE_PARSE_START_TIME', microtime());

  ini_set('date.timezone', 'Asia/Pyongyang');
//  error_reporting(E_ALL);
//set the level of error reporting
//  ini_set('display_errors', true);
//  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//   error_reporting(1);
// check support for register_globals
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }
  
// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');

  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// define the project version
  define('PROJECT_VERSION', 'osCommerce Online Merchant v2.2 RC1 W3C Valid FR');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// set the type of request (secure or not)
  $request_type = (getenv('HTTPS') == 'on') ? 'SSL' : 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $HTTP_SERVER_VARS['PHP_SELF'];

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Connexion impossible ?la Base de Donn�es!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  $config_flag_in = array('Oui', 'Non');
  $config_flag_out = array('true', 'false');

  $check_server = 'fr';
  $paypal_lang = 'fr_FR';
  $google_account = 'UA-20842438-1';
  if (preg_match("/fragrancelover/", $_SERVER['SERVER_NAME'])) {
    //$check_server = 'en';
//	$google_account = 'UA-29015123-1';
echo "website offline";
die();
}
  else if (preg_match("/profumilovers/", $_SERVER['SERVER_NAME'])) {
    $check_server = 'it';
	$google_account = 'UA-29025614-1';
  }
  else if (preg_match("/perfumeslovers/", $_SERVER['SERVER_NAME'])) {
    $check_server = 'es';
	$google_account = 'UA-28971072-1';
  }
    
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    $configuration['cfgValue'] = str_replace($config_flag_in, $config_flag_out, $configuration['cfgValue']);
    switch ($check_server) {
		case 'en' :
			$paypal_lang = 'en_US';
			switch ($configuration['cfgKey']) {
				case 'STORE_NAME' : $configuration['cfgValue'] = 'Fragrancelover.com';break;
				case 'STORE_OWNER' : $configuration['cfgValue'] = 'Fragrancelover';break;
				case 'STORE_OWNER_EMAIL_ADDRESS' : $configuration['cfgValue'] = 'contact@fragrancelover.com';break;
				case 'EMAIL_FROM' : $configuration['cfgValue'] = '"contact@fragrancelover.com"';break;
				case 'SEND_EXTRA_ORDER_EMAILS_TO' : $configuration['cfgValue'] = 'contact@fragrancelover.com';break;
				case 'STORE_NAME_ADDRESS' : $configuration['cfgValue'] = 'Fragrancelover.com, New York, Paris, Hong Kong, contact@fragrancelover.com';break;
				case 'ACTIVATE_DISCOUNT' : $configuration['cfgValue'] = 0;break;
				case 'ENABLE_GIFT' : $configuration['cfgValue'] = 0;break;
			}
			break;
		case 'es' :
			$paypal_lang = 'es_ES';
			switch ($configuration['cfgKey']) {
				case 'STORE_NAME' : $configuration['cfgValue'] = 'Perfumeslovers.com';break;
				case 'STORE_OWNER' : $configuration['cfgValue'] = 'Perfumeslovers';break;
				case 'STORE_OWNER_EMAIL_ADDRESS' : $configuration['cfgValue'] = 'contact@perfumeslovers.com';break;
				case 'EMAIL_FROM' : $configuration['cfgValue'] = '"contact@perfumeslovers.com"';break;
				case 'SEND_EXTRA_ORDER_EMAILS_TO' : $configuration['cfgValue'] = 'contact@perfumeslovers.com';break;
				case 'STORE_NAME_ADDRESS' : $configuration['cfgValue'] = 'Perfumeslovers.com, New York, Paris, Hong Kong, contact@perfumeslovers.com';break;
			}
			break;
		case 'it' :
			$paypal_lang = 'it_IT';
			switch ($configuration['cfgKey']) {
				case 'STORE_NAME' : $configuration['cfgValue'] = 'Profumilovers.com';break;
				case 'STORE_OWNER' : $configuration['cfgValue'] = 'Profumilovers';break;
				case 'STORE_OWNER_EMAIL_ADDRESS' : $configuration['cfgValue'] = 'contatto@profumilovers.com';break;
				case 'EMAIL_FROM' : $configuration['cfgValue'] = '"contatto@profumilovers.com"';break;
				case 'SEND_EXTRA_ORDER_EMAILS_TO' : $configuration['cfgValue'] = 'contatto@profumilovers.com';break;
				case 'STORE_NAME_ADDRESS' : $configuration['cfgValue'] = 'Profumilovers.com, New York, Paris, Hong Kong, contatto@profumilovers.com';break;
			}
			break;
		default :					
		  $currency = 'EUR';
		  $languages_id = 5;
		  break;
	}
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }
  
// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

// set the HTTP GET parameters manually if search_engine_friendly_urls is enabled
  if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') {
    if (strlen(getenv('PATH_INFO')) > 1) {
      $GET_array = array();
      $PHP_SELF = str_replace(getenv('PATH_INFO'), '', $PHP_SELF);
      $vars = explode('/', substr(getenv('PATH_INFO'), 1));
      for ($i=0, $n=sizeof($vars); $i<$n; $i++) {
        if (strpos($vars[$i], '[]')) {
          $GET_array[substr($vars[$i], 0, -2)][] = $vars[$i+1];
        } else {
          $HTTP_GET_VARS[$vars[$i]] = $vars[$i+1];
        }
        $i++;
      }

      if (sizeof($GET_array) > 0) {
        while (list($key, $value) = each($GET_array)) {
          $HTTP_GET_VARS[$key] = $value;
        }
      }
    }
  }

  $blocked_countries = array(73, 74);
  $blocked_postcode = array(97, 98);
// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
  if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include easy discount products class
  require(DIR_WS_CLASSES . 'easy_discount.php');

// include nb_products_discount products class
  require(DIR_WS_CLASSES . 'nb_products_discount.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// check if sessions are supported, otherwise use the php3 compatible session class
  if (!function_exists('session_start')) {
    define('PHP_SESSION_NAME', 'osCsid');
    define('PHP_SESSION_PATH', $cookie_path);
    define('PHP_SESSION_DOMAIN', $cookie_domain);
    define('PHP_SESSION_SAVE_PATH', SESSION_WRITE_DIRECTORY);

    include(DIR_WS_CLASSES . 'sessions.php');
  }

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCsid');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
  }

// set the session ID if it exists
   if (isset($HTTP_POST_VARS[tep_session_name()])) {
     tep_session_id($HTTP_POST_VARS[tep_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($HTTP_GET_VARS[tep_session_name()]) ) {
     tep_session_id($HTTP_GET_VARS[tep_session_name()]);
   }

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'true') {
    tep_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain);

    if (isset($HTTP_COOKIE_VARS['cookie_test'])) {
      tep_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'true') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (tep_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      tep_session_start();
      $session_started = true;
    }
  } else {
    tep_session_start();
    $session_started = true;
  }

  if ( ($session_started == true) && (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }

// set SID once, even if empty
  $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'true') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
      $SESSION_SSL_ID = $ssl_session_id;
      tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }

// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'true') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
      $SESSION_USER_AGENT = $http_user_agent;
      tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'true') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
      $SESSION_IP_ADDRESS = $ip_address;
      tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// create the shopping cart & fix the cart if necesary
  if (tep_session_is_registered('cart') && is_object($cart)) {
    if (PHP_VERSION < 4) {
      $broken_cart = $cart;
      $cart = new shoppingCart;
      $cart->unserialize($broken_cart);
    }
  } else {
    tep_session_register('cart');
    $cart = new shoppingCart;
  }

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

if (!tep_session_is_registered('easy_discount')) {
  $easy_discount = new easy_discount();
  tep_session_register('easy_discount');
}

$nb_products_discount = new nb_products_discount();

// include the mail classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');
  
// set the language
  if (!tep_session_is_registered('language')) {
        
    if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();
    $lng->set_language($check_server);
    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }
if ($languages_id == 0){
  $languages_id = 5;
}
// currency
  if (!tep_session_is_registered('currency') || isset($HTTP_GET_VARS['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($HTTP_GET_VARS['currency']) && $currencies->is_set($HTTP_GET_VARS['currency'])) {
      $currency = $HTTP_GET_VARS['currency']; 
	} elseif ($check_server == 'en') {
      $currency = 'USD';
    } else {
      $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }
  require_once(DIR_WS_CLASSES . '/cards.php');
  $cards = new cards;
  
  //Ajout clement : images dans les repertoires de langues
  define('DIR_WS_IMAGES', DIR_WS_LANGUAGES.$language . '/images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  
  if (!isset($language)){
    $language = 'french';
  }
  //include the language translations
  require(DIR_WS_LANGUAGES . $language . '.php');
  
// navigation history
  if (tep_session_is_registered('navigation')) {
    if (PHP_VERSION < 4) {
      $broken_navigation = $navigation;
      $navigation = new navigationHistory;
      $navigation->unserialize($broken_navigation);
    }
  } else {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  
  if(empty($navigation))
    $navigation = new navigationHistory;
  
  $navigation->add_current_page();

// Shopping cart actions
  if (isset($HTTP_GET_VARS['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }

    if (DISPLAY_CART == 'true') {
      $goto =  FILENAME_SHOPPING_CART;
      $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($PHP_SELF);
      if ($HTTP_GET_VARS['action'] == 'buy_now') {
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($HTTP_GET_VARS['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : if (empty($_POST['coupon_code'])) {
                                  for ($i=0, $n=sizeof($HTTP_POST_VARS['products_id']); $i<$n; $i++) {
                                    if (in_array($HTTP_POST_VARS['products_id'][$i], (isset($HTTP_POST_VARS['cart_delete']) && is_array($HTTP_POST_VARS['cart_delete']) ? $HTTP_POST_VARS['cart_delete'] : array()))) {
                                      $cart->remove($HTTP_POST_VARS['products_id'][$i]);
                                    } else {
                                      if (PHP_VERSION < 4) {
                                        // if PHP3, make correction for lack of multidimensional array.
                                        reset($HTTP_POST_VARS);
                                        while (list($key, $value) = each($HTTP_POST_VARS)) {
                                          if (is_array($value)) {
                                            while (list($key2, $value2) = each($value)) {
                                              if (ereg ("(.*)\]\[(.*)", $key2, $var)) {
                                                $id2[$var[1]][$var[2]] = $value2;
                                              }
                                            }
                                          }
                                        }
                                        $attributes = ($id2[$HTTP_POST_VARS['products_id'][$i]]) ? $id2[$HTTP_POST_VARS['products_id'][$i]] : '';
                                      } else {
                                        $attributes = isset ($HTTP_POST_VARS['id']) && ($HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]]) ? $HTTP_POST_VARS['id'][$HTTP_POST_VARS['products_id'][$i]] : '';
                                      }
                                      $error_add_product = $cart->add_cart($HTTP_POST_VARS['products_id'][$i], $HTTP_POST_VARS['cart_quantity'][$i], $attributes, false);
                                      tep_session_register('error_add_product');
                                    }
                                  }
                                  tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              }
                              break;
      // customer adds a product from the products page
      case 'add_product' :    if (isset($HTTP_POST_VARS['price_type']) && $HTTP_POST_VARS['price_type'] == 'member' && (!isset($is_member) || !$is_member) && !$cart->has_card())
							    $cart->add_card('card3');
							  if (isset($HTTP_POST_VARS['products_id']) && is_numeric($HTTP_POST_VARS['products_id'])) {
                                $error_add_product = $cart->add_cart($HTTP_POST_VARS['products_id'], $cart->get_quantity(tep_get_uprid($HTTP_POST_VARS['products_id'], isset($HTTP_POST_VARS['id']) ? $HTTP_POST_VARS['id'] : array()))+1, isset($HTTP_POST_VARS['id']) ? $HTTP_POST_VARS['id'] : array());
                                tep_session_register('error_add_product');
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      // performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($HTTP_GET_VARS['products_id'])) {
                                if (tep_has_product_attributes($HTTP_GET_VARS['products_id'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['products_id']));
                                } else {
                                  $error_add_product = $cart->add_cart($HTTP_GET_VARS['products_id'], $cart->get_quantity($HTTP_GET_VARS['products_id'])+1);
                                  tep_session_register('error_add_product');
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      case 'buy_card' :       if (isset($HTTP_GET_VARS['products_id']) && !$is_member && !$cart->has_card()) {
                                /*reset($cart->contents);
                                while(list($index,) = each($cart->contents))
                                  $cart->remove($index);*/
                                $cart->add_card($HTTP_GET_VARS['products_id']);
                              }
                              elseif ($is_member) {
                                $buy_card_error = ALREADY_MEMBER;
                                tep_session_register('buy_card_error');
                              }
                              elseif ($cart->has_card()) {
                                $buy_card_error = ALREADY_HAVE_CARD;
                                tep_session_register('buy_card_error');
                              }			  
							  $easy_discount->recalculate();
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
      case 'notify' :         if (tep_session_is_registered('customer_id')) {
                                if (isset($HTTP_GET_VARS['products_id'])) {
                                  $notify = $HTTP_GET_VARS['products_id'];
                                } elseif (isset($HTTP_GET_VARS['notify'])) {
                                  $notify = $HTTP_GET_VARS['notify'];
                                } elseif (isset($HTTP_POST_VARS['notify'])) {
                                  $notify = $HTTP_POST_VARS['notify'];
                                } else {
                                  tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                                }
                                if (!is_array($notify)) $notify = array($notify);
                                for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                                  $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
                                  $check = tep_db_fetch_array($check_query);
                                  if ($check['count'] < 1) {
                                    tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                  }
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($HTTP_GET_VARS['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $HTTP_GET_VARS['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($HTTP_GET_VARS['pid'])) {
                                if (tep_has_product_attributes($HTTP_GET_VARS['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $HTTP_GET_VARS['pid']));
                                } else {
                                  $cart->add_cart($HTTP_GET_VARS['pid'], $cart->get_quantity($HTTP_GET_VARS['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
    }
  }

// include the who's online functions
  require(DIR_WS_FUNCTIONS . 'whos_online.php');
  tep_update_whos_online();

// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// infobox
  require(DIR_WS_CLASSES . 'boxes.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();

// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// calculate category path
  if (isset($HTTP_GET_VARS['cPath'])) {
    $cPath = $HTTP_GET_VARS['cPath'];
  } elseif (isset($HTTP_GET_VARS['products_id']) && !isset($HTTP_GET_VARS['manufacturers_id'])) {
    $cPath = tep_get_product_path($HTTP_GET_VARS['products_id']);
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }
  
// calculate gamme path
  $display_type = ' group by pd.Gamme'; // determine wether we display the range listing or the product listing
  $cPath2 = 0;
  $range_where = '';
    
  if (isset($HTTP_GET_VARS['cPath2'])) {
    $cPath2 = $HTTP_GET_VARS['cPath2'];
    $display_type = '';
    $product_query = tep_db_query("select Brand, Gamme from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$cPath2 . "' and language_id = '" . (int)$languages_id . "'");
    $product = tep_db_fetch_array($product_query);
    $range_where = ' AND pd.Gamme LIKE "'.$product['Gamme'].'" ';
  }

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  //$breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the breadcrumb trail
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($HTTP_GET_VARS['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
//       $breadcrumb->add($manufacturers['manufacturers_name'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id']));
      $breadcrumb->add($manufacturers['manufacturers_name'], '/'.$HTTP_GET_VARS['manufacturers_id'].'-'.$manufacturers['manufacturers_name'].'.html');
 //     header('Location: /'.$HTTP_GET_VARS['manufacturers_id'].'-'.$manufacturers['manufacturers_name'].'.html');
    }
  }

  if (isset($HTTP_GET_VARS['filter_id']) && !empty($cPath)) {
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['filter_id'] . "'");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
//       $breadcrumb->add($manufacturers['manufacturers_name'], tep_href_link(FILENAME_DEFAULT, 'cPath='.$cPath.'&filter_id=' . (int)$HTTP_GET_VARS['filter_id']));
	  $breadcrumb->add($manufacturers['manufacturers_name'], '/'.$HTTP_GET_VARS['filter_id'].'-'.$manufacturers['manufacturers_name'].'.html');
}
  }
  if (!empty($cPath2)){
    $breadcrumb->add($product['Gamme'], tep_href_link(FILENAME_DEFAULT, get_url_cPath2() . '&cPath2=' . (int)$cPath2 ));
  }
// add the products model to the breadcrumb trail
  if (isset($HTTP_GET_VARS['products_id'])) {
    $model_query = tep_db_query("select m.manufacturers_name, p.products_model, c.parent_id, p.manufacturers_id, pd.Gamme, p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c," . TABLE_CATEGORIES . " c," . TABLE_MANUFACTURERS . " m  where m.manufacturers_id = p.manufacturers_id AND c.categories_id = p2c.categories_id AND p.products_id = p2c.products_id AND p.products_id = pd.products_id AND pd.language_id = ".(int)$languages_id." AND p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'");
    if (tep_db_num_rows($model_query)) {
      $model = tep_db_fetch_array($model_query);
      if (!isset($HTTP_GET_VARS['manufacturers_id'])){
//        $breadcrumb->add($model['manufacturers_name'], get_url_cPath2($model));
        $breadcrumb->add($model['manufacturers_name'], '/'.$model['manufacturers_id'].'-'.$model['manufacturers_name'].'.html');
      }
      $breadcrumb->add($model['Gamme'], tep_href_link(FILENAME_DEFAULT, get_url_cPath2($model).'&cPath2=' . $HTTP_GET_VARS['products_id']));
      $breadcrumb->add($model['products_model'], tep_href_link(FILENAME_PRODUCT_INFO, get_url_cPath2($model) . '&products_id=' . $HTTP_GET_VARS['products_id']));
    }
  }

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;
  //w($error_add_product);
  if (isset($buy_card_error)) {
    $messageStack->add_session('cart',$buy_card_error,'error');
    $messageStack->add('cart',$buy_card_error,'error');
    tep_session_unregister('buy_card_error');
  }
  elseif (isset($error_add_product)) {
    if (!empty($error_add_product)) {
      $messageStack->add('cart',$error_add_product,'error');
    }
    tep_session_unregister('error_add_product');
  }
  
// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');
  
// get the cart totals once so we do not need to recalculate the cart multiple times
if ($cart->count_contents() > 0) {
  $cart_weight = $cart->show_weight();
  $cart_total = $cart->show_total();
} else {
  $cart_total = 0;
  $cart_weight = 0;
}

include (DIR_WS_MODULES.'easy_coupons_code.php');

if (SPONSORSHIP_ACTIVATE) {
    require_once(DIR_WS_CLASSES . '/sponsorship.php');
    $sponsorship = new Sponsorship;

    if (tep_session_is_registered('from_sponsorship'))
        tep_session_unregister('from_sponsorship');
}

require_once(DIR_WS_CLASSES . '/newsletter.php');
$newsletter_pr = new newsletter;
$newsletter_pr->auto_save();

if (!isset($is_member)) $is_member = false;
?>
