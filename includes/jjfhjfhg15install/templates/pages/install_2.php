<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  $www_location = 'http://' . $HTTP_SERVER_VARS['HTTP_HOST'];

  if (isset($HTTP_SERVER_VARS['REQUEST_URI']) && !empty($HTTP_SERVER_VARS['REQUEST_URI'])) {
    $www_location .= $HTTP_SERVER_VARS['REQUEST_URI'];
  } else {
    $www_location .= $HTTP_SERVER_VARS['SCRIPT_FILENAME'];
  }

  $www_location = substr($www_location, 0, strpos($www_location, 'install'));

  $dir_fs_www_root = osc_realpath(dirname(__FILE__) . '/../../../') . '/';
?>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li>Serveur SQL</li>
      <li style="font-weight: bold;">Serveur Web</li>
      <li>Paramètres de la boutique</li>
      <li>Terminé !</li>
    </ol>
  </div>

  <h1>Nouvelle Installation</h1>

  <p>Le système installera et configurera correctement votre boutique sur le serveur.</p>
  <p>Suivez les instructions à l'écran qui vous sont données pour le serveur SQL, le serveur Web et les paramètres de la boutique. Si vous avez besoin d'aide, veuillez consulter la documentation, la FAQ ou les espaces spécifiques sur le forum.</p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Etape 2: Le Serveur Web</h3>

    <div class="infoPaneContents">
      <p>Le serveur Web prend en charge l'affichage des pages de votre boutique en ligne pour vos visiteurs et clients. Assurez-vous que les URL pointent au bon endroit.</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Web Server</h2>

    <form name="install" id="installForm" action="install.php?step=3" method="post">

    <table border="0" summary="" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'WWW Address<br />' . osc_draw_input_field('HTTP_WWW_ADDRESS', $www_location, 'class="text"'); ?></td>
        <td class="inputDescription">Adresse Web de votre boutique en ligne.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Webserver Root Directory<br />' . osc_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root, 'class="text"'); ?></td>
        <td class="inputDescription">Dossier où est installée votre boutique sur votre serveur Web.</td>
      </tr>
    </table>

    <p align="right"><input type="image" src="images/button_continue.gif" border="0" alt="Continue" id="inputButton" />&nbsp;&nbsp;<a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Annuler" /></a></p>
	
<?php
  reset($HTTP_POST_VARS);
  while (list($key, $value) = each($HTTP_POST_VARS)) {
    if (($key != 'x') && ($key != 'y')) {
      if (is_array($value)) {
        for ($i=0, $n=sizeof($value); $i<$n; $i++) {
          echo osc_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        echo osc_draw_hidden_field($key, $value);
      }
    }
  }
?>

    </form>
  </div>
</div>
