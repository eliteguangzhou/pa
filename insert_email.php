<?php
define('PAGE_PARSE_START_TIME', microtime());

  ini_set('date.timezone', 'Asia/Pyongyang');
  
// set the level of error reporting
  //error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
 error_reporting(0);
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

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Connexion impossible à la Base de Données!');
  
//test if the email is already into the database
// $sql = "SELECT id FROM email_collect WHERE email = ".$_GET['email'];
// $result = tep_db_query($sql);

$sql = "INSERT INTO  `pa`.`neta` (
`neta_id` ,
`neta_email` ,
`neta_date_added` ,
`neta_type` ,
`neta_newsletter`
)
VALUES (
NULL ,  '".$_GET['email']."',  '".date("Y-m-d H:i:s")."',  'pr_newsletter', NULL);";
$res = tep_db_query($sql);
?>