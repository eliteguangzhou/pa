<?php
/*
  $Id: info_shopping_cart.php,v 1.19 2003/02/13 03:01:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require("includes/application_top.php");

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFO_SHOPPING_CART);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%; height:100%;">
  <tr>
    <td  style="width:100%; height:100%; vertical-align:middle">
		<table cellspacing="0" cellpadding="0" border="0" align="center" style="width:417px">		
			<tr>
                <td><?php echo tep_draw_separator('spacer.gif', '12', '1'); ?></td> 
                <td>
                	<table cellpadding="0" cellspacing="0" border="0" style="width:390px">
                        <tr>
                            <td>
                            	<table cellpadding="0" cellspacing="0" border="0" class="popup">
                                    <tr>
                                        <td><?php echo tep_image(DIR_WS_IMAGES.'logo1.gif')?></td>  
                                        <td style="width:100%"><a href="#" onClick="window.close()"><?php echo TEXT_CLOSE_WINDOW; ?></a></td>                                        
                                    </tr>
                                </table> 
                                <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #d9d9d9; border-bottom:none">
                                    <tr>
                                        <td>
                                            <table cellpadding="0" cellspacing="0" border="0" class="cont_heading_table">
                                                <tr><td><?php echo tep_draw_separator('spacer.gif', '18', '1'); ?></td>
                                                    <td style="width:100%" class="cont_heading_td"><?php echo HEADING_TITLE; ?></td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #FFFFFF; border-width:0 10px 24px 18px">
                                                <tr>
                                                    <td>
                                                        <strong><?php echo SUB_HEADING_TITLE_1; ?></strong><br><?php echo SUB_HEADING_TEXT_1; ?>
<br><br style="line-height:21px">
<strong><?php echo SUB_HEADING_TITLE_2; ?></strong><br><?php echo SUB_HEADING_TEXT_2; ?>
<br><br style="line-height:21px">

<strong><?php echo SUB_HEADING_TITLE_3; ?></strong><br><?php echo SUB_HEADING_TEXT_3; ?>
  
                                                    </td>
                                                </tr>
                                            </table> 
                                        </td>
                                    </tr>
                                </table> 
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td><?php echo tep_image(DIR_WS_IMAGES.'cont_body_corn_bl.gif')?></td>
                                        <td width="100%" class="cont_body_tall_b"><?php echo tep_draw_separator('spacer.gif', '1', '1'); ?></td>
                                        <td><?php echo tep_image(DIR_WS_IMAGES.'cont_body_corn_br.gif')?></td>
                                    </tr>
                                </table>  
                                <table cellpadding="0" cellspacing="0" border="0" style="height:57px " class="footer">
                                    <tr>
                                        <td class="vam"><?php echo tep_draw_separator('spacer.gif', '20', '1'); ?> <?php echo FOOTER_TEXT_BODY?></td>
                                    </tr>
                                </table> 
                            </td>
                        </tr>
                    </table> 
                </td> 
                <td><?php echo tep_draw_separator('spacer.gif', '15', '1'); ?></td>                
			</tr>
		</table>	
	</td>
  </tr>
</table>	

</body>
</html>
<?php
  require("includes/counter.php");
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
