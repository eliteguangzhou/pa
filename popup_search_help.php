<?php
/*
  $Id: popup_search_help.php,v 1.4 2003/06/05 23:26:23 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
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
                                                    <td style="width:100%" class="cont_heading_td"><?php echo HEADING_SEARCH_HELP?></td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" style="border:1px solid #FFFFFF; border-width:0 10px 24px 18px">
                                                <tr>
                                                    <td><?php echo TEXT_SEARCH_HELP?></td>
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
<?php require('includes/application_bottom.php'); ?>
