<?php
/*
  $Id: column_left.php,v 1.15 2003/07/01 14:34:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<table border="0"cellspacing="0" cellpadding="0">
	<tr><td>
		<table border="0" cellspacing="0" cellpadding="0" class="box_width_left">
<tr>
		<td width="100%">
			<table border="0" cellspacing="0" cellpadding="0">
    <?php /*<tr>
        <td>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="box_heading_table">
                <tr>
                    <td class="box_heading_td" style="width: 100%;">
                        <?php echo ABOUT_US_TITLE;
                    </td>
                </tr>
            </table>
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="box_body_table" style="margin-bottom: 10px;">
                            <tr>
                                <td class="box_body box_body_td">
                                    <script src="<?php echo DIR_WS_INCLUDES;AC_RunActiveContent.js" type="text/javascript"></script>
                                    <script type="text/javascript">
                                        AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','262','height','274','src','test2','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','video/test2' ); //end AC code
                                    </script>
                                    <noscript>
                                    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="262" height="274">
                                        <param name="movie" value="video/test2.swf" />
                                        <param name="quality" value="high" />
                                        <embed src="video/test2.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="262" height="274"></embed>
                                    </object>
                                    </noscript>
                                </td>
                            </tr>
                            <tr>
                                <td><img width="179" height="9" border="0" alt="" src="includes/languages/french/images/line.gif"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>*/?>

<?php
  //--------------Affichage des categories

    if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');
  }



 //--------------Fin affichage des categories

// -------------------------------------------------
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_manufacturers_box();
  } else {
    include(DIR_WS_BOXES . 'manufacturers.php');
  }
// ----------Fin Affichage manufacturers

  //--------- Affichage BESTSELLING
      include(DIR_WS_BOXES . 'bestselling.php');

// ----------Fin Affichage BESTSELLING
  if (isset($HTTP_GET_VARS['products_id'])) {
    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {
        include(DIR_WS_BOXES . 'best_sellers.php');
      } else {
     include(DIR_WS_BOXES . 'product_notifications.php');
      }
    } else {
      include(DIR_WS_BOXES . 'product_notifications.php');
    }
  } else {
    include(DIR_WS_BOXES . 'best_sellers.php');
  }

// -------------------------------------------------
  if (isset($HTTP_GET_VARS['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(DIR_WS_BOXES . 'tell_a_friend.php');
  } else {
    //include(DIR_WS_BOXES . 'specials.php');
  }
  if ($check_server == 'fr') {
?>
				<tr><td align="center" class="aerer2"><?php echo tep_image(DIR_WS_IMAGES.'PAYPALSECURE.jpg')?></td></tr>
				                  <tr><td align="center" class="aerer2"><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/LogoColissimo.png', 'kelkoo'); ?></td></tr>
               <?php } ?>
                <tr><td align="center" class="aerer2"><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/part_shopping.gif', 'shopping'); ?></td></tr>
                  <tr><td align="center" class="aerer2"><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/part_ciao.gif', 'ciao'); ?></td></tr>
                  <tr><td align="center" class="aerer2"><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/part_kelkoo.gif', 'kelkoo'); ?></td></tr>
               
			</table>
		</td>
	</tr>
		</table>
	</td>
	<td><?php echo tep_draw_separator('spacer.gif', '9', '1'); ?></td>
