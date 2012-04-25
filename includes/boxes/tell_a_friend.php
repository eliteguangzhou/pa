<?php
/*
  $Id: tell_a_friend.php,v 1.16 2003/06/10 18:26:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_TELL_A_FRIEND);

  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('form' => tep_draw_form('tell_a_friend', tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get'),
                               'align' => 'center',
                               'text' => '
						
						<table cellpadding="0" cellspacing="4" border="0" class="" style="height:3px;">
							<tr><td style="width:100%;vertical-align:middle;">
								'.tep_draw_input_field('to_email_address', '', 'size="10" style=" width:100%;"')   . '</td><td class="bg_input">
								' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . tep_draw_hidden_field('products_id', $HTTP_GET_VARS['products_id']) . tep_hide_session_id() . '
							</td></tr>
							<tr><td colspan="2">'. BOX_TELL_A_FRIEND_TEXT.'</td></tr>
						</table>							   
						');

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- tell_a_friend_eof //-->
