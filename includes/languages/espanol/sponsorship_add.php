<?php
define('SPONSORSHIP_INTRODUCTION_TEXT', '2 buenas razones para apadrinar a tus amigos!

1. Simple !
Para patrocinar a sus amigos, simplemente introduzca su correo electr�nico<sup>(1)</sup>en los campos de abajo. Un correo electr�nico ser� enviado para informarles de la invitaci�n.

2. Se relaciona con el euro !
'.STORE_NAME.' ofrece una remuneraci�n excepcional disminuido en 3 niveles lo que le permite ganar EUR<sup>(2)</sup> :

- %s en los primeros %s pedidos de sus referencias directas
- %s en los primeros %s pedidos de sus referencias de sus referencias de
- %s en los primeros %s pedidos de sus referencias de sus referencias de sus referencias de

<img src="images/parrain_schema.gif" />

Usted puede patrocinar hasta 100 descendente y ganar hasta 700 euros en vales de sus referencias directas y mucho m�s con sus ahijados, etc ahijados.
Reinicie el espacio a trav�s del "patrocinio" en su cuenta para multiplicar sus ganancias!

Registre su casa r�pidamente '. STORE_NAME.' y disfrutar el patrocinio de euros para ganar!

<i><sup>(1)</sup> : Correo electr�nico van a utilizar cuando se registra con '.STORE_NAME.'
<sup>(2)</sup> : Las ganancias se publicar� a trav�s de c�digos de descuento v�lido durante 1 a�o en '.STORE_NAME.'
</i>');

define('SPONSORSHIP_TYPE_EMAILS', 'Introduzca los correos electr�nicos de los amigos de usted desea patrocinar :');
define('SPONSORSHIP_SUBMIT_BUTTON', 'Patrocinador');

define('ENTRY_QUOTA_GODCHILD', 'Ha superado su cuota de ahijados (%s restantes)');

define('ENTRY_EMAIL_ERROR', 'El siguiente correo electr�nico no es v�lida: <br />- %s');
define('ENTRY_EMAIL_ERRORS', 'Los siguientes e-mail no es v�lido : <br />- %s');

define('ENTRY_STORED_EMAIL_ERROR', 'El cliente de correo electr�nico siguiente ya est� '.STORE_NAME.' : <br />- %s');
define('ENTRY_STORED_EMAIL_ERRORS', 'Los clientes de correo electr�nico ya est�n '.STORE_NAME.' : <br />- %s');

define('ENTRY_SPONSORED_EMAIL_ERROR', 'El siguiente e-mail ya la espera de patrocinio : <br />- %s');
define('ENTRY_SPONSORED_EMAIL_ERRORS', 'Los siguientes son mensajes de correo electr�nico ya la espera de patrocinio : <br />- %s');
define('SPONSORSHIP_TITLE', 'Patrocinador un amigo');

define('SPONSORSHIP_EMAIL_SUBJECT', '%s quiere descubrir '.STORE_NAME);

define('SPONSORSHIP_EMAIL_TEXT', 'Hola ,

Su amigo %s quer�a introducir a nuestro sitio <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a> y estamos muy contentos.

Estamos muy contentos de ofrecer %s de descuento en la cuenta de uno de sus comandos para obtener una ventaja en sus compras de <a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'">'.STORE_NAME.'</a>. Disfrute de esta tarifa especial de 1 mes por entrar en el siguiente c�digo "%s", para ordenar.

Para obtener su vez, en el c�rculo de los privilegiados '.STORE_NAME.', s�lo tienes que aceptar la invitaci�n de %s haciendo clic en el enlace de abajo:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s">http://'.$_SERVER['SERVER_NAME'].'/create_account.php?key=%s&email=%s</a>

Hasta pronto espero.
Todo el equipo de '.STORE_NAME.'. ');

define('SPONSORSHIP_EMAIL_SENT', 'Felicidades !

Sus amigos le han sido notificados por correo electr�nico de tu invitaci�n.

Podr� disfrutar de una buena oferta en su primera compra, sino tambi�n sobre las compras de sus ahijados y nietos, ahijados! Estos cupones se enviar�n por correo electr�nico y tambi�n estar� disponible en este enlace:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">Mis recortes</a>

Tambi�n puede ver el seguimiento de sus referencias haciendo clic en el enlace de abajo:

<a href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_list.php">Mentor</a>

Saludos cordiales,
Todo el equipo de '.STORE_NAME);
?>