<tr>
	<td>
		<table border="0" width="179px" cellspacing="0" cellpadding="0"
			class="box_heading_table_2">
			<tbody>
				<tr>
					<td><img src="includes/languages/french/images/box_corn_lROSE.gif"
						border="0" alt="" width="21" height="24">
					</td>
					<td style="width: 179px" class="box_heading_td_2">Nos marques</td>
					<td><img src="includes/languages/french/images/box_corn_rROSE.gif"
						border="0" alt="" width="11" height="24">
					</td>
				</tr>
			</tbody>
		</table></td>
</tr>
<tr>
<td>

<?php
$links = array(
    1=>'/2863-versace.html',
    2=>'/588-thierry mugler.html',
    3=>'/362-lolita.html',
    4=>'/336-lacost.html',
    5=>'/293-jean paul gaultier.html',
    6=>'/245-lucci.html',
    7=>'/200-fendi.html',
    8=>'/166-dg.html',
    9=>'/114-cartier.html',
    10=>'/92-cacharel.html',
    11=>'/83-bvlgari.html',
    12=>'/82-burberry.html',
    13=>'/264-boss.html',
    14=>'/53-azzaro.html',
    15=>'/341-lanvin.html'
);
?>
<div id="partnair_cont_sup">
    <div id="partnair_cont">
    <?php
    $html ='';
    for ($i = 1;$i < 16;$i++){
        $html .= '<div  style=position:relative;height:69px" id="picture'.$i.'" class="picture_partnaire"><a href="'.$links[$i].'"><img src="images/partnair/logoo_'.$i.'.jpg" ></a></div>';
    } 
    echo $html; 
    ?>
    </div>
</div>
</tr></td>

<script type="text/javascript">
  
var current = 1;
var html = '<?php echo $html;?>';

function move_partnair(){
    if (current == 1)
        after = 15;
    else
        after = current-1;
    move = current;
  $('#picture'+current).animate({'marginTop':-69},1000,function (){
  
    $('#picture'+after).after($('#picture'+move));
     $('#picture'+move).animate({'marginTop':0});
  });
   current++;
    if (current == 16)
        current = 1;
}


$(document).ready(function () {
  window.setInterval("move_partnair()",2000);
});

</script>