<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  $compat_register_globals = true;

  if (function_exists('ini_get') && (PHP_VERSION < 4.3) && ((int)ini_get('register_globals') == 0)) {
    $compat_register_globals = false;
  }
?>

<div class="mainBlock">
  <h1>Bienvenue osCommerce Online Merchant v2.2 FR W3C Valid !</h1>

      <p>osCommerce est une solution E-Commerce en Open Source se développant grâce à sa communauté. Cette solution permet aux propriétaires de magasins d'installer, configurer, utiliser et assurer la maintenance de leur boutique en ligne avec un minimun d'effort et sans les coûts impliqués.</p>
      <p>osCommerce associe des solutions Open Source pour fournir une plateforme de développement libre et ouverte, qui inclue la <i>puissance</i> du langage script PHP, la <i>stabilité</i> des serveurs Apache, et la <i>rapidité</i> des bases de données MySQL.</p>
      <p>Sans obligations ni restrictions, osCommerce peut être installé sur tous serveurs où php3 à php5.2.4 (au moins) et MySql 3.23 à mysql 5.0.x sont exécutés, sur tout environnement PHP et MySQL sont supportés, incluant Linux, Solaris, BSD, et Microsoft Windows XX.</p
></div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Propriétés Serveur</h3>

    <div class="infoPaneContents">
      <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>Version PHP</b></td>
          <td align="right"><?php echo PHP_VERSION; ?></td>
          <td align="right" width="25"><img alt="<?php echo PHP_VERSION; ?>" src="images/<?php echo ((PHP_VERSION >= 4) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

<?php
  if (function_exists('ini_get')) {
?>

      <br />

      <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>Réglages PHP</b></td>
          <td align="right"></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>register_globals</td>
          <td align="right"><?php echo (((int)ini_get('register_globals') == 0) ? 'Non' : 'Oui'); ?></td>
          <td align="right"><img alt="register_globals" src="images/<?php echo (($compat_register_globals == true) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>magic_quotes</td>
          <td align="right"><?php echo (((int)ini_get('magic_quotes') == 0) ? 'Non' : 'Oui'); ?></td>
          <td align="right"><img alt="magic_quotes" src="images/<?php echo (((int)ini_get('magic_quotes') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>file_uploads</td>
          <td align="right"><?php echo (((int)ini_get('file_uploads') == 0) ? 'Non' : 'Oui'); ?></td>
          <td align="right"><img alt="" src="images/<?php echo (((int)ini_get('file_uploads') == 1) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>session.auto_start</td>
          <td align="right"><?php echo (((int)ini_get('session.auto_start') == 0) ? 'Non' : 'Oui'); ?></td>
          <td align="right"><img alt="" src="images/<?php echo (((int)ini_get('session.auto_start') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>session.use_trans_sid</td>
          <td align="right"><?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'Non' : 'Oui'); ?></td>
          <td align="right"><img alt="" src="images/<?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

      <br />

      <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>Extensions PHP</b></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>MySQL</td>
          <td align="right"><img alt="" src="images/<?php echo (extension_loaded('mysql') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>GD</td>
          <td align="right"><img alt="" src="images/<?php echo (extension_loaded('gd') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>cURL</td>
          <td align="right"><img alt="" src="images/<?php echo (extension_loaded('curl') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>OpenSSL</td>
          <td align="right"><img alt="" src="images/<?php echo (extension_loaded('openssl') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

<?php
  }
?>

    </div>
  </div>

  <div class="contentPane">
    <h2>Nouvelle Installation</h2>

<?php
  $configfile_array = array();

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php';
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php';
  }

  $warning_array = array();

  if (function_exists('ini_get')) {
    if ($compat_register_globals == false) {
      $warning_array['register_globals'] = 'La comptatibilité avec register_globals est supporté depuis PHP 4.3+. Ce réglage <u>doit être activé</u> sur une plus ancienne version PHP.';
    }
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
?>

    <div class="noticeBox">

<?php
    if (sizeof($warning_array) > 0) {
?>

      <table border="0" summary="" width="100%" cellspacing="0" cellpadding="2" style="background: #fffbdf; border: 1px solid #ffc20b; padding: 2px;">

<?php
      reset($warning_array);
      while (list($key, $value) = each($warning_array)) {
        echo '        <tr>' . "\n" .
             '          <td valign="top"><b>' . $key . '</b></td>' . "\n" .
             '          <td valign="top">' . $value . '</td>' . "\n" .
             '        </tr>' . "\n";
      }
?>

      </table>
<?php
    }

    if (sizeof($configfile_array) > 0) {
?>

      <p>Le serveur Web ne peut sauvegarder les paramètres d'installation dans les fichiers de configuration</p>
      <p>Les fichiers suivants doivent avoir des droits d'écriture (chmod 777):</p>
      <p>

<?php
      for ($i=0, $n=sizeof($configfile_array); $i<$n; $i++) {
        echo $configfile_array[$i];

        if (isset($configfile_array[$i+1])) {
          echo '<br />';
        }
      }
?>

      </p>

<?php
    }
?>

    </div>

<?php
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
?>
    <p>Corrigez les erreurs suivantes et relancez l'installation un fois fait.</p>

<?php
    if (sizeof($warning_array) > 0) {
      echo '    <p><i>Les changements de paramètres du serveur imposent le redémarage du serveur pour prendre effet.</i></p>' . "\n";
    }
?>

    <p align="right"><a href="index.php"><img src="images/button_retry.gif" border="0" alt="Réessayer" /></a></p>

<?php
  } else {
?>
    <p>L'environnement du serveur a été vérifié en vue de l'installation et de la configuration de votre boutique.</p>
    <p>Veuillez continuer la procédure d'installation.</p>
    <p align="right"><a href="install.php"><img src="images/button_continue.gif" border="0" alt="Continuer" /></a></p>

<?php
  }
?>

  </div>
</div>
