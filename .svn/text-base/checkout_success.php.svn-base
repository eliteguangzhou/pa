<?php
/*
  $Id: checkout_success.php,v 1.49 2003/06/09 23:03:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the shopping cart page
  if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'update')) {
    $notify_string = '';

    if (isset($HTTP_POST_VARS['notify']) && !empty($HTTP_POST_VARS['notify'])) {
      $notify = $HTTP_POST_VARS['notify'];

      if (!is_array($notify)) {
        $notify = array($notify);
      }

      for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
        if (is_numeric($notify[$i])) {
          $notify_string .= 'notify[]=' . $notify[$i] . '&';
        }
      }

      if (!empty($notify_string)) {
        $notify_string = 'action=notify&' . substr($notify_string, 0, -1);
      }
    }

    tep_redirect(tep_href_link(FILENAME_DEFAULT, $notify_string));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);
  $breadcrumb->add(NAVBAR_TITLE_2);

  $global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = tep_db_fetch_array($global_query);

  if ($global['global_product_notifications'] != '1') {
    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = tep_db_fetch_array($orders_query);

    $products_array = array();
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
    $products_ids = '';
    while ($products = tep_db_fetch_array($products_query)) {
      $products_ids .= $products[$i]['id'].',';
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }

  //pour les stats shopzilla, shopping...
  $total_cost = round($rsi*$currencies->currencies[$currency]["value"]*100)/100;
  $max_friend_discount = MAX_FRIEND_DISCOUNT / $currencies->currencies["EUR"]['value'];

  //friend discount
  if (ACTIVATE_DISCOUNT && ACTIVATE_FRIEND_DISCOUNT) {
      $mail_sent = false;
      require_once(DIR_WS_CLASSES . '/friend_discount.php');
      $friend_discount = new friendDiscount();

      $friend_emails = $friend_discount->get($insert_id);
      if (empty($friend_emails) && tep_session_is_registered('order_valid') && $order_valid === true && isset($_POST['email'])){
        $emails = array_unique($_POST['email']);
        $has_error = false;

        foreach ($emails as $index => $email)
            if (empty($email))
                unset($emails[$index]);
            elseif (!$has_error && !(tep_validate_email($email) && $email != $customer_email_address)) {
                $messageStack->add('bad_email', BAD_FRIEND_EMAIL);
                $has_error = true;
            }
            elseif (!$has_error && $friend_discount->check_email($email, $customer_id)) {
                $messageStack->add('bad_email', ERROR_DISCOUNT_ALREADY_GIVEN);
                $has_error = true;
            }

        if ($messageStack->size('bad_email') == 0) {
            $godfather_fullname = ucfirst($customer_first_name) . ' ' . ucfirst($customer_last_name);
            foreach ($emails as $email)  {
                $code = gen_coupon_code(SPONSORSHIP_CODE_LENGTH);
                $sponsorship->generate_discount($code, $max_friend_discount, $email, date('Y-m-d H:i:s', strtotime("+2 day")), $insert_id, 0);
                tep_mail(
                    '',
                    $email,
                    sprintf(FRIEND_DISCOUNT_EMAIL_SUBJECT, $godfather_fullname),
                    nl2br(sprintf(FRIEND_DISCOUNT_EMAIL_TEXT, $godfather_fullname, $currencies->display_price($max_friend_discount), $code)),
                    STORE_NAME,
                    STORE_OWNER_EMAIL_ADDRESS
                );
                $friend_discount->track_friend($email, $customer_id, $insert_id);
                $mail_sent = true;
            }
            tep_session_unregister('order_valid');
        }
      }
    }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript">
<!--
    //Shopzilla.com
	/* Performance Tracking Data */
	var mid            = '231079';
	var cust_type      = '<?php echo $new_client; ?>';
	var order_value    = '<?php echo $total_cost; ?>';
	var order_id       = '<?php echo $insert_id?>';
	var units_ordered  = '<?php echo $total_products; ?>';
//-->
</script>
<script language="javascript" src="https://www.shopzilla.com/css/roi_tracker.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
   </td>
<!-- body_text //-->
    <td width="100%" class="col_center"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>

<?php tep_draw_heading_top(901);?>

<?php
 //new contentBoxHeading_ProdNew($info_box_contents);
 ?>

<?php
tep_draw_heading_top_1();

?>
		<?php
          if ($messageStack->size('bad_email') > 0) {
        ?>
             <p style="margin:10px 0 0 0"><?php echo $messageStack->output('bad_email'); ?></p>
        <?php
          }
        ?>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
               <td valign="top" class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?>
                    <?php
                        if (!isset($mail_sent) || !$mail_sent)
                            echo sprintf(HEADING_TITLE, $insert_id, $insert_id, $currencies->display_price($max_friend_discount, 0), isset($_POST['email'][0]) ? $_POST['email'][0] : '', isset($_POST['email'][1]) ? $_POST['email'][1] : '', isset($_POST['email'][2]) ? $_POST['email'][2] : '');
                        else
                            echo sprintf(MAIL_SENT);
                    ?>
                </td>
           </tr>
           <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
        </table>

	  <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
       </table>

<?php tep_draw_heading_bottom_1();?>

<?php tep_draw_heading_bottom();?>

		</td>
      </tr>
<?php if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); ?>
    </table></td>
<!-- body_text_eof //-->
    <td class="col_right">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<?php if ($check_server == 'es') { ?>
<!-- Google Code for Achat - Perfumes ES Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1024320665;
var google_conversion_language = "es";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "36OXCMG02gIQmcm36AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1024320665/?label=36OXCMG02gIQmcm36AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } elseif ($check_server == 'it') {?>
<!-- Google Code for Achat - Profumi IT Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1024320665;
var google_conversion_language = "it";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "5tzlCLm12gIQmcm36AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1024320665/?label=5tzlCLm12gIQmcm36AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php } elseif ($check_server == 'fr') { ?>
<iframe frameborder="0" width="1" height="1" scrolling="no" src="http://action.metaffiliation.com/suivi.php?mclic=I46F231012&argmon=<?php echo $total_products_price;?>&argann=<?php echo $insert_id;?>"><img src="http://action.metaffiliation.com/suivi.php?mclic=S46F231012&argmon=<?php echo $total_products_price;?>&argann=<?php echo $insert_id;?>" width="1" height="1" border="0"></iframe>
<script type="text/javascript">var journeycode='8fc45ac1-775b-40cc-adfb-229ad0160d5c';var captureConfigUrl='rcs.veinteractive.com/CaptureConfigService.asmx/CaptureConfig'; (function() {     var ve = document.createElement('script'); ve.type = 'text/javascript'; ve.async = true;     ve.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'config1.veinteractive.com/vecapturev5.js';     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ve, s);})();</script>
<img src="http://newsletters.parfumrama.com/ev/parfumrama?eventid=650000047&itemcnt=<?php echo $total_products;?>&amount=<?php echo $total_products_price;?>&random=<?php echo uniqid();?>&ecm_order_id=<?php echo $insert_id;?>" width="1" height="1" />
<?php } ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<script type="text/javascript" src="http://img.netaffiliation.com/u/38/p28451.js?zone=fincommande&montant=<?php echo $netaffiliation;?>&listeids=<?php echo $products_ids;?>&idtransaction=<?php $insert_id;?>"></script>
<script language="JavaScript">
var merchant_id = '478192'
var order_id = '<?php $insert_id;?>'
var order_amt = '<?php echo $total_products_price;?>'
var category_id = ''
var category_name = 'Parfum'
var product_id = '<?php echo $products_ids;?>'
var product_name = ''
</script>
<script language="JavaScript" src="https://stat.DealTime.com/ROI/ROI.js?mid=478192"></script>