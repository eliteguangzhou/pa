<?php
  require('includes/application_top.php');

  $max_results = 10; // to override the normal search results
//  $max_results = MAX_DISPLAY_SEARCH_RESULTS;

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();


function genpassword($length=32) {  
    srand((double)microtime()*1000000);  
    $vowels = array("a", "e", "i", "o", "u");  
    $cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",  
    "cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");  
    $num_vowels = count($vowels);  
    $num_cons = count($cons);  
    for($i = 0; $i < $length; $i++){  
        $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];  
    }  
    return substr($password, 0, $length);  
}  

function gen_coupon_code ($length) {
  return strtoupper(genpassword($length));
}

  $config_query = tep_db_query("select configuration_value from configuration where configuration_key = 'EASY_COUPONS' ");
  $config_array = tep_db_fetch_array($config_query);
  if ($config_array){
    $config_all  = split('d',$config_array['configuration_value']);
    $config  = split(';',$config_all[0]);
    $active  = $config[0];
    $auto    = $config[1];
    $slip    = $config[2];
    $invoice = $config[3];
    $email   = $config[4];
    $expire  = $config[5];
    $days    = $config[6];
    $dtype   = $config[7];
    $mf      = $config[8];
    $clth    = $config[9];
    $reset   = $config[10];
    $dtable = $config_all[1];
  } else {
    // set default configuration
    tep_db_query("INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (NULL, 'Easy Coupons', 'EASY_COUPONS', '1;1;1;1;0;0;30;p;m;5;1d1000;2;10000;5;20000;8;40000;10;50000;15;100000;20;1000000;25', 'Easy Coupons Config', 6, 0, NULL, '0000-00-00 00:00:00', NULL, NULL);");
    $messageStack->add_session('Default Configuration Inserted', 'success');
  }

  if ($_GET['table'] == 'archive') {
    $view_archive = true;
  } else {
    $view_archive = false;
  }


  if ($view_archive) {
    $table_in_use = TABLE_COUPONS_A;
    $tbl .= ' - ' . LINK_ARCHIVE;
  } else {
    $table_in_use = TABLE_COUPONS;
    $tbl .= ' - ' . LINK_COUPONS;
  }

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  if (tep_not_null($action)) {
    switch ($action) {
      case 'updateconfig':
          if (($HTTP_POST_VARS['days']) and (is_numeric($HTTP_POST_VARS['days']))) {
            $exp_days = $HTTP_POST_VARS['days'];
          } else {
            $exp_days = 30;
          }
          if (($HTTP_POST_VARS['clength']) and (is_numeric($HTTP_POST_VARS['clength']))) {
            $clth = $HTTP_POST_VARS['clength'];
          } else {
            $clth = 10;
          }
          
          $config = (isset($HTTP_POST_VARS['active']) ? '1' : '0').';'.
                    (isset($HTTP_POST_VARS['auto']) ? '1' : '0').';'.
                    (isset($HTTP_POST_VARS['slip']) ? '1' : '0').';'.
                    (isset($HTTP_POST_VARS['invoice']) ? '1' : '0').';'.
                    (isset($HTTP_POST_VARS['email']) ? '1' : '0').';'.
                    (isset($HTTP_POST_VARS['expire']) ? '1' : '0').';'.
                    $exp_days.';'.
                    $HTTP_POST_VARS['dtype'].';'.
                    $HTTP_POST_VARS['mf'].';'.
                    $clth .';'.
                    (isset($HTTP_POST_VARS['reset']) ? '1' : '0').
                    'd'.
                    $HTTP_POST_VARS['dtable'];

          tep_db_query("update configuration set configuration_value = '".$config."' where configuration_key = 'EASY_COUPONS' ");
          if (file_exists('includes/configuration_cache.php')) include ('includes/configuration_cache.php');
          $messageStack->add_session('Configuration Updated', 'success');
          tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
          break;
      case 'insert':
        $enddate = '';
        if (tep_not_null($day) && tep_not_null($month) && tep_not_null($year)) {
          $enddate = $year;
          $enddate .= (strlen($month) == 1) ? '0' . $month : $month;
          $enddate .= (strlen($day) == 1) ? '0' . $day : $day;
        }
          $new_code = $HTTP_POST_VARS['code1'];

          if ($HTTP_POST_VARS['type'] == 'p') {
            if ($HTTP_POST_VARS['discount'] > 100) {
              $HTTP_POST_VARS['discount'] = 100;
            }
          }

          if (!$enddate) $enddate = 'null';
          $sql_data_array = array('code'      => tep_db_prepare_input($new_code),
                                  'type'      => tep_db_prepare_input($HTTP_POST_VARS['type']),
                                  'enddate'   => $enddate,
                                  'discount'  => tep_db_prepare_input($HTTP_POST_VARS['discount']));
          tep_db_perform(TABLE_COUPONS, $sql_data_array, 'insert');
          $messageStack->add_session('Coupon Inserted', 'success');
          tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
          break;
      case 'save':
        if (isset($HTTP_GET_VARS['eID'])) {
          $enddate = '';
          if (tep_not_null($HTTP_POST_VARS['day']) && tep_not_null($HTTP_POST_VARS['month']) && tep_not_null($HTTP_POST_VARS['year'])) {
            $enddate = $HTTP_POST_VARS['year'];
            $enddate .= (strlen($HTTP_POST_VARS['month']) == 1) ? '0' . $HTTP_POST_VARS['month'] : $HTTP_POST_VARS['month'];
            $enddate .= (strlen($HTTP_POST_VARS['day']) == 1) ? '0' . $HTTP_POST_VARS['day'] : $HTTP_POST_VARS['day'];
          }
          if (!$enddate) $enddate = 'null';
          $new_code = $HTTP_POST_VARS['code1'];

          if ($HTTP_POST_VARS['type'] == 'p') {
            if ($HTTP_POST_VARS['discount'] > 100) {
              $HTTP_POST_VARS['discount'] = 100;
            }
          }

          $sql_data_array = array('code'      => tep_db_prepare_input($new_code),
                                  'discount'  => tep_db_prepare_input($HTTP_POST_VARS['discount']),
                                  'type'      => tep_db_prepare_input($HTTP_POST_VARS['type']),
                                  'enddate'   => $enddate,
                                  'used'      => tep_db_prepare_input($HTTP_POST_VARS['used']));
          tep_db_perform($table_in_use , $sql_data_array, 'update', "id = '" . (int)tep_db_prepare_input($HTTP_GET_VARS['eID']) . "'");
        } 
        $messageStack->add_session('Coupon Saved', 'success');
        tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
        break;
      case 'archive':
        $coupon_query = tep_db_query("select * from coupons where used = 1 or enddate < now() ");
        while ($coupon = mysql_fetch_array($coupon_query)) {
          if (!$coupon['enddate']) $coupon['enddate'] = 'null';

          $sql_data_array = array('id'               => $coupon['id'],
                                  'orders_id_issued' => $coupon['orders_id_issued'],
                                  'code'             => $coupon['code'],
                                  'discount'         => $coupon['discount'],
                                  'type'             => $coupon['type'],
                                  'enddate'          => $coupon['enddate'],
                                  'used'             => $coupon['used'],
                                  'orders_id_used'   => $coupon['orders_id_used'],
                                  'email'            => $coupon['email']);

          tep_db_perform(TABLE_COUPONS_A, $sql_data_array, 'insert');
          tep_db_query("delete from coupons where id = '" . $coupon['id']. "'");
        }
        $messageStack->add_session('Archiving Completed', 'success');
        tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
        break;
      case 'deleteconfirm':
        $coupon_id = tep_db_prepare_input($HTTP_GET_VARS['eID']);
        tep_db_query("delete from " . $table_in_use . " where id = '" . (int)$coupon_id . "'");
        $messageStack->add_session('Coupon Deleted', 'success');
        tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
        break;
      case 'delete':
        $coupon_id = tep_db_prepare_input($HTTP_GET_VARS['eID']);
        $remove_coupon = true;
        break;
      case 'delete_used':
        tep_db_query("delete from " . $table_in_use . " where used = 1 or enddate < now() ");
        $messageStack->add_session('Coupons Deleted', 'success');
        tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
        break;
      case 'all_used':
        tep_db_query("update " . $table_in_use . " set used = 1 where used = 0 ");
        $messageStack->add_session('All set to used', 'success');
        tep_redirect(tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table']));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css">
<script language="JavaScript" src="includes/javascript/calendarcode.js"></script>
</head>
<body onload="SetFocus();">
<div id="popupcalendar" class="text"></div>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
     <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
     <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
     </table>
    </td>
    <td width="100%" valign="top">
     <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td>
         <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE.$tbl; ?></td>
            <td class="pageHeading" align="right"><?php if ($active) {echo ACTIVE;} else {echo INACTIVE;} if ($auto) {echo '-'.AUTO;} else {echo '-'.MANUAL;}  ?></td>
          </tr>
        </table>
       </td>
      </tr>


      <tr>
       <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
             <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
               <?php
                 echo '<td style="background: #ffe6e6; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=queue') . '">' . LINK_COUPONS . '</a></td>';
                 echo '<td style="background: #FFFACD; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=archive') . '">' . LINK_ARCHIVE . '</a></td>';
               ?>
              </tr>
             </table>
          </td>
         </tr>
         </table>
      </tr>
      <tr>
       <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
             <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
               <?php
                  if (!$view_archive) {
                    echo '<td style="background: #FFDAB9; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=config') . '">' . 'Configuration' . '</a></td>';
                    echo '<td style="background: #f1f9fe; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=all_used') . '">' . LINK_ALL_USED . '</a></td>';
                    echo '<td style="background: #FFFACD; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=archive') . '">' . LINK_ARCHIVE_USED . '</a></td>';
                  }
                  echo '<td style="background: #FFDAB9; border: 1px solid #A2ABB6;" width="20%" align="center"><a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=delete_used') . '">' . LINK_DELETE_USED . '</a></td>';
               ?>
              </tr>
             </table>
          </td>
         </tr>
         </table>
      </tr>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td align="left" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_ISSUED; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_CODE; ?></td>
                <td align="right" class="dataTableHeadingContent"><?php echo TABLE_HEADING_DISCOUNT; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ENDDATE; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_USED; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_USED; ?></td>
                <td align="center" class="dataTableHeadingContent"><?php echo TABLE_HEADING_EMAIL; ?></td>
              </tr>
              <?php
                $coupon_query_raw = "SELECT *, now() as today from " . $table_in_use . " order by id desc"; 
                $coupon_query_numrows = 0;
                $coupon_split = new splitPageResults($HTTP_GET_VARS['page'], $max_results , $coupon_query_raw, $coupon_query_numrows);

                $coupon_query = tep_db_query($coupon_query_raw);
                while ($coupon = tep_db_fetch_array($coupon_query)) {
                  if ((!isset($HTTP_GET_VARS['eID']) || (isset($HTTP_GET_VARS['eID']) && ($HTTP_GET_VARS['eID'] == $coupon['id']))) && !isset($eInfo) && (substr($action, 0, 3) != 'new')) {
                    $eInfo = new objectInfo($coupon);
                  }

                  if (isset($eInfo) && is_object($eInfo) && ($coupon['id'] == $eInfo->id) ) {
                    if (!$view_archive) {
                      echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=edit') . '\'">' . "\n";
                    } else {
                      echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '\'">' . "\n";
                    }
                  } else {
                    echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $coupon['id'] . '&table=' . $_GET['table']) . '\'">' . "\n";
                  }
              ?>
                <td align="left" class="dataTableContent"><?php echo $coupon['id']; ?></td>
<?php if ($coupon['orders_id_issued']) { ?>
                <td align="center" class="dataTableContent"><?php echo $coupon['orders_id_issued']; ?></td>
<?php } else { ?>
                <td align="center" class="dataTableContent"><?php echo MANUALLY; ?></td>
<?php } ?>
                <td align="center" class="dataTableContent"><?php echo $coupon['code']; ?></td>
<?php if ($coupon['type'] == 'p') { ?>
                <td align="right" class="dataTableContent"><?php echo round($coupon['discount'],0).'%'; ?></td>
<?php } else { ?>
                <td align="right" class="dataTableContent"><?php echo $currencies->format($coupon['discount']); ?></td>
<?php } ?>
<?php if ($coupon['today'] >= $coupon['enddate']) { ?>
                <td align="center" class="dataTableContent"><font color="red"><?php echo $coupon['enddate']; ?></font></td>
<?php } else { ?>
                <td align="center" class="dataTableContent"><?php echo $coupon['enddate']; ?></td>
<?php } ?>
<?php if ($coupon['used']) { ?>
                <td align="center" class="dataTableContent"><?php echo 'Y'; ?></td>
                <td align="center" class="dataTableContent"><?php echo $coupon['orders_id_used']; ?></td>
<?php } else { ?>
                <td class="dataTableContent"><?php echo ''; ?></td>
                <td class="dataTableContent"><?php echo ''; ?></td>
<?php } ?>
                <td align="center" class="dataTableContent"><?php if ($coupon['email']) echo $coupon['email']; ?></td>
              </tr>
              <?php
              }
              ?>
              <tr>
                <td colspan="10">
                 <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $coupon_split->display_count($coupon_query_numrows, $max_results , $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_ENTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $coupon_split->display_links($coupon_query_numrows, $max_results , MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'],'table=' . $_GET['table']); ?></td>
                  </tr>
                </table>
               </td>
              </tr>
            </table>
          </td>
          <?php
           $types[] = array('id' => 'p', 'text' => PERCENT);
           $types[] = array('id' => 'm', 'text' => MONEY);
           $mfs[] = array('id' => 'm', 'text' => MAX);
           $mfs[] = array('id' => 'f', 'text' => FIXED);
           $heading = array();
           $contents = array();
           switch ($action) {
             case 'new':
               $new_code = gen_coupon_code($clth);
               $heading[] = array('text' => '<b>New Coupon Code Generated</b>');
               $contents = array('form' => tep_draw_form('coupons', FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=insert'));
               $contents[] = array('text' => CODE.': '. tep_draw_input_field('code1', $new_code, ' maxlength="'.$clth.'" size="'.($clth + 5).'" ').
                                             DISCOUNT.': ' . tep_draw_input_field('discount', 0, ' size="5" ').'' . tep_draw_pull_down_menu('type', $types, $eInfo->type).
                                             ENDDATE.': ' . tep_draw_input_field('day', (isset($eInfo->enddate) ? substr($eInfo->enddate, 8, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('month', (isset($eInfo->enddate) ? substr($eInfo->enddate, 5, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('year', (isset($eInfo->enddate) ? substr($eInfo->enddate, 0, 4) : ''), 'size="4" maxlength="4" class="cal-TextBox"').'<a class="so-BtnLink" href="javascript:calClick();return false;" onmouseover="calSwapImg(\'BTN_date\', \'img_Date_OVER\',true);" onmouseout="calSwapImg(\'BTN_date\', \'img_Date_UP\',true);" onclick="calSwapImg(\'BTN_date\', \'img_Date_DOWN\');showCalendar(\'coupons\',\'dteWhen\',\'BTN_date\');return false;">'.tep_image(DIR_WS_IMAGES . 'cal_date_up.gif', 'Calendar', '', '', 'align="absmiddle" name="BTN_date"').'</a>');
               $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('insert.gif','Insert Coupon') . ' <a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '">' . tep_image_button('button_cancel.gif','Cancel') . '</a>' . ' <a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '&action=new">' . tep_image_button('button_review_disapprove.gif','Reject Code - Generate new') . '</a>');
               break;
             case 'edit':
               $heading[] = array('text' => EDITCOUPON.' '.$eInfo->id );
               $contents = array('form' => tep_draw_form('coupons', FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=save'));
               $contents[] = array('text' => USED.': ' . tep_draw_checkbox_field('used', 1,$eInfo->used));
               $contents[] = array('text' => CODE.': ' . tep_draw_input_field('code1', $eInfo->code, ' maxlength="'.$clth.'" size="'.($clth + 5).'" ').
                                             DISCOUNT.': ' . tep_draw_input_field('discount', $eInfo->discount, ' size="5" ').'' . tep_draw_pull_down_menu('type', $types, $eInfo->type).ENDDATE . tep_draw_input_field('day', (isset($eInfo->enddate) ? substr($eInfo->enddate, 8, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('month', (isset($eInfo->enddate) ? substr($eInfo->enddate, 5, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('year', (isset($eInfo->enddate) ? substr($eInfo->enddate, 0, 4) : ''), 'size="4" maxlength="4" class="cal-TextBox"').'<a class="so-BtnLink" href="javascript:calClick();return false;" onmouseover="calSwapImg(\'BTN_date\', \'img_Date_OVER\',true);" onmouseout="calSwapImg(\'BTN_date\', \'img_Date_UP\',true);" onclick="calSwapImg(\'BTN_date\', \'img_Date_DOWN\');showCalendar(\'coupons\',\'dteWhen\',\'BTN_date\');return false;">'.tep_image(DIR_WS_IMAGES . 'cal_date_up.gif', 'Calendar', '', '', 'align="absmiddle" name="BTN_date"').'</a>');
               $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
               break;
             case 'config': 
               $heading[] = array('text' => 'Easy Coupon Configuration');
               $contents = array('form' => tep_draw_form('coupons', FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&table=' . $_GET['table'] . '&action=updateconfig'));
               $contents[] = array('text' => '<table><tr><td class="main">'.OPERATION.'</td><td></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.ACTIVE.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('active', 1,$active). ACTIVE_EX .'</td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.AUTO.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('auto', 1,$auto). AUTO_EX .'</td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.'Coupon Length'.':</td><td class="infoBoxContent">'. tep_draw_input_field('clength', $clth, ' maxlength="2" size="2" ').' Characters'.'</td></tr>

                                              <tr><td class="infoBoxContent">'.PUBLICATION.'</td><td></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.SLIP.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('slip', 1,$slip).SLIP_EX.'</td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.INVOICE.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('invoice', 1,$invoice).INVOICE_EX.'</td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.EMAIL.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('email', 1,$email).EMAIL_EX.'</td></tr>
                                              <tr><td class="infoBoxContent">'.DISCOUNTING.'</td><td></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.TABLE.':</td><td class="infoBoxContent" colspan="3">'. tep_draw_input_field('dtable', $dtable, ' maxlength="200" size="80" ').'&nbsp;<i>[order total];[value]</i></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.TYPE.':</td><td class="infoBoxContent" colspan="3">'. tep_draw_pull_down_menu('dtype', $types, $dtype).tep_draw_pull_down_menu('mf', $mfs, $mf).'</td></tr>
                                              <tr><td class="infoBoxContent">'.EXPIRATION.'</td><td></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.EXPIRES.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('expire', 1,$expire).EXPIRES_EX.tep_draw_input_field('days', $days, ' maxlength="3" size="2" ').DAYS.'</td></tr>
                                              <tr><td class="infoBoxContent">'.BUTTONS.'</td><td></td></tr>
                                              <tr><td class="infoBoxContent" align="right">'.RESET.':</td><td class="infoBoxContent">'. tep_draw_checkbox_field('reset', 1,$reset).RESET_EX.'</td></tr>
                                              </table>');
               $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
               break;
             case 'delete':
               $heading[] = array('text' => DELETECOUPON.' '.$eInfo->id );
               $contents[] = array('text' => SURE);
               $contents[] = array('text' => '<br><b>' . $cInfo->title . '</b>');
               $contents[] = array('align' => 'center', 'text' => '<br>' . (($remove_coupon) ? '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=deleteconfirm') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>' : '') . ' <a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
               break;
             default:
               if (is_object($eInfo)) {
                 $heading[] = array('text' => '<b>' . $eInfo->id . '</b>');
                 if (!$view_archive) {
                   $contents[] = array('align' => 'center', 
                                       'text' => '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=edit') . '">' . tep_image_button('button_edit.gif', 'Edit') . '</a> '.
                                                 '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=delete') . '">' . tep_image_button('button_delete.gif', 'Delete') . '</a> '.
                                                 '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=new') . '">' . tep_image_button('insert.gif', 'Generate new') . '</a>');
                 } else {
                   $contents[] = array('align' => 'center', 
                                       'text' => '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=delete') . '">' . tep_image_button('button_delete.gif', 'Delete') . '</a> ');
                 }
                 if ($eInfo->orders_id_issued) {
                 $contents[] = array('text' => ISSUEDBY.': ' . '<a href="' . tep_href_link('orders.php', 'oID=' . $eInfo->orders_id_issued.'&action=edit') . '">' . $eInfo->orders_id_issued . '</a>');
                 } else {
                 $contents[] = array('text' => MANUALLY);
                 }
                 $contents[] = array('text' => CODE.': ' . $eInfo->code);
                 if ($eInfo->type == 'p') { 
                   $contents[] = array('text' => DISCOUNT.': ' . round($eInfo->discount,0) . '%');
                 } else {
                   $contents[] = array('text' => DISCOUNT.': ' . $currencies->format($eInfo->discount));
                 }
                 if ($eInfo->today >= $eInfo->enddate && $eInfo->enddate) {
                   $contents[] = array('text' => ENDDATE.': ' . ($eInfo->enddate).EXPIRED);
                 } else {
                   $contents[] = array('text' => ENDDATE.': ' . ($eInfo->enddate));
                 }

                 if ($eInfo->used) {
                   $contents[] = array('text' => USED.': '.YES);
                   $contents[] = array('text' => USEDBY.': ' . '<a href="' . tep_href_link('orders.php', 'oID=' . $eInfo->orders_id_used.'&action=edit') . '">' . $eInfo->orders_id_used . '</a>');
                 } else {
                   $contents[] = array('text' => USED.': '.NO);
                 }
               }
               break;
           }

           if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
             echo '</tr><tr><td width="100%" valign="top">' . "\n";
             $box = new box;
             echo $box->infoBox($heading, $contents);
             echo '</td>';
           } elseif (!$view_archive) {
             $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_COUPONS, 'page=' . $HTTP_GET_VARS['page'] . '&eID=' . $eInfo->id . '&table=' . $_GET['table'] . '&action=new') . '">' . tep_image_button('insert.gif', 'Reply') . '</a>');
             echo '</tr><tr><td width="100%" valign="top">' . "\n";
             $box = new box;
             echo $box->infoBox($heading, $contents);
             echo '</td>';
           }
          ?>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>