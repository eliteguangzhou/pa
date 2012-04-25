<?php
/*
  $Id: checkout_success.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Pedido');
define('NAVBAR_TITLE_2', 'Realizado con Exito');

define('HEADING_TITLE', '<p><b>¡Enhorabuena!</b></p>
  <p>
  Hemos recibido correctamente su pedido.</p>
  <p>Si su pedido no contiene ninguna anomalía, sus productos serán enviados en un plazo de 12 días.</p>

  <p>
  Una confirmación de pedido se ha enviado a su casilla de correo electrónico. Si usted no ha recibido nada en los 10 minutos, puede acceder a la confirmación del pedido con este enlace:<br />
  <a href="http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s">http://'.$_SERVER['SERVER_NAME'].'/account_history_info.php?order_id=%s</a>
  </p>
<br /><br />
  <p><b>
  Por favor, también disfrutar de su conocimiento de un cupón de descuento de %s por entrar en su correo electrónico en los siguientes ámbitos::</b><br />
  <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
  <table cellpadding="0" cellspacing="5" style="width:220px;">
  <tr><td>Ccorreo electrónico 1 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Correo electrónico 2 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td>Correo electrónico 3 : <input type="text" name="email[]" value="%s" /></td></tr>
  <tr><td align="center">'.tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE).'</td></tr>
  </table>
  </form>
  </p>');

define('TEXT_SUCCESS', 'Su pedido ha sido realizado con &eacute;xito! Sus productos llegar&aacute;n a su destino de 2 a 5 dias laborales.');
define('TEXT_NOTIFY_PRODUCTS', 'Por favor notifiqueme de cambios realizados a los productos seleccionados:');
define('TEXT_SEE_ORDERS', 'Puede ver sus pedidos viendo la pagina de <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Su Cuenta\'</a> y pulsando sobre <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Historial\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Dirija sus preguntas al <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">administrador</a>.');
define('TEXT_THANKS_FOR_SHOPPING', '¡Gracias por comprar con nosotros!');

define('TABLE_HEADING_COMMENTS', 'Introduzca un comentario sobre su pedido');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Fecha Caducidad: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' descargas restantes');
define('HEADING_DOWNLOAD', 'Descargue sus productos aqui:');
define('FOOTER_DOWNLOAD', 'Puede descargar sus productos mas tarde en \'%s\'');

define('BAD_FRIEND_EMAIL', 'Correo electrónico no válida');

define('MAIL_SENT', 'Un correo electrónico ha sido enviado a sus contactos con el código de descuento !');

define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s ofrece un cupón '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hola ,

Su amigo %s quiere dar un descuento de %s da cuenta de uno de sus pedidos <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Disfruta de este descuento, válido durante 48 horas en entrar en el siguiente código "%s", con su solicitud.

Si usted aún no es parte en el círculo privilegiado de los miembros de '.STORE_NAME.', ahora puede registrarse haciendo clic en el siguiente enlace :

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

Hasta pronto.
El equipo de '.STORE_NAME.'.
');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Ya ha enviado un cupón a este amigo antes de');
?>