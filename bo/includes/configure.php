<?php
/*
  $Id: configure.php,v 1.15 15/04/2008 16:26:48 Oneill-Gnidhal Exp $
  $$ : catalog or root directory
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
  define('HTTPS_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', $_SERVER['SERVER_NAME']);
  define('HTTPS_COOKIE_DOMAIN', $_SERVER['SERVER_NAME']);
  define('HTTP_COOKIE_PATH', '/');
  define('HTTPS_COOKIE_PATH', '/');
  define('DIR_WS_HTTP_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_PWS_IMAGE', 'http://www.parfumwholesale.com/images/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', 'C:/wamp/www/pa/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', 'hahaha');
  define('DB_DATABASE', 'pa');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
?>
