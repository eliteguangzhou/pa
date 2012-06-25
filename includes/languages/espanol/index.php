<?php
/*
  $Id: index.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('TEXT_MAIN', 'Esta es la configuraci&oacute;n por defecto de osCommerce, los productos mostrados aqui son &uacute;nicamente para demonstraci&oacute;n, <b>cualquier compra realizada no ser&aacute; entregada al cliente, ni se le cobrar&aacute;</b>. Cualquier informaci&oacute;n que vea sobre estos productos debe ser tratada como ficticia.<br><br>Si desea descargar la soluci&oacute;n que hace posible esta tienda, o si quiere contribuir al proyecto de osCommerce, por favor visite <a href="http://www.oscommerce.com" target="_blank"><u>la web de soporte de osCommerce</u></a>. Esta tienda corre bajo la version <font color="#f0000"><b>' . PROJECT_VERSION . '</b></font>.<br><br>Este texto se puede cambiar editando el siguiente fichero, uno por cada idioma: [camino&nbsp;al&nbsp;cat&aacute;logo]/includes/languages/[language]/default.php.<br><br>Puede editarlo manualmente, o a traves de la Herramienta de Administraci&oacute;n con la opci&oacute;n Idiomas->[idioma]->Definir, o utilizando el Herramientas->Administrador de Ficheros.');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuevos Productos En %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Pr&oacute;ximamente');
define('TABLE_HEADING_DATE_EXPECTED', 'Lanzamiento');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'A ver que tenemos aqui');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Productos');
  define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
  define('TABLE_HEADING_QUANTITY', 'Cantidad');
  define('TABLE_HEADING_PRICE', 'Precio');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Compre Ahora');
  define('TEXT_NO_PRODUCTS', 'No hay productos en esta categoria.');
  define('TEXT_NO_PRODUCTS2', 'No hay productos de este fabricante.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'N&uacute;mero de Productos: ');
  define('TEXT_SHOW', '<b>Mostrar:</b>');
  define('TEXT_BUY', 'Compre 1 \'');
  define('TEXT_NOW', '\' ahora');
  define('TEXT_ALL_CATEGORIES', 'Todas');
  define('TEXT_ALL_MANUFACTURERS', 'Todos');
  define('TEXT_PRICE_FROM', 'desde');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Novedades...');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorias');
}

define('NEW_INTRO','<h2 style="font-size:17px;margin-bottom:10px;"><b>Perfumes DESCUENTO</b></h2>
Bienvenido al Reino de los secretos de los perfumes !

Paseo por el perfume de las marcas <span class="text_rose">más baratas !</span>
No compre sin comparar más !<span class="text_rose"> Le devolveremos la diferencia !</span>

« <a class="text_rose" href="'.tep_href_link(FILENAME_ADVANTAGES).'">Descubra nuestras ventajas</a> »

- <span class="text_rose">20000 fragancias y cosméticos</span> actualmente en el sitio
- 500 marcas fue -40%, -50%, -70%
- 3 €, 8 €, <span class="text_rose">15 € reducción </span> ofrece
- <span Class="text_rose"> Envío € 3 </span> (de 2 productos)
- 1 <span regalo class="text_rose"> HUGO BOSS ofrece </span> de 2 productos en el carrito
- Todos los productos están en línea <span class="text_rose">Stock </span>
- <span class="text_rose">Satisfecho o reembolsado</span> 30 días
- Pago <span class="text_rose">secure</span>');
?>
