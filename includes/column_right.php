<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<table border="0"cellspacing="0" cellpadding="0" class="box_width_right"><tr>
	<td><?php echo tep_draw_separator('spacer.gif', '9', '1'); ?></td>
   
 <!--------promo------->
</tr><tr>
<td>
 <script src="includes//AC_RunActiveContent.js" type="text/javascript"></script>
            <script type="text/javascript">
              AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','180','height','149','src','100','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','100', 'play', 'true', 'loop', 'true' ); //end AC code
            </script>
<noscript>
              &lt;object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="180" height="149"&gt;
                &lt;param name="movie" value="100.swf" /&gt;
                &lt;param name="quality" value="high" /&gt;
                &lt;param name="loop" value="true" /&gt;
                &lt;param name="play" value="true" /&gt;
                &lt;embed src="100.swf" quality="high" play="true" loop="true" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="600" height="352"&gt;&lt;/embed&gt;
              &lt;/object&gt;
            </noscript> 
</td></tr>
<tr>
<td style="padding-bottom: 12px;"></td>
</tr>
<!-------promo end-------->
   <?php
/*
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');
  }*/
  echo '<td>';
  require('principalgauche.php');
  if (isset($HTTP_GET_VARS['letter'])) {$lettre=$HTTP_GET_VARS['letter'];

}else{
$lettre="A";
}
  bestmarque($current_category_id,$lettre);
  statiquebestproducts($current_category_id);
    echo '</tr></td>';
// -------------------------------------------------
  require(DIR_WS_BOXES . 'information.php');

 /*<tr><td><a href="<?php echo tep_href_link('specials.php')?>"><?php echo tep_image(DIR_WS_IMAGES.'bann1.jpg')?></a></td></tr> */
?>

<!-- logo partenaire -->
<?php include(DIR_WS_BOXES . 'partnaire.php'); ?>
<!-- end logo partenaire -->

<!-------------Newsletter -->
<?php if ($languages_id == 5) : 
    include(DIR_WS_BOXES . 'newsletter.php');
endif;?>

<!------------Newsletter  END-->
</table>
	</td>
	<td><?php echo tep_draw_separator('spacer.gif', '9', '1'); ?></td></tr>
</table>

