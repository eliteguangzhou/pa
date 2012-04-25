<?php
/*
  $Id: manufacturers.php,v 1.19 2003/06/09 22:17:13 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
$var =array(array('text'=>" r"));
//new infoBoxHeading3($var, false, false);
//new infoBox($var);
?>
<tr><td align="center" class="aerer2">
<!--  <table border="0" width="100%" cellspacing="0" cellpadding="0" class="box_heading_table_3">
  <tbody><tr>
    <td><img src="includes/languages/french/images/box_corn_l_3.gif" border="0" alt="" width="21" height="24"></td>
    <td style="width:100%;" class="box_heading_td_3"></td>
    <td><img src="includes/languages/french/images/box_corn_r_3.gif" border="0" alt="" width="13" height="24"></td>
  </tr>
</tbody></table>-->
    <tbody style="background:black;">
    <tr height="24" style="background:black;">
        <td>
        </td>
    </tr>
    <tr>
        <td id="title_newsletter_box">
            Newsletter
        </td>
    </tr>
    <tr>
        <td id="promo_newsletter_box" style="">
            <?php echo NEWSLETTER_CODE_PROMO; ?>
        </td>
    </tr>
    <tr>
        <td id="input_newsletter_box" style="">
            <input style="" id="email_field"/>
        </td>
    </tr>
    <tr>
        <td id="submit_newsletter_box" style="">
            <input onClick="insert_email();" style="border-radius: 10px;padding-left:10px;padding-right:10px" type="button" value="<?php echo NEWSLETTER_INSCRIPTION; ?>"/>
        </td>
    </tr>
    <tr>
        <td id="newsletter_message" style="">
        </td>
    </td>

<tbody>
</td></tr>
        <script >
        //email verification
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};

    function insert_email(){
    var email;
    email = $("#email_field").val();
     if (email == "")
        $("#newsletter_message").html('<?php echo NEWSLETTER_EMPTY_FIELD;?>');
    else if (!isValidEmailAddress(email))
        $("#newsletter_message").html('<?php echo NEWSLETTER_NOVALID_FIELD;?>');
    else
    $.ajax({type:"GET", url:"insert_email.php", data:{"email":email}, cache:false, timeout:10000,
               success: function() {
                    $("#email_field").val('<?php echo NEWSLETTER_THANK;?>');
            },
                error: function() {
                    $("#newsletter_message").html('<?php //echo NEWSLETTER_RETURN_ERROR;?>');
            },
            complete: function() {
                    //disablePopup();
            }
         });
    }
    </script>