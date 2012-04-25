<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/
?>

<script language="javascript" type="text/javascript" src="ext/xmlhttp/xmlhttp.js"></script>
<script language="javascript" type="text/javascript">
<!--

  var dbServer;
  var dbUsername;
  var dbPassword;
  var dbName;

  var formSubmited = false;

  function handleHttpResponse_DoImport() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/success.gif" align="right" hspace="5" vspace="5" border="0" />Base de données importée avec succès.</p>';

          setTimeout("document.getElementById('installForm').submit();", 2000);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" />Il y a eu un problème durant l\'importation de la Base de données. Le problème suivant est survenu :</p><p><b>%s</b></p><p>Vérifiez les paramètres de connexion et recommencez.</p>'.replace('%s', result[1]);
        }
      }

      formSubmited = false;
    }
  }

  function handleHttpResponse() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" />La Base de Données est en cours de transfert. Soyez patient pendant cette procédure.</p>';

          loadXMLDoc("rpc.php?action=dbImport&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse_DoImport);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" />Il y a eu un problème de connexion à votre base de données. Le problème suivant est survenu :</p><p><b>%s</b></p><p>Vérifiez les paramètres de connexion et recommencez.</p>'.replace('%s', result[1]);
          formSubmited = false;
        }
      } else {
        formSubmited = false;
      }
    }
  }

  function prepareDB() {
    if (formSubmited == true) {
      return false;
    }

    formSubmited = true;

    showDiv(document.getElementById('mBox'));

    document.getElementById('mBoxContents').innerHTML = '<p><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" />Test de connexion à la base de données..</p>';

    dbServer = document.getElementById("DB_SERVER").value;
    dbUsername = document.getElementById("DB_SERVER_USERNAME").value;
    dbPassword = document.getElementById("DB_SERVER_PASSWORD").value;
    dbName = document.getElementById("DB_DATABASE").value;

    loadXMLDoc("rpc.php?action=dbCheck&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse);
  }

//-->
</script>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li style="font-weight: bold;">Serveur SQL</li>
      <li>Serveur Web</li>
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
    <h3>Etape 1: Serveur SQL</h3>

    <div class="infoPaneContents">
      <p>Le serveur de base de données stocke le contenu de la boutique en ligne tels que les produits, les informations, les renseignements sur les clients et les commandes qui ont été faites..</p>
      <p>Contactez votre administrateur de serveur si vous ne connaisez pas les paramètres de votre serveur.</p>
    </div>
  </div>

  <div id="mBox">
    <div id="mBoxContents"></div>
  </div>

  <div class="contentPane">
    <h2>Serveur de base de données</h2>

    <form name="install" id="installForm" action="install.php?step=2" method="post" onsubmit="prepareDB(); return false;">

    <table border="0" summary="" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'Database Server<br />' . osc_draw_input_field('DB_SERVER', null, 'class="text"'); ?></td>
        <td class="inputDescription">Nom du serveur SQL (hostname ou adresse IP).</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Username<br />' . osc_draw_input_field('DB_SERVER_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">Nom d'utilisateur pour la connexion au serveur.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Password<br />' . osc_draw_password_field('DB_SERVER_PASSWORD', 'class="text"'); ?></td>
        <td class="inputDescription">Mot de passe utilisé avec le nom d'utilisateur.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Database Name<br />' . osc_draw_input_field('DB_DATABASE', null, 'class="text"'); ?></td>
        <td class="inputDescription">Nom de la Base de données à utiliser.</td>
      </tr>
    </table>

    <p align="right"><input type="image" src="images/button_continue.gif" border="0" alt="Continuer" id="inputButton" />&nbsp;&nbsp;<a href="index.php"><img src="images/button_cancel.gif" border="0" alt="Annuler" /></a></p>

    </form>
  </div>
</div>
