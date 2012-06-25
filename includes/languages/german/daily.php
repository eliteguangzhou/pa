<?php
/*
  $Id: specials.php,v 1.7 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
$tmp = array(
'Mon' => 'Montag',
'Tue' => 'Dienstag',
'Wed' => 'Mittwoch',
'Thu' => 'Donnerstag',
'Fri' => 'Freitag',
'Sat' => 'Samstag',
'Sun' => 'Sonntag',
);
$tmp = $tmp[date('D')];
define('NAVBAR_TITLE', 'Promotion '.$tmp);
define('HEADING_TITLE', 'Promotion '.$tmp.' !');
?>