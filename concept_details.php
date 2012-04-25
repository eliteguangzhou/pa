<?php

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

$choice = (int) $_GET['p'];

if (in_array($choice, array_keys($files)))
    switch ($files[$choice][1]) {
        case 'swf' :
?>
<script src="includes/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','600','height','274','src','<?php echo $files[$choice][2];?>','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','video/<?php echo $files[$choice][2];?>' ); //end AC code
</script>
<noscript>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="600" height="274">
  <param name="movie" value="video/<?php echo $files[$choice][2];?>.swf" />
  <param name="quality" value="high" />
  <embed src="video/<?php echo $files[$choice][2];?>.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="600" height="274"></embed>
</object>
</noscript>

<?php
            break;
        
        case 'img' :
            echo '<img src="video/'.$files[$choice][2].'" alt="'.$files[$choice][2].'">';
            break;
    }
?>