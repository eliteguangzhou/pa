<?php
/*
  $Id: header.php,v 1.42 2003/06/10 18:20:38 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
//ini_set('date.timezone', 'Europe/Paris');
//$abbrarray = timezone_abbreviations_list();
//var_rh($abbrarray);

// check if the 'install' directory exists, and warn of its existence
  if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install')) {
      $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');
    }
  }

// check if the configure.php file is writeable
  if (WARN_CONFIG_WRITEABLE == 'true') {
    if ( (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
      $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');
    }
  }

// check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
      } elseif (!is_writeable(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
      }
    }
  }

// check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
      $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
      $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
  }

  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  
  $customer_name = tep_session_is_registered('customer_id') ? ucfirst($_SESSION['customer_last_name']) .' '.ucfirst($_SESSION['customer_first_name']) : '';

    if (SPONSORSHIP_ACTIVATE)
        $new_discount = $sponsorship->check_new_discounts($customer_email_address);
	$width = $check_server == 'fr' ? '25%' : '33%';
?>
<!-- start -->
<script type="text/javascript" src="includes/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="includes/jquery-ui-1.7.2.min.js"></script>
<script type="text/javascript" src="includes/animation.js"></script>
<table cellpadding="0" cellspacing="0" border="0" style="width:980px" align="center"> 
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" style="height:169px;" class="header">
				<tr>
					<td align="center">
                    	<table cellpadding="0" cellspacing="0" border="0" style="height:93px; width:980px">
                            <tr>
                                <td><a style="float:right;width:730px;height:97px;" href="<?php echo tep_href_link('index.php')?>"><?php echo tep_image(DIR_WS_IMAGES.'logo.jpg', 'logo', '', '', ' id="header_logo" ')?></a></td>
                                <!--<td style="width:179px">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr><td nowrap class="vam"><?php echo BOX_HEADING_CURRENCIES?>: &nbsp;</td><td style="width:100%"><?php
    echo tep_draw_form('currencies', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');
    reset($currencies->currencies);
    $currencies_array = array();
    while (list($key, $value) = each($currencies->currencies)) {
      $currencies_array[] = array('id' => $key, 'text' => $value['title']);
    }
    $hidden_get_variables = '';
    reset($HTTP_GET_VARS);
    while (list($key, $value) = each($HTTP_GET_VARS)) {
      if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= tep_draw_hidden_field($key, $value);
      }
    }
    echo tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" class="select"') . $hidden_get_variables . tep_hide_session_id();
    echo '</form>';
?> </td></tr>
                                    </table>
                                </td>-->
<!--                                     <td><?php require_once(DIR_WS_MODULES.'easy_coupons_box2.php'); ?></td> -->
                                <td><?php echo $customer_name ? HEADER_HELLO . ' ' . $customer_name . '<br />'.(isset($new_discount) && $new_discount > 0 ? constant('HEADER_NEW_DISCOUNT'.(isset($new_discount) && $new_discount > 1 ? 'S' : '')) . '<br />' : '').'<a href="'.tep_href_link('logoff.php').'">'.HEADER_LOGOUT.'</a>' : '<a href="'.tep_href_link('login.php').'">'.HEADER_LOGIN.'</a>'; ?></td>
  
                            </tr>
                        </table> 
                        <table cellpadding="0" cellspacing="0" border="0" style="height:29px; background:url(images/top1.gif) no-repeat 10px 0; width:100%">
                            <tr>
                                <td width="20%"  align="left" class="shipCart"><?php //echo tep_draw_separator('spacer.gif', '610', '1'); ?><?php echo tep_image(DIR_WS_IMAGES.'z1.gif')?> &nbsp; <?php echo BOX_HEADING_SHOPPING_CART?>(<a href="<?php echo tep_href_link('shopping_cart.php')?>"><?php echo $cart->count_contents()?> <?php echo BOX_SHOPPING_CART_EMPTY?></a>)</td>
                               <td align="right" style="font-size:11px;color:red;font-weight:bold;"><?php /*echo BOX_SHOPPING_CART_MIN_ORDER;*/ ?></td>
							</tr>
                        </table> 
                        <table cellpadding="0" cellspacing="0" border="0" style="background:black; width:980px;color:white;">
                            <tr>
                                <td style="width: 11px;background:white;"><img src="images/border_left.GIF" /></td>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" class="main_menu">
                                        <tr>
                                            <td>
                                                <a class="menu_top1" href="<?php echo tep_href_link('index.php')?>">
                                                    <?php echo MENU_HOME?></a>
                                            </td>
                                            <td>
                                                <a class="menu_top2" href="<?php echo tep_href_link('index.php?cPath=38_28')?>">
                                                    <?php echo MENU_FRAGRANCE_WOMEN?></a>
                                            </td>
                                            <td>
                                                <a class="menu_top3" href="<?php echo tep_href_link('index.php?cPath=38_27')?>">
                                                    <?php echo MENU_FRAGRANCE_MEN?></a>
                                            </td>
                                            <td>
                                                <a class="menu_top4" href="<?php echo tep_href_link('index.php?cPath=38')?>">
                                                    <?php echo MENU_ALL_BRANDS?></a>
                                            </td>
                    
                                            <td>
                                                <a class="menu_top6" href="<?php echo tep_href_link('account.php')?>">
                                                    <?php echo MENU_MY_ACCOUNT?></a>
                                            </td>
                                            <td>
                                                <a class="menu_top7" href="<?php echo tep_href_link('contact_us.php')?>">
                                                    <?php echo MENU_CONTACT?></a>
                                            </td>
                                        </tr>
                                        </table>
                                </td>
                                <td style="width:207px"><?php echo tep_draw_form('search',tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false),'get') ?>



                                	<table cellpadding="0" cellspacing="0" border="0" style="width:207px">
                                    	<tr><td><input type=text name="keywords" class="go" value=""></td><td><?php echo tep_image_submit('button_search_prod.gif',' class="vam"')?></td></tr>
                                    </table></form>
                                </td>
                                <td style="width: 11px;background:white;"><img src="images/border_right.GIF" /></td>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0" style="background:black; width:980px;margin-top:5px;" class="main_menu">
                            <tr>
                                <td style="width: 11px;background:white;"><img src="images/border_left.GIF" /></td>
								<?php if ($check_server == 'fr') { ?>
									<td width="<?php echo $width; ?>">
										<a class="menu_top4" style="padding:4px 0;" href="<?php echo tep_href_link(FILENAME_CONCEPT)?>">
											<?php echo MENU_CONCEPT; ?></a>
									</td>
								<?php } ?>
                                <!--<td width="20%">
                                    <a class="menu_top1" href="<?php echo tep_href_link(FILENAME_SAVINGS)?>">
                                        <?php echo MENU_SAVINGS?></a>
                                </td>-->
                                <td width="<?php echo $width; ?>">
                                    <a class="menu_top2" style="padding:4px 0;" href="<?php echo tep_href_link(FILENAME_SELECTION)?>">
                                        <?php echo MENU_SELECTION?></a>
                                </td>
                                <td width="<?php echo $width; ?>">
                                    <a class="menu_top6" style="padding:4px 0;" href="<?php echo tep_href_link(FILENAME_BONS_PLANS)?>">
                                        <?php echo MENU_BONS_PLANS?></a>
                                </td>
                                <td>
                                    <a class="menu_top5" href="<?php echo tep_href_link('faq.php')?>">
                                        <?php echo BOX_INFORMATION_FAQ?></a>
                                </td>
                                <td width="<?php echo $width; ?>">
                                    <a class="menu_top6" style="padding:4px 0;display:block;;" href="<?php echo tep_href_link(FILENAME_MEMBERS)?>">
                                        <?php echo MENU_BECOME_MEMBER?></a>
                                </td>
                                <td style="width: 11px;background:white;"><img src="images/border_right.GIF" /></td>
                            </tr>
                        </table>
                        <br style="line-height:17px"> 
                     </td>
				</tr>
			</table>

<!-- end -->
<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['error_message']))); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['info_message']))); ?></td>
  </tr>
</table>
<?php
  }
?>
<!-- start -->
         </td>
	</tr>
	<tr>
		<td>
<!-- end -->

<?php 
define('MAX_DESCR_1','58');
define('MAX_DESCR_BESTS','19');
define('MAX_DESCR_REVIEWS','59');
?>
