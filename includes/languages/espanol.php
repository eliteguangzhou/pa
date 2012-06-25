<?php
/*
  $Id: espanol.php 1743 2007-12-20 18:02:36Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'es_ES'
// on FreeBSD try 'es_ES.ISO_8859-1'
// on Windows try 'sp', or 'Spanish'
@setlocale(LC_TIME, 'es_ES.ISO_8859-1');
if (eregi('windows', $_SERVER['SystemRoot'])) @setlocale(LC_TIME, 'es'); // Page de code pour serveur sous Windows (installation locale)

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crear Cuenta');
define('HEADER_TITLE_MY_ACCOUNT', 'Mi Cuenta');
define('HEADER_TITLE_CART_CONTENTS', 'Ver Cesta');
define('HEADER_TITLE_CHECKOUT', 'Realizar Pedido');
define('HEADER_TITLE_TOP', 'Inicio');
define('HEADER_TITLE_CATALOG', 'Cat&aacute;logo');
define('HEADER_TITLE_LOGOFF', 'Salir');
define('HEADER_TITLE_LOGIN', 'Entrar');
define('HEADER_NEW_DISCOUNT', '<a href="'.tep_href_link('sponsorship_discount.php').'" id="new_discount">Nouveau code de réduction ! Cliquez ici !</a>');
define('HEADER_NEW_DISCOUNTS', '<a href="'.tep_href_link('sponsorship_discount.php').'" id="new_discount">Nouveaux codes de réduction ! Cliquez ici !</a>');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'peticiones desde');

// text for gender
define('MALE', 'Var&oacute;n');
define('FEMALE', 'Mujer');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorias');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Marcas');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novedades');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'B&uacute;squeda R&aacute;pida');
define('BOX_SEARCH_TEXT', 'Use palabras clave para encontrar el producto que busca.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'B&uacute;squeda Avanzada');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Ofertas');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Comentarios');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escriba un comentario para este producto');
define('BOX_REVIEWS_NO_REVIEWS', 'En este momento, no hay ningun comentario');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrellas!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Compras');
define('BOX_SHOPPING_CART_EMPTY', ' productos');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Mis Pedidos');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Top Ventas');
define('BOX_HEADING_BESTSELLERS_IN', 'Top Ventas en <br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificaciones');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notifiqueme de cambios a <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'No me notifique de cambios a <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'P&aacute;gina de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Otros productos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Monedas');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informaci&oacute;n');
define('BOX_INFORMATION_PRIVACY', 'Confidencialidad');
define('BOX_INFORMATION_CONDITIONS', 'Menciones Legales');
define('BOX_INFORMATION_SHIPPING', 'Envios/Devoluciones');
define('BOX_INFORMATION_CONTACT', 'Contactenos');
define('BOX_INFORMATION_ABOUT_US', 'Quiénes somos');
define('BOX_INFORMATION_SHIPPING_DETAILS', 'Detalles del envío');
define('BOX_INFORMATION_RETURNS', 'Devoluciones');
define('BOX_INFORMATION_CANCEL', 'Cancelaciones');
define('BOX_INFORMATION_TRACK', 'Seguimiento de los pedidos');
define('BOX_INFORMATION_FAQ', 'Preguntas Frecuentes');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'D&iacute;selo a un Amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Env&iacute;a esta pagina a un amigo con un comentario.');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'entrega');
define('CHECKOUT_BAR_PAYMENT', 'pago');
define('CHECKOUT_BAR_CONFIRMATION', 'confirmaci&oacute;n');
define('CHECKOUT_BAR_FINISHED', 'finalizado!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Seleccione');
define('TYPE_BELOW', 'Escriba Debajo');

// javascript messages
define('JS_ERROR', 'Hay errores en su formulario!\nPor favor, haga las siguientes correciones:\n\n');

define('JS_REVIEW_TEXT', '* Su \'Comentario\' debe tener al menos ' . REVIEW_TEXT_MIN_LENGTH . ' letras.\n');
define('JS_REVIEW_RATING', '* Debe evaluar el producto sobre el que opina.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor seleccione un m&eacute;todo de pago para su pedido.\n');

define('JS_ERROR_SUBMITTED', 'Ya ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor seleccione un m&eacute;todo de pago para su pedido.');

define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Direcci&oacute;n');
define('CATEGORY_CONTACT', 'Contacto');
define('CATEGORY_OPTIONS', 'Opciones');
define('CATEGORY_PASSWORD', 'Contrase&ntilde;a');

define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', 'Por favor seleccione una opci&oacute;n.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', 'Su Nombre debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Apellidos:');
define('ENTRY_LAST_NAME_ERROR', 'Sus apellidos deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Su fecha de nacimiento debe tener este formato: DD/MM/AAAA (p.ej. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (p.ej. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_CONFIRM', 'Confirmar la dirección de correo electrónico:');
define('ENTRY_EMAIL_ADDRESS_CONFIRM_ERROR', 'La confirmación de la dirección de correo electrónico es diferente de su dirección de correo electrónico.');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Su direcci&oacute;n de E-Mail debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Su direcci&oacute;n de E-Mail no parece v&aacute;lida - por favor haga los cambios necesarios.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Su direcci&oacute;n de E-Mail ya figura entre nuestros clientes - puede entrar a su cuenta con esta direcci&oacute;n o crear una cuenta nueva con una direcci&oacute;n diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_EMAIL_ADDRESS_CONFIRM_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Direcci&oacute;n:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Su direcci&oacute;n debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Suburbio');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_DIGICODE', 'Código de acceso :');
define('ENTRY_DIGICODE_TEXT', '');
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:');
define('ENTRY_POST_CODE_ERROR', 'Su c&oacute;digo postal debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.');
define('ENTRY_POST_CODE_ERROR2', 'No entregamos en el DOM-TOM.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Poblacion:');
define('ENTRY_CITY_ERROR', 'Su poblaci&oacute;n debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Provincia/Estado:');
define('ENTRY_STATE_ERROR', 'Su provincia/estado debe tener al menos ' . ENTRY_STATE_MIN_LENGTH . ' letras.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor seleccione de la lista desplegable.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Pa&iacute;s:');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un pa&iacute;s de la lista desplegable.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Tel&eacute;fono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Su n&uacute;mero de tel&eacute;fono debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Bolet&iacute;n de noticias:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'suscribirse');
define('ENTRY_NEWSLETTER_NO', 'no suscribirse');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Contrase&ntilde;a:');
define('ENTRY_PASSWORD_ERROR', 'Su contrase&ntilde;a debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La confirmaci&oacute;n de la contrase&ntilde;a debe ser igual a la contrase&ntilde;a.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirme Contrase&ntilde;a:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Contrase&ntilde;a Actual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Su contrase&ntilde;a debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_NEW', 'Nueva Contrase&ntilde;a:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Su contrase&ntilde;a nueva debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La confirmaci&oacute;n de su contrase&ntilde;a debe coincidir con su contrase&ntilde;a nueva.');
define('PASSWORD_HIDDEN', '--OCULTO--');

define('FORM_REQUIRED_INFORMATION', '* Dato Obligatorio');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P&aacute;ginas de Resultados:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos nuevos)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del<b>%d</b> al <b>%d</b> (de <b>%d</b> ofertas)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Principio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'P&aacute;gina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d P&aacute;ginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Siguientes %d P&aacute;ginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRINCIPIO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Siguiente&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'A&ntilde;adir Direcci&oacute;n');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Direcciones');
define('IMAGE_BUTTON_BACK', 'Volver');
define('IMAGE_BUTTON_BUY_NOW', 'Compre Ahora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambiar Direcci&oacute;n');
define('IMAGE_BUTTON_CHECKOUT', 'Realizar Pedido');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar Pedido');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Seguir Comprando');
define('IMAGE_BUTTON_DELETE', 'Eliminar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Cuenta');
define('IMAGE_BUTTON_HISTORY', 'Historial de Pedidos');
define('IMAGE_BUTTON_LOGIN', 'Entrar');
define('IMAGE_BUTTON_IN_CART', 'A&ntilde;adir a la Cesta');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaciones');
define('IMAGE_BUTTON_QUICK_FIND', 'B&uacute;squeda R&aacute;pida');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Eliminar Notificaciones');
define('IMAGE_BUTTON_REVIEWS', 'Comentarios');
define('IMAGE_BUTTON_SEARCH', 'Buscar');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opciones de Env&iacute;o');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'D&iacute;selo a un Amigo');
define('IMAGE_BUTTON_UPDATE', 'Actualizar');
define('IMAGE_BUTTON_UPDATE_CART', 'Actualizar Cesta');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escribir Comentario');

define('SMALL_IMAGE_BUTTON_DELETE', 'Eliminar');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modificar');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver');

define('ICON_ARROW_RIGHT', 'm&aacute;s');
define('ICON_CART', 'En Cesta');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Correcto');
define('ICON_WARNING', 'Advertencia');

define('TEXT_GREETING_PERSONAL', 'Bienvenido de nuevo <span class="greetUser">%s!</span> &iquest;Le gustaria ver que <a href="%s"><u>nuevos productos</u></a> hay disponibles?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Si no es %s, por favor <a href="%s"><u>entre aqui</u></a> e introduzca sus datos.</small>');
define('TEXT_GREETING_GUEST', 'Bienvenido <span class="greetUser">Invitado!</span> &iquest;Le gustaria <a href="%s"><u>entrar en su cuenta</u></a> o preferiria <a href="%s"><u>crear una cuenta nueva</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Ordenar Productos ');
define('TEXT_DESCENDINGLY', 'Descendentemente');
define('TEXT_ASCENDINGLY', 'Ascendentemente');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palabras');
define('TEXT_REVIEW_RATING', 'Evaluaci&oacute;n: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Fecha Alta: %s');
define('TEXT_NO_REVIEWS', 'En este momento, no hay ningun comentario.');

define('TEXT_NO_NEW_PRODUCTS', 'Ahora mismo no hay novedades.');

define('TEXT_UNKNOWN_TAX_RATE', 'Impuesto desconocido');

define('TEXT_REQUIRED', '<span class="errorText">Obligatorio</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> No he podido enviar el email con el servidor SMTP especificado. Configura tu servidor SMTP en la secci&oacute;n adecuada del fichero php.ini.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Advertencia: El directorio de instalaci&oacute;n existe en: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Por razones de seguridad, elimine este directorio completamente.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Advertencia: Puedo escribir en el fichero de configuraci&oacute;n: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. En determinadas circunstancias esto puede suponer un riesgo - por favor corriga los permisos de este fichero.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para guardar datos de sesi&oacute;n no existe: ' . tep_session_save_path() . '. Las sesiones no funcionar&aacute;n hasta que no se corriga este error.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Avertencia: No puedo escribir en el directorio para datos de sesi&oacute;n: ' . tep_session_save_path() . '. Las sesiones no funcionar&aacute;n hasta que no se corriga este error.');
define('WARNING_SESSION_AUTO_START', 'Advertencia: session.auto_start esta activado - desactive esta caracteristica en el fichero php.ini and reinicie el servidor web.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para productos descargables no existe: ' . DIR_FS_DOWNLOAD . '. Los productos descargables no funcionar&aacute;n hasta que no se corriga este error.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de caducidad de la tarjeta de cr&eacute;dito es incorrecta. Compruebe la fecha e int&eacute;ntelo de nuevo.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El n&uacute;mero de la tarjeta de cr&eacute;dito es incorrecto. Compruebe el numero e int&eacute;ntelo de nuevo.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los primeros cuatro digitos de su tarjeta son: %s. Si este n&uacute;mero es correcto, no aceptamos este tipo de tarjetas. Si es incorrecto, int&eacute;ntelo de nuevo.');

/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>');
define('Our_Best_Candles', 'Nuestras mejores velas');
define('Our_Best_P_Her', 'Los mejores perfumes para mujer');
define('Our_Best_P_Him', 'Los mejores perfumes para hombre');
define('Skin_Care', 'Los mejores tratamientos para la piel');
define('Nos_meilleurs_coffrets_w', 'Los mejores estuches para mujer');
define('Nos_meilleurs_coffrets_m', 'Los mejores estuches para hombre');
define('meilleurs_marques', 'Marcas');
define('Nos_marques', 'Nuestras Marcas');
define('minimum_order',  '<div align="center"><img src="images/wholesaleonly.jpg"></div>');
define('BOX_SHOPPING_CART_MIN_ORDER', 'Commande minimum 150€');
define('HEADER_HELLO', 'Bienvenida');
define('HEADER_LOGIN', 'Identificación');
define('HEADER_LOGOUT', 'Desconexión');
define('CHOOSE_YOUR_CAT', 'Seleccione una categoría : ');
define('CHOOSE_YOUR_BRAND', 'Seleccione una marca : ');


define('TEXT_DISPLAY_NUMBER_OF_RANGES', 'Mostrar de <b>%d</b> a <b>%d</b> (entre <b>%d</b> gamas)');
define('TEXT_INSTEAD_OF', 'En lugar de');
define('TEXT_EN_STOCK', '<span class="en_stock">En Stock</span>');

define('MENU_HOME', 'Inicio');
define('MENU_FRAGRANCE_WOMEN', 'Perfumes Mujer');
define('MENU_FRAGRANCE_MEN', 'Perfumes Hombre');
define('MENU_ALL_BRANDS', 'Todas las marcas');
define('MENU_MY_ACCOUNT', 'Mi Cuenta');
define('MENU_CHRISTMAS', 'Especial Navidad');
define('MENU_MONTHLY', 'Especial del Mes');
define('MENU_SPONSORSHIP', 'Patrocinio');
define('MENU_CONTACT', 'Contacto');
define('MENU_FLASH', 'Venta Flash');
define('MENU_BECOME_MEMBER', 'Convertirse en un miembro');

define('OTHERS_LIST_PRODUCTS', 'Otros productos de la gama');

$tmp = array(
'Mon' => 'Lunes',
'Tue' => 'Martes',
'Wed' => 'Miércoles',
'Thu' => 'Jueves',
'Fri' => 'Viernes',
'Sat' => 'Sábado',
'Sun' => 'Domingo',
);
$tmp = $tmp[date('D')];
define('MENU_DAILY', 'Promoción '.$tmp);

define('FOR_HIM', '<span class="for_him">Para el hombre</span>');
define('FOR_HER', '<span class="for_her">Para la mujer</span>');
define('FOR_UNISEX', '<span class="for_him">Uni</span><span class="for_her">sex</span>');
define('FOR_HIM_STR', 'Para el hombre');
define('FOR_HER_STR', 'Para la mujer');
define('FOR_UNISEX_STR', 'Unisex');
define('TEXT_SAVING', 'Salvar ');

define('PRICE_TIMER', 1.33);

//Cartes membres
define('CARD_NAME_CARD1', 'Suscripción 6 meses');
define('CARD_DESC_CARD1', 'Tienda a un costo de 6 meses!');
define('CARD_NAME_CARD2', 'Suscripción 3 meses');
define('CARD_DESC_CARD2', 'Tienda a un costo de 3 meses!');
define('CARD_NAME_CARD3', 'Suscripción 12 meses');
define('CARD_DESC_CARD3', 'Tarjeta válida por 12 meses!');

define('FREE_SHIPPING_TITLE', 'Detalle');
define('FREE_SHIPPING_DESCRIPTION', 'Presente proceso');

define('ABOUT_US_TITLE', '¿Quiénes somos?');
define('IMAGE_BUTTON_TWO_PRODUCTS_MINIMUM', 'Por lo menos dos productos');

define('MENU_TESTIMONY', 'Testimonios');
define('MENU_CONCEPT', 'Concepto');
define('MENU_SAVINGS', 'Sus ahorros');
define('MENU_FAQ', 'FAQ');
define('MENU_ADVANTAGES', 'Nuestras ventajas');
define('MENU_PRESSE', 'Toda la prensa habla');

define('MEMBER_PRICE', 'Precios miembros : ');

define('ERROR_TOO_FEW_ITEMS1', 'Por favor, añadir un producto a su carrito con el fin de validar su pedido.');
define('ERROR_TOO_FEW_ITEMS2', 'Por favor, añada dos productos en su carrito con el fin de validar su pedido.');

define('SUB_TITLE_SUB_SPECIAL_DISCOUNT', 'Promoción en julio:');
define('SPECIAL_DISCOUNT', get_promo('text').'<br />(fuera de borda)');
define('SPECIAL_DISCOUNT_PAYPAL', get_promo('text').' (fuera de borda)');

define('TEXT_MAIN_MEMBER', 'Para ser miembro de '.STORE_NAME.' y disfrutar de los beneficios del Club, simplemente elegir entre las opciones de nuestra suscripción:');
define('MEMBER_CARD1', '<span class="bigger">- <span class="blue bold">Miembro  SAPHIR</span> : Tarjeta de membresía (válido para '.$cards->list['card1']['duration'].' meses) : <span class="red bold">'.$currencies->format($cards->list['card1']['price']).'</span></span>');
define('MEMBER_CARD2', '<span class="bigger">- <span class="red">Miembro RUBIS</span> : Tarjeta de membresía '.$cards->list['card2']['duration'].' meses : <span class="red bold">'.$currencies->format($cards->list['card2']['price']).'</span> (<span class="bold">Ahorro de 50%</span>)</span>');
define('MEMBER_CARD3', '<span class="bigger">- <span class="gold bold">Miembro GOLD</span> : Tarjeta de membresía (válido para '.$cards->list['card3']['duration'].' meses) : <span class="red bold">'.$currencies->format($cards->list['card3']['price']).'</span> <span class="bold small">('.$currencies->format(floor($cards->list['card3']['price'] / 12)).' meses)</span></span>');
define('MEMBER_CARD31', '<span class="bold small">(Ahorro de 80%)</span>');
define('TEXT_END', '<center><span class="bold">No es necesario comprar</span><center>');

define('MENU_BONS_PLANS', 'Ofertas destacadas');
define('MENU_SELECTION', 'Ofertas Especiales');
define('ALREADY_MEMBER', 'Usted ya es miembro.');
define('ALREADY_HAVE_CARD', 'Usted ya tiene una tarjeta en su cesta.');
define('YOUR_PROMO_CODE', 'Su código de promoción');

define('PRODUCTS_NOT_TOGETHER1', 'En primer lugar, debe convertirse en un miembro antes de que usted puede comprar.');
define('PRODUCTS_NOT_TOGETHER2', 'No se puede comprar las tarjetas en el mismo tiempo que los productos');

define('BOX_INFORMATION_HOW_TO_ORDER', 'Cómo hacer un pedido?');

define('ERROR_MAX_DAILY_LIMIT', 'Sólo se pueden pedir '.(isset($is_member) && $is_member ? MAX_DAILY_LIMIT : MAX_DAILY_LIMIT_NOT_MEMBER).' productos al día');
define('ERROR_MAX_WEEKLY_LIMIT', 'Usted puede ordenar por '.MAX_WEEKLY_LIMIT.'€ por semana');

define('REDUCED_PRICE', 'Precio: ');

define('CONCEPT_INTRO','');
define('PAYEMENT_100_SECURE', 'Pago 100% seguro');
define('OUR_MARQUES','Nuestra marca');
?>
