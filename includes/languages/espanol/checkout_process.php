<?php
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Procesar Pedido');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de Pedido:');
define('EMAIL_TEXT_NAME', 'Nombre');
define('EMAIL_TEXT_PRICE', 'Precio');
define('EMAIL_TEXT_QTY', 'Cantidad');
define('EMAIL_TEXT_TOTAL', 'Total:    ');
define('EMAIL_TEXT_SUB_TOTAL', 'Subtotal');
define('EMAIL_TEXT_TAX', 'Impuestos:      ');
define('EMAIL_TEXT_ORDER_TOTAL', 'Orden total');
define('EMAIL_TEXT_CONTENT_HIGH', 'Estimado / Estimada %s,
<br><br>
Le agradecemos su pedido %s realizado el %s
<br><br>
Si su pedido no contiene ninguna anomalía, sus productos serán enviados en un plazo de 12 días.
<br><br>
Podrá verificar el estado de su pedido conectándose a su cuenta durante 72 horas :
<br><br>
<a href=\"http://www.'.strtolower(STORE_NAME).'\">http://www.'.strtolower(STORE_NAME).'</a><br>
e-mail: %s<br>
contraseña: %s');
define('EMAIL_TEXT_CONTENT', 'Hemos recibido correctamente su pedido..
<br><br>
Si su pedido no contiene ninguna anomalía, sus productos serán enviados en un plazo de 12 días.');
define('EMAIL_TEXT_CONTENT_LESS', 'EMAIL_TEXT_CONTENT_HIG');
define('EMAIL_TEXT_TITRE', '<br><b>Su pedido</b><br>');
define('EMAIL_TEXT_INVOICE_URL', 'Pedido Detallado:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha del Pedido:');
define('EMAIL_TEXT_PRODUCTS', 'Productos');
define('EMAIL_TEXT_SUBTOTAL', 'Subtotal:');
define('EMAIL_TEXT_SHIPPING', 'Gastos de Envío: ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Direcciön de Entrega');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Dirección de Facturación');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Forma de Pago');
define('TEXT_EMAIL_VIA', 'por');
define('SPONSORSHIP_EMAIL_SUBJECT', 'Nuevo código de descuento '.STORE_NAME);
define('SPONSORSHIP_EMAIL_TEXT', 'Hola ,

Estamos encantados de enviarle el código de descuento siguiente : "%s" valer %s válidos %s meses después de pedido de %sahijado %s.

Puede acceder a su lista de reducciones en el registro en nuestro sitio web mediante el siguiente enlace:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php">http://'.$_SERVER['SERVER_NAME'].'/sponsorship_discount.php</a>

Saludos cordiales,
Todo el equipo de '.STORE_NAME.'.
Tel : 0970 465 068');
define('STR_GODCHILD_1', '');
define('STR_GODCHILD_2', 'pequeño ');
define('STR_GODCHILD_3', 'pequeño pequeño ');
define('EMAIL_TEXT_DISCOUNT_SUBJECT', '%s de reducción para tus amigos !');
define('EMAIL_FRIEND_DISCOUNT', 'Hola %s,

A raíz de su solicitud, a sus amigos con usted puede beneficiarse de una reducción de %s.

Haga clic en la brevedad posible sobre el siguiente enlace para enviar el cupón a tus amigos:

<a target="blank" href="http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s">http://'.$_SERVER['SERVER_NAME'].'/friend_discount.php?var=%s</a>

Saludos cordiales,
El equipo de '.STORE_NAME.'.
');
define('EMAIL_TEXT_SUBJECT_MEMBER', 'Su membresía en '.STORE_NAME.'');
define('EMAIL_MEMBER', '%s
<br /><br />
Usted es ahora parte de los miembros de '.ucfirst($_SERVER['SERVER_NAME']).'.
<br />
Su suscripción vence el : %s
<br /><br />
Nos vemos en '.ucfirst($_SERVER['SERVER_NAME']).'');
?>