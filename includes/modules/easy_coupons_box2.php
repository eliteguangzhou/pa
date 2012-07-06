<?php /*  Released under the GNU General Public License */
if ($ec_active) {
?>
<form id="form_couponcode" action="<?php echo tep_href_link(FILENAME_SHOPPING_CART)?>" method="POST">
<table cellspacing="0" cellpadding="0" id="ec_coupon">
  <tr>
   <td width="100%" align="center">
    <table class="bordergray" width="100%" style=" ">
     <tr>
        <td align="right" style="padding-right: 20px;color:#FF92FF;font-size:18px;">
            <?php echo YOUR_PROMO_CODE;?>
        </td>
     </tr>
     <tr>
        <td align="right" style="padding-right: 20px;" class="ec_input">
          <?php
            echo tep_draw_input_field('coupon_code', '', ' size="'.($ec_clth+5).'"  maxlength="'.$ec_clth.'" class="inputbox" id="couponcode" ', 'text', false);
          ?>
        </td>
     </tr>
     <tr>
        <td align="right" style="padding-right: 20px;">
          <?php
            echo ' ' .tep_hide_session_id() . tep_image_submit('button_reduction.gif', 'OK', ' name="confirm" ');
          ?>
        </td>
     </tr>
    </table>
   </td>
  </tr>
</table>
</form>
<?php } ?>