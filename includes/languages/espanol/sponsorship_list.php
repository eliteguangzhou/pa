<?php

define('SPONSORSHIP_TITLE', 'Mentor');
define('SPONSORSHIP_FIRSTNAME', 'Nombre');
define('SPONSORSHIP_LASTNAME', 'Apellido');
define('SPONSORSHIP_EMAIL', 'Correo');
define('SPONSORSHIP_SUBSCRIBED', 'Antigüedad');
define('SPONSORSHIP_RETRY', 'Reiniciar');
define('SPONSORSHIP_NO_GODCHILD', 'N ahijado');
define('SPONSORSHIP_YES', '<span style="color:green">Sí</span>');
define('SPONSORSHIP_NO', '<span style="color:red">No</span>');

define('SPONSORSHIP_RETRY_LATER', '1 de la recuperación máxima de la jornada');

define('SPONSORSHIP_EMAIL_ERROR', 'Mensajes de correo electrónico para reiniciar no son válidos.');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s quiere descubrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Hola ,

Su amigo %s quería introducir a nuestro sitio <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> y estamos muy contentos.

Estamos muy contentos de ofrecer %s de descuento en la cuenta de uno de sus comandos para obtener una ventaja en sus compras de <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Disfrute de esta tarifa especial de 1 mes por entrar en el siguiente código "%s", para ordenar.

Para obtener su vez, en el círculo de los privilegiados '.STORE_NAME.', sólo tienes que aceptar la invitación de %s haciendo clic en el enlace de abajo:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

Hasta pronto espero.
Todo el equipo de '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Sus amigos se han reavivado por correo electrónico.');
?>