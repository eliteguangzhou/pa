<?php
/*
  $Id: configure.php,v 1.15 15/04/2008 16:26:48 Oneill-Gnidhal Exp $
  $$ : admin directory
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
  define('HTTP_CATALOG_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
  define('HTTPS_CATALOG_SERVER', 'http://'.$_SERVER['SERVER_NAME']);
  define('ENABLE_SSL_CATALOG', 'false');
  define('DIR_FS_DOCUMENT_ROOT', '/var/www/vhosts/parfumrama.com/httpdocs/');
  define('DIR_WS_ADMIN', '/bo/');
  define('DIR_FS_ADMIN', '/var/www/vhosts/parfumrama.com/httpdocs/bo/');
  define('DIR_WS_CATALOG', '/');
  define('DIR_FS_CATALOG', '/var/www/vhosts/parfumrama.com/httpdocs/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');

  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'pa123');
  define('DB_SERVER_PASSWORD', '3ry54SJhRAvEul');
  define('DB_DATABASE', 'pa123');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
?>
