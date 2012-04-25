<?php
/*
  $Id: specials.php,v 1.49 2003/06/09 22:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONCEPT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONCEPT));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->
    <td width="100%" class="col_center christmas">

<?php tep_draw_heading_top(901);?>

<?php tep_draw_heading_top_3();?>

<br><?php echo CONCEPT_INTRO;?><br>

<?php
$files = array();
if ($check_server == 'fr')
	$files = array (
		//vignette, type, nom flash, chemin
		array('au_feminin.jpg', 'img', 'au_feminin.jpg'),
		array('20_minutes.jpg', 'img', '20_minutes.jpg'),
		array('chemise.jpg', 'img', 'chemise.jpg'),
		array('femina.jpg', 'img', 'femina.jpg'),
		array('figaro.jpg', 'img', 'figaro.jpg'),
		array('le_monde.jpg', 'img', 'le_monde.jpg'),
		array('le_parisien.jpg', 'img', 'le_parisien.jpg'),
		array('objectif.jpg', 'img', 'objectif.jpg'),
		array('hifi.jpg', 'img', 'hifi.jpg'),
		array('capitale.jpg', 'img', 'capitale.jpg'),
	);
$i = 0;
echo '<table cellpadding="0" cellspacing="0" style="margin-top:10px;">';
foreach ($files as $index => $info) {
    if ($i == 0)
        echo '<tr>';
        
    echo '<td align="center" valign="middle">
            <a href="#" onclick="popupWindow(\''.tep_href_link(FILENAME_CONCEPT_DETAILS, 'p='.$index).'\');return false;">
                '.tep_image('video/'.$info[0], $info[2], 250).'
            </a>
        </td>';

    if ($i >= 1) {
        echo '</tr>';
        $i = 0;
    }
    else
        $i++;
}

if ($i != 0) {
    while($i-- != 0)
        echo '<td></td>';
    echo '</tr>';
}

echo '</table>';
?>
<?php tep_draw_heading_bottom_3();?>

<?php tep_draw_heading_bottom();?>

	</td>
<!-- body_text_eof //-->
    <td class="col_right">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
