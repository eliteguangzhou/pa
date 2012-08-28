<?php
/*
  $Id: catalog/ossCommentz.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/
session_start();

$action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
//this only works if the user agent has set the referer
//ALTERNATIVE - get referer in calling page and pass it to this page
//also, may not work if PHP is run on the command line
$referer = $_POST['url'];

$referer = str_replace('&captcha=false','',$referer);
$referer = str_replace('?captcha=false','',$referer);

if($action == '')$action = $_POST['action'];
$action = $_POST['action'];


function tep_exit() {
   tep_session_close();
   exit();
  }

function tep_session_close() {
    if (PHP_VERSION >= '4.0.4') {
      return session_write_close();
    } elseif (function_exists('session_close')) {
      return session_close();
    }
  }
  
function tep_redirect($url) {
  if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) { 
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
  }

  if ( (ENABLE_SSL == true) && (getenv('HTTPS') == 'on') ) { // We are loading an SSL page
    if (substr($url, 0, strlen(HTTP_SERVER)) == HTTP_SERVER) { // NONSSL url
      $url = HTTPS_SERVER . substr($url, strlen(HTTP_SERVER)); // Change it to SSL
    }
  }

  header('Location: ' . $url);

  tep_exit();
}
require_once('includes/configure.php');
require_once(DIR_WS_FUNCTIONS . 'database.php');
require(DIR_WS_INCLUDES . 'database_tables.php');
include_once(DIR_WS_CLASSES . '/comment8r/delegate.php');
tep_db_connect() or die('ossCommentz was unable to connect to database server!');
  
if ($action != null) {

  switch ($action) {
  	
  	case 'addComment':
  		include_once ('securimage/securimage.php');

			$securimage = new Securimage();

			if ($securimage->check($_POST['captcha_code']) == false) {

			  if(strpos($referer,'?')){

			  $captcha_err = '&captcha=false';
			} else {
				$captcha_err = '?captcha=false';
			}
			  $referer = $referer . $captcha_err;
				tep_redirect($referer);

			  die('<br>The code you entered was incorrect.  Go back and try again.<br>');
			} else {

				$delegate = new delegate();
				$delegate->saveNewMessage($_POST);
			} 		
  	break;  	
  }
  tep_redirect($referer);
}else {

  				error_log('------'.DIR_FS_CATALOG);
	include_once ('securimage/securimage.php');

			$securimage = new Securimage();

			if ($securimage->check($_POST['captcha_code']) == false) {

if(strpos($referer,'?')){

			  $captcha_err = '&captcha=false';
			} else {
				$captcha_err = '?captcha=false';
			}
			  $referer = $referer . $captcha_err;
				tep_redirect($referer);

			  die('<br>The code you entered was incorrect.  Go back and try again.<br>');
			} else {

				$delegate = new delegate();
				$delegate->saveNewMessage($_POST);
			} 	
			
			tep_redirect($referer);	
}

?>