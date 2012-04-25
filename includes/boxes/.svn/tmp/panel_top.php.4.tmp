<?php
/*
  $Id: languages.php,v 1.15 2003/06/09 22:10:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/


//$cat=$current_category_id;

echo '<table cellpadding="0" cellspacing="0" border="0" width="600"><tr><td>';
/*if (empty($cat) || $cat == 901 || $cat == '38_28' || $cat == '38_27') {
    if (empty($cat)) {
        echo tep_image(DIR_WS_IMAGES.'img_centrale1.jpg', '', '', '', ' id="img_p"');
        echo tep_image(DIR_WS_IMAGES.'img_centrale2.jpg', '', '', '', ' id="img_pp" style="display:none"');
        //echo tep_image(DIR_WS_IMAGES.'img_centrale3.jpg', '', '', '', ' id="img_ppp" style="display:none"');
        echo '<script type="text/javascript">var c_img_p = true;</script>';
    }
    elseif ($cat == 901) {
        echo tep_image(DIR_WS_IMAGES.'img_centrale2.jpg', '', '', '', ' id="img_p901"');
        //echo tep_image(DIR_WS_IMAGES.'pp901.jpg', '', '', '', ' id="img_pp901" style="display:none"');
        //echo '<script type="text/javascript">var c_img_p901 = true;</script>';
    }
    else
        echo tep_image(DIR_WS_IMAGES.'p'.$cat.'.jpg');


<script src="<?php echo DIR_WS_INCLUDES;?>/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
  AC_FL_RunContent( 
'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','600','height','245','src','pa','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','pa', 
'play', 'true', 'loop', 'false' ); //end AC code
</script>
<noscript>
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="600" height="245">
    <param name="movie" value="pa.swf" />
    <param name="quality" value="high" />
    <param name="loop" value="false" />
    <embed src="pa.swf" quality="high" 
pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" 
type="application/x-shockwave-flash" width="600" height="245"></embed>
  </object>
</noscript>*/

echo '<a id="picture_sw" href="'.tep_href_link(FILENAME_ADVANTAGES).'">'.tep_image(DIR_WS_IMAGES.'ysl.jpg').'</a>';
echo '</td></tr><tr><td height="9">'.tep_draw_separator('spacer.gif', '1', '1').'</td></tr></table>';
/*}
else echo tep_draw_separator('spacer.gif', '590', '1').'</td></tr></table>';*/
?>
<?php if ($language_id = 5) { ?>
<script type="text/javascript">
$(document).ready(function () {
    window.setInterval("switch_pic()",4000);
});

function switch_pic(){
    var img;
    var path;
    var path1 ="includes/languages/french/images/ysl.jpg";
    var path2 ="includes/languages/french/images/ysl2.jpg";
    
    img = jQuery("img",$('#picture_sw'));
    path = img.attr("src");
        img.fadeOut(500);
    if (path == path1){
        img.attr("src",path2).stop(true,true).fadeIn(500);
        }
    else{
        img.attr("src",path1).stop(true,true).fadeIn(500);
        
        }
}
</script>
<?php }	?>		  

			



