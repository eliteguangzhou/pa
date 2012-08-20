<?php
/*
  $Id: search.php,v 1.22 2003/02/10 22:31:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- search //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_SEARCH);

  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('form' => tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get'),
                               'align' => 'center',
                               'text' => '							   
						<table cellpadding="0" cellspacing="4" border="0">
							<tr><td colspan="2" style="width:100%;vertical-align:middle;">'. tep_draw_input_field('keywords', '', 'size="10" maxlength="30"  style="height:19px; width:100%;"') . '' . tep_hide_session_id() .  '</td></tr>
							<tr><td class="bg_input">' . tep_hide_session_id() . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH,' style="float:right;vertical-align:middle;margin:0px 0px 0px 12px;"') . '' . BOX_SEARCH_TEXT . '</td></tr>
							<tr><td><em><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a></em></td></tr>
						</table>							   
						');

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- search_eof //-->
