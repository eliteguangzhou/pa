<?php
define('FRIEND_DISCOUNT_TITLE', 'Cupones de descuento para 3 de sus amigos !');
define('FRIEND_DISCOUNT_INTRO', 'Por favor, disfrute de su conocimiento de un cup�n por valor de %s por entrar en su correo electr�nico en los siguientes �mbitos:<br />');
define('ERROR_BAD_ORDER', 'Orden v�lida o ya procesados');
define('ERROR_BAD_FRIEND_EMAIL', 'Correo electr�nico no v�lida');
define('ERROR_ALREADY_FRIEND_EMAIL', 'Este amigo ya se ha beneficiado de una reducci�n por este orden');
define('ERROR_MAX_FRIENDS', 'Ha alcanzado el n�mero m�ximo de piezas permitidas para este comando');
define('ERROR_DISCOUNT_ALREADY_GIVEN', 'Ya ha enviado un cup�n a este amigo antes de');
define('ERROR_MAX_FRIENDS_REACHED', 'Ha superado el n�mero m�ximo de piezas permitidas para este comando (%s restantes)');
define('MAIL_SENT', 'Un correo electr�nico ha sido enviado a sus contactos con el c�digo de descuento !');


define('FRIEND_DISCOUNT_EMAIL_SUBJECT', '%s ofrece un cup�n '.STORE_NAME);

define('FRIEND_DISCOUNT_EMAIL_TEXT', 'Hola ,

Tu amigo %s quiere dar un descuento de %s en la cuenta de uno de sus pedidos <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Disfruta de este descuento, v�lido durante 48 horas en entrar en el siguiente c�digo "%s" con su pedido.

Si usted a�n no es parte en el c�rculo privilegiado de los miembros de '.STORE_NAME.', ahora puede registrarse haciendo clic en el siguiente enlace:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php">http://'.$_SERVER['SERVER_NAME'].'/create_account.php</a>

Hasta pronto.
El equipo de '.STORE_NAME.'.
Tel : 0970 465 068');
?>