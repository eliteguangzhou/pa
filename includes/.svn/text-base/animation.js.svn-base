var timer = 1000;
var fast = 200;
var wait = 3000;
var nb = 4;
var cpt = 0;
var power = 20;
function fadeOut(id) {$('#'+id).fadeOut(timer/2, function callback() {fadeIn(id)})}
function fadeIn(id) {$('#'+id).fadeIn(timer/2, function callback() {setTimeout('fadeOut("'+id+'")', wait/6)})}

function slidevIn(id, val) {$('#'+id).animate({
        height: val+"px",
        marginTop: "0px"
      }, timer, function callback() {setTimeout('slidevOut("'+id+'", '+val+')', wait)})}

function slidevOut(id,val) {$('#'+id).animate({
        height: "0%",
        marginTop: Math.floor(val/2)+"px"
      }, timer, function callback() {slidevIn(id, val)})}

function slidehIn(id, val) {$('#'+id).animate({
        width: val+"px",
        marginLeft: "0px"
      }, timer, function callback() {setTimeout('slidehOut("'+id+'", '+val+')', wait)})}

function slidehOut(id, val) {$('#'+id).animate({
        width: "0%",
        marginLeft: Math.floor(val/2)+"px"
      }, timer, function callback() {slidehIn(id, val)})}

function slidehvIn(id, w, h) {$('#'+id).animate({
        height: h+"px",
        width: w+"px",
        marginLeft: "0px",
        marginTop: "0px"
      }, timer, function callback() {setTimeout('slidehvOut("'+id+'", '+w+', '+h+')', wait)})}

function slidehvOut(id, w, h) {$('#'+id).animate({
        height: "0%",
        width: "0%",
        marginLeft: Math.floor(w/2)+"px",
        marginTop: Math.floor(h/2)+"px"
      }, timer, function callback() {slidehvIn(id, w, h)})}

function blink(id) {$('#'+id).fadeOut(fast).fadeIn(fast, function callback() {if(cpt%nb == 0) setTimeout('blink("'+id+'")', wait); else blink(id); cpt++;})}

function shakeh(id) {$('#'+id).animate({marginLeft:"-"+power+"px"},fast).animate({marginLeft:power+"px"},fast, function callback() {if(cpt%nb == 0) {$('#'+id).animate({marginLeft:"0px"},fast/2);setTimeout('shakeh("'+id+'")', wait);} else shakeh(id); cpt++;})}

function shakev(id) {$('#'+id).animate({marginTop:"-"+power+"px"},fast).animate({marginTop:power+"px"},fast, function callback() {if(cpt%nb == 0) {$('#'+id).animate({marginTop:"0px"},fast/2);setTimeout('shakev("'+id+'")', wait);} else shakev(id); cpt++;})}

var colors = ['blue', 'green', 'red'];
window.c_color = 0;
var color_timer = 500;
function change_color() {if ($('#new_discount')) {window.c_color = window.c_color == 2 ? 0 : window.c_color + 1; $('#new_discount').attr('style', 'color:'+colors[window.c_color]+';');setTimeout('change_color()', color_timer);}}

function decount_timer(){
    if ($('.time_left')) {
        $('.time_left').each(function(){
            if (($(this).html()).indexOf(':') > 0) {
                var str = $(this).html();
                str = str.split(':');
                str[0] = parseInt(str[0], 10);
                str[1] = parseInt(str[1], 10);
                str[2] = parseInt(str[2], 10);

                //Seconds min
                str[2]--;
                if (str[2] < 0) {
                    str[2] = 59;
                    str[1]--;
                }
                if (str[1] < 0) {
                    str[1] = 59;
                    str[0]--;
                }
                if (str[0] < 0)
                    window.location.reload();

                $(this).html((str[0] < 10 ? '0' + str[0] : str[0])+':'+(str[1] < 10 ? '0' + str[1] : str[1])+':'+(str[2] < 10 ? '0' + str[2] : str[2]));
            }
        });
        setTimeout('decount_timer()', 1000);
    }
}

function alternate(ids, n_img, timer) {
    var stop = false;
    var str_ids = '';
    var n_i = 0;
    for (i in ids) {
        str_ids = str_ids + ', "' +ids[i]+ '"';
        $('#'+ids[i]).attr("style", "display:none");

        if (stop == false && ids[i] == n_img) {
            $('#'+n_img).attr("style", "display:block");
            n_i = i - -1;
            n_img = typeof(ids[n_i]) == "undefined" ? ids[0] : ids[n_i];
            var stop = true;
        }
    }

    setTimeout('alternate(['+str_ids.substring(1)+'], "'+n_img+'", '+timer+')', timer);
}

$(document).ready(function() {
    var anim = [['blink'], ['fadeOut'], ['fadeOut'], ['fadeOut']];
    var id = ['right_ban', 'flash_title', 'daily_title', 'promo_nb1'];

    for (i in anim)
        window[anim[i][0]](id[i], anim[i][1], anim[i][2]);

    setTimeout('change_color()', color_timer);

    //Vente flash compte a rebours
    setTimeout('decount_timer()', 1000);

    if (typeof(c_img_p) != "undefined")
        alternate(["img_p", "img_pp"], "img_pp", 5000);

    //if (typeof(c_img_p901) != "undefined")
        //alternate(["img_p901", "img_pp901"], "img_pp901", 5000);

});