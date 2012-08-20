<?php
  require('includes/application_top.php');

  if (!SPONSORSHIP_ACTIVATE) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'SSL'));
  }

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SPONSORSHIP_DISCOUNT);

    $sponsorship->update_view($customer_email_address);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td class="col_left">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </td>
<!-- body_text //-->
    <td class="col_center">

<?php tep_draw_heading_top();?>

<?php tep_draw_heading_top_1();?>

        <div class="sponsorship_info">
            <h1><?php echo SPONSORSHIP_TITLE;?></h1>

            <table cellpadding="1" cellspacing="1" border="1" id="sponsorship_list">
                <tr>
                    <td align="center"><?php echo SPONSORSHIP_CODE; ?></td>
                    <td align="center"><?php echo SPONSORSHIP_DISCOUNT; ?></td>
                    <td align="center"><?php echo SPONSORSHIP_FROM_GOD_CHILD; ?></td>
                    <td align="center"><?php echo SPONSORSHIP_END_DATE; ?></td>
                    <td align="center"><?php echo SPONSORSHIP_DISCOUNT_USED; ?></td>
                </tr>
                <?php
                    $query = tep_db_query("
                        select
                            co.code,
                            co.discount,
                            co.type,
                            DATE_FORMAT(co.enddate, '%d/%m/%Y') as enddate,
                            co.used,
                            CONCAT(gc.customers_firstname, ' ', gc.customers_lastname) as godchild,
                            CONCAT(gf.customers_firstname, ' ', gf.customers_lastname) as godfather,
                            co.generated_by
                        from (". TABLE_CUSTOMERS." cu, " . TABLE_COUPONS . " co)
                        LEFT JOIN ".TABLE_SPONSORSHIP." sgc ON (
                                  sgc.email = cu.customers_email_address
                            and   sgc.subscribed = 1
                        )
                        LEFT JOIN ".TABLE_ORDERS." o ON
                            co.orders_id_issued = o.orders_id
                        LEFT JOIN ". TABLE_CUSTOMERS." gc ON
                            o.customers_id = gc.customers_id
                        LEFT JOIN ". TABLE_CUSTOMERS." gf ON
                            sgc.customers_id = gf.customers_id
                        where cu.customers_email_address = co.email
                        and   cu.customers_id = '".(int)$customer_id."'
                        and   (!ISNULL(gc.customers_firstname)
                        or    ISNULL(gc.customers_firstname) and !ISNULL(gf.customers_firstname))
                    ");
                    $has_discount = false;
                    while($data = tep_db_fetch_array($query)) {
                        $has_discount = true;
                        
                        //Type de reduc
                        if ($data['generated_by'] == "avoir")
                            $type = SPONSORSHIP_AVOIR;
                        elseif (!empty($data['godchild']))
                            $type = $data['godchild'];
                        else
                            $type = SPONSORSHIP_WELCOME_DISCOUNT .' '. $data['godfather'];
                            
                        echo '
                            <tr>
                                <td>'.$data['code'].'</td>
                                <td>'.($data['type'] == 'p' ? $data['discount'] . '%' : $currencies->display_price($data['discount'])).'</td>
                                <td>'.$type.'</td>
                                <td>'.$data['enddate'].'</td>
                                <td>'.($data['used'] ? SPONSORSHIP_YES : SPONSORSHIP_NO).'</td>
                            </tr>
                        ';
                    }
                    if (!$has_discount)
                        echo '
                            <tr>
                                <td colspan="5">'.SPONSORSHIP_NO_DISCOUNT.'</td>
                            </tr>
                        ';
                ?>
            </table>
        </div>

<?php tep_draw_heading_bottom_1();?>

<?php tep_draw_heading_bottom();?>

    </td>
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

<?php if ($messageStack->size('email_format') > 0) { ?>
<script type="text/javascript">
    self.location.hash='#sponsorship';
</script>
<?php } ?>
<!-- footer_eof //--></body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>