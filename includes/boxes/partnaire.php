<tr>


<td align="center">
  <table border="0" width="100%" cellspacing="0" cellpadding="0" class="box_heading_table_3">
  <tbody><tr>
<!--     <td><img src="includes/languages/french/images/box_corn_l_3.gif" border="0" alt="" width="11" height="30" style="background:white;"></td> -->
    <td style="width:100%;" class="box_heading_td_3"><?php echo OUR_MARQUES;?></td>
<!--     <td><img src="includes/languages/french/images/box_corn_r_3.gif" border="0" alt="" width="11" height="30" style="background:white;"></td> -->
  </tr>
</tbody></table>
    </td>
</tr>
<tr>
<td>

<?php
$links = array(
    1=>'?manufacturers_id=2863',
    2=>'?manufacturers_id=588',
    3=>'?manufacturers_id=362',
    4=>'?manufacturers_id=336',
    5=>'?manufacturers_id=293',
    6=>'?manufacturers_id=245',
    7=>'?manufacturers_id=200',
    8=>'?manufacturers_id=166',
    9=>'?manufacturers_id=114',
    10=>'?manufacturers_id=92',
    11=>'?manufacturers_id=83',
    12=>'?manufacturers_id=82',
    13=>'?manufacturers_id=264',
    14=>'?manufacturers_id=53',
    15=>'?manufacturers_id=341'
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
    console.log(after+'et'+move+'c='+current);
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