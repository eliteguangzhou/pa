<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<table border="0"cellspacing="0" cellpadding="0" class="box_width_right">
	<tr><td><?php echo tep_draw_separator('spacer.gif', '9', '1'); ?></td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">
			
			
			
<!--------promo------->


<tr><td><a href="presentation.php">
 <script src="includes//AC_RunActiveContent.js" type="text/javascript"></script>
            <script type="text/javascript">
              AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','179','height','149','src','100','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','100', 'play', 'true', 'loop', 'true' ); //end AC code
            </script>
<noscript>
              &lt;object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="179" height="149"&gt;
                &lt;param name="movie" value="100.swf" /&gt;
                &lt;param name="quality" value="high" /&gt;
                &lt;param name="loop" value="true" /&gt;
                &lt;param name="play" value="true" /&gt;
                &lt;embed src="100.swf" quality="high" play="true" loop="true" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="600" height="352"&gt;&lt;/embed&gt;
              &lt;/object&gt;
            </noscript> 
            </a>
</td></tr>
<tr>
<td style="padding-bottom: 12px;"></td>
</tr>
<!-------promo end-------->
			
<?php
  //--------------Affichage des categories
  
    if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'best_manufacturers.php');
  }
  
  
  
 //--------------Fin affichage des categories 

// -------------------------------------------------
 require(DIR_WS_BOXES . 'information.php'); 
?>
 
<!-- logo partenaire -->
<?php  include(DIR_WS_BOXES . 'partnaire.php'); ?>
<!-- end logo partenaire -->

<!-------------Newsletter -->
<?php if ($languages_id == 5) : 
    include(DIR_WS_BOXES . 'newsletter.php');
endif;?>

<!------------Newsletter  END-->

			</table>
		</td>
	</tr>
</table>

