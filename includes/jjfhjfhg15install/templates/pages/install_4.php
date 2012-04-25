<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  require('../includes/database_tables.php');

  osc_db_connect($HTTP_POST_VARS['DB_SERVER'], $HTTP_POST_VARS['DB_SERVER_USERNAME'], $HTTP_POST_VARS['DB_SERVER_PASSWORD']);
  osc_db_select_db($HTTP_POST_VARS['DB_DATABASE']);

  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . $HTTP_POST_VARS['CFG_STORE_NAME'] . '" where configuration_key = "STORE_NAME"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . $HTTP_POST_VARS['CFG_STORE_OWNER_NAME'] . '" where configuration_key = "STORE_OWNER"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . $HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS'] . '" where configuration_key = "STORE_OWNER_EMAIL_ADDRESS"');

  if (!empty($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) && !empty($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS'])) {
    osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "\"' . $HTTP_POST_VARS['CFG_STORE_OWNER_NAME'] . '\" <' . $HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS'] . '>" where configuration_key = "EMAIL_FROM"');
  }

  $check_query = osc_db_query('select user_name from ' . TABLE_ADMINISTRATORS . ' where user_name = "' . $HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME'] . '"');

  if (osc_db_num_rows($check_query)) {
    osc_db_query('update ' . TABLE_ADMINISTRATORS . ' set user_password = "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '" where user_name = "' . $HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME'] . '"');
  } else {
    osc_db_query('insert into ' . TABLE_ADMINISTRATORS . ' (user_name, user_password) values ("' . $HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME'] . '", "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '")');
  }
?>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li>Serveur SQL</li>
      <li>Serveur Web</li>
      <li>Paramètres de la boutique</li>
      <li style="font-weight: bold;">Terminé !</li>
    </ol>
  </div>

  <h1>Nouvelle Installation</h1>

  <p>Le système installera et configurera correctement votre boutique sur le serveur.</p>
  <p>Suivez les instructions à l'écran qui vous sont données pour le serveur SQL, le serveur Web et les paramètres de la boutique. Si vous avez besoin d'aide, veuillez consulter la documentation, la FAQ ou les espaces spécifiques sur le forum.</p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Etape 4: Terminé !</h3>

    <div class="infoPaneContents">
      <p>Félicitation pour l'installation et la configuration de osCommerce Online Merchant comme solution pour votre boutique en ligne.</p>
      <p>Nous vous souhaitons plein de succès avec votre boutique en ligne ainsi que la bienvenue au sein de notre communauté participative.</p>
      <p align="right">- L'équipe Oscommerce Francophone</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Terminé !</h2>

<?php
  $dir_fs_document_root = $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($HTTP_POST_VARS['HTTP_WWW_ADDRESS']);
  $http_server = $http_url['scheme'] . '://' . $http_url['host'];
  $http_catalog = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }

  if (substr($http_catalog, -1) != '/') {
    $http_catalog .= '/';
  }

  $file_contents = '<?php' . "\n" .
                    '/*' . "\n" .
                    '  $Id: configure.php,v 1.15 15/04/2008 16:26:48 Oneill-Gnidhal Exp $' . "\n" .
                    '  $$ : catalog or root directory' . "\n" .
                    '  osCommerce, Open Source E-Commerce Solutions' . "\n" .
                    '  http://www.oscommerce.com' . "\n" .
                    '' . "\n" .
                    '  Copyright (c) 2003 osCommerce' . "\n" .
                    '' . "\n" .
                    '  Released under the GNU General Public License' . "\n" .
                    '*/' . "\n" .
                    '' . "\n" .
                    '// Define the webserver and path parameters' . "\n" .
                    '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                    '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL\', false);' . "\n" .
                   '  define(\'HTTP_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTP_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTP_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTPS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n\n" .
                   '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n\n" .
                   '  define(\'DB_SERVER\', \'' . $HTTP_POST_VARS['DB_SERVER'] . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . $HTTP_POST_VARS['DB_SERVER_USERNAME'] . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . $HTTP_POST_VARS['DB_SERVER_PASSWORD']. '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . $HTTP_POST_VARS['DB_DATABASE']. '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);

  $file_contents = '<?php' . "\n" .
                    '/*' . "\n" .
                    '  $Id: configure.php,v 1.15 15/04/2008 16:26:48 Oneill-Gnidhal Exp $' . "\n" .
                    '  $$ : admin directory' . "\n" .
                    '  osCommerce, Open Source E-Commerce Solutions' . "\n" .
                    '  http://www.oscommerce.com' . "\n" .
                    '' . "\n" .
                    '  Copyright (c) 2003 osCommerce' . "\n" .
                    '' . "\n" .
                    '  Released under the GNU General Public License' . "\n" .
                    '*/' . "\n" .
                    '' . "\n" .
                    '// Define the webserver and path parameters' . "\n" .
                    '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                    '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL_CATALOG\', \'false\');' . "\n" .
                   '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog . 'admin/\');' . "\n" .
                   '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . 'admin/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                   '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n\n" .
                   '  define(\'DB_SERVER\', \'' . $HTTP_POST_VARS['DB_SERVER'] . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . $HTTP_POST_VARS['DB_SERVER_USERNAME'] . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . $HTTP_POST_VARS['DB_SERVER_PASSWORD']. '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . $HTTP_POST_VARS['DB_DATABASE']. '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'admin/includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
?>

    <p>Votre Boutique a été installée et configurée avec succès !</p>

    <br />

    <table border="0" summary="" width="99%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="images/button_catalog.gif" border="0" alt="Catalogue" /></a></td>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'admin/index.php'; ?>" target="_blank"><img src="images/button_administration_tool.gif" border="0" alt="Administration" /></a></td>
      </tr>
    </table>
  </div>
</div>
