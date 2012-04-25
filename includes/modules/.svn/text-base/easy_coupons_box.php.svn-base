<?php /*  Released under the GNU General Public License */
if ($ec_active && $cart->count_contents() > 0) {
?>
<br /><br />
    <table cellspacing="0" cellpadding="0" id="ec_coupon">
      <tr>
       <td width="100%" align="center">
        <table class="bordergray" width="100%">
         <tr>
          <td valign="middle" align="right" class="ec_label" nowrap>
           <?php echo EC_COUPONCODE; ?>
<script>
document.write(' <a href="javascript:session_win2();">');
</script>
<noscript>
<?php echo ' <a href="'.FILENAME_INFO_COUPON.'">';?>
</noscript>
<?php echo tep_image_button('button_about2.gif','?',' style="vertical-align: middle" class="ec_help" ') . '</a>&nbsp;'; ?>

          </td>
          <td align="center" valign="middle" nowrap class="ec_input">
          <?php
            echo tep_draw_input_field('coupon_code', '', ' size="'.($ec_clth+5).'"  maxlength="'.$ec_clth.'" class="inputbox" id="couponcode" ', 'text', false);
          ?>
          </td>
          <td align="left">
          <?php
            echo tep_hide_session_id() . tep_image_submit('button_reduction.gif', 'OK', ' name="confirm" ');
          ?>
          </td>
          <td align="left" width="50%">
          <?php
            echo $ec_reset ? tep_image_submit('button_reinit.gif', 'Réinitialiser', ' name="reset" onclick="document.getElementById(\'couponcode\').value=\'reset\';" ') : ' ';
          ?>
          </td>
         </tr>
        </table>
       </td>
      </tr>
</table>
<?php } ?>