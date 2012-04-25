<?php
/*
  $Id: footer.php,v 1.26 2003/02/10 22:30:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
</table>
<?php
  require(DIR_WS_INCLUDES . 'counter.php');
?>
          </td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" style="height:121px;padding-top:10px;" class="footer">
				<tr style="text-align: center;">
					<td>
                        <span><a href="<?php echo tep_href_link('advanced_search.php')?>"><?php echo BOX_SEARCH_ADVANCED_SEARCH?></a></span>&nbsp; <span>|</span> &nbsp;<span><?php if (tep_session_is_registered('customer_id')) {
?><a href="<?php echo tep_href_link('account.php')?>"><?php echo HEADER_TITLE_MY_ACCOUNT?></a><?php } else 
{ ?><a href="<?php echo tep_href_link('create_account.php')?>"><?php echo HEADER_TITLE_CREATE_ACCOUNT?></a><?php } 
?></span>&nbsp; <span>|</span> &nbsp;<span><?php if (tep_session_is_registered('customer_id')) { 
?><a href="<?php echo tep_href_link('logoff.php')?>"><?php echo HEADER_TITLE_LOGOFF?></a><?php } else 
{ ?><a href="<?php echo tep_href_link('login.php')?>"><?php echo HEADER_TITLE_LOGIN?></a><?php } 
?></span><br>
                        <br style="line-height:3px">
                        <?php echo FOOTER_TEXT_BODY?>
                  	</td>
                  	</tr>
		<?php if ($check_server == 'en') { ?>
			<td style="font-size:15px;"><?php echo FOOTER_CERTIFIED; ?></td>
			<td><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/partners.gif', 'Partners'); ?></td>
			<td><?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/bizrate.jpg', 'Bizrate Certified Customers'); ?></td>
		<?php } ?>
              <tr style="">
                    <td style="padding-top: 10px; text-align: right;padding-right: 195px; font-size:28px"><?php echo PAYEMENT_100_SECURE; ?>&nbsp;<?php echo tep_image(DIR_WS_LANGUAGES.$language.'/images/cadena.png', 'Partners',17); ?></td>
	      </tr>
	      <tr style="float: right; margin-right: 195px;">
		  <td>

         <!-- PayPal Logo -->
        	 <a href="#" onclick="javascript:window.open('https://www.paypal.com/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img width="350" height="70" src="includes/languages/espanol/images/bnr_paymentsBy_150x40.gif" border="0" alt="Additional Options"></a>
	<!-- PayPal Logo -->
                </td>
              </tr>
            </table>
         </td>
	</tr>
</table>

<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php /*  echo tep_display_banner('static', $banner);  */ ?></td>
  </tr>
</table>
<?php
  }
?>

<?php if (isset($neta_email)) { ?>
	<img width="0" height="0" src="http://tbl.tradedoubler.com/report?organization=1528465&event=228159&leadNumber=<?php echo $neta_email;?>">
	<img src="http://tbl.tradedoubler.com/report?organization=1528465&event=228159&leadNumber=<?php echo $neta_email;?>" height="1" width="1" border="0">
	<img src="http://tbl.tradedoubler.com/report?organization=1622676&event=236518&leadNumber=<?php echo $neta_email;?>">
	<img src="http://action.metaffiliation.com/suivi.php?mclic=S453491012&argann=<?php echo $neta_email;?>" width="1" height="1" border="0">
	<img width="0" height="0" src="http://ext.trackingwiz.com/Aspx/pixel.aspx?tpid=i10929818&IDADV=<?php echo $neta_email;?>"/>
	<iframe src="http://nodes.reactivpub.fr/scripts/tracking.php?params=4044|4&track=<?php echo $neta_email;?>" width="1" height="1" frameborder="0"></iframe>
<?php
  tep_session_unregister('neta_firstname');
  tep_session_unregister('neta_lastname');
  tep_session_unregister('neta_email');
}
?>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', '<?php echo $google_account; ?>']);
	_gaq.push(['_trackPageview']);

	(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>