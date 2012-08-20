<?php
/*
  $Id: checkout_new_address.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/ //echo $state."state";
	$process = true;
   if( tep_session_is_registered('customer_id') && ($HTTP_POST_VARS['ship_same']=='on' || empty($HTTP_POST_VARS)) ){
		if($HTTP_POST_VARS['ship_new']!='on'){
		$disabled_ship="disabled";
		}
	}else if(!empty($HTTP_POST_VARS) && ($HTTP_POST_VARS['ship_new']!='on') && tep_session_is_registered('customer_id') ){
	$disabled_ship="disabled";
	}else if($HTTP_POST_VARS['ship_same']=='on'){
	$disabled_ship="disabled";
	}
	else{ $disabled_ship=""; }
	
	if (!isset($process)) $process = false;
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }
	$disabled="disabled";
	
?>
  <tr>
    <td class="main"><?php echo ENTRY_GENDER; ?></td>
    <td class="main"><?php echo tep_draw_radio_field('ship_gender', 'm', $male, $disabled_ship." ".'id="ship_genderm"') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('ship_gender', 'f', $female,$disabled_ship." ".'id="ship_genderf" $disabled_ship') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
  </tr>
<?php
  }
  
  //echo $HTTP_POST_VARS['ship_same']."shipname"; 
	//echo "entering";
	
?>
  <tr>
    <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_firstname',$ship_firstname,$disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); 
	echo tep_draw_hidden_field('address_book_id',$address_book_id);
	?>
    
    </td>
  </tr>
  <tr>
    <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_lastname',$ship_lastname,$disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
  </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
  <tr>
    <td class="main"><?php echo ENTRY_COMPANY; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_company',$ship_company, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
  </tr>
<?php
  }
?>
  <tr>
    <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_street_address',$ship_street_address, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
  </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
  <tr>
    <td class="main"><?php echo ENTRY_SUBURB; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_suburb',$ship_suburb, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
  </tr>
<?php
  }
?>
 
  <tr>
    <td class="main"><?php echo ENTRY_CITY; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_city',$ship_city, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
  </tr>
  
  
  <?php
  if (ACCOUNT_STATE == 'true') {
?>
  <tr>
    <td class="main"><?php echo ENTRY_STATE; ?></td>
    <td class="main">
<?php if ($process == true) {
      if ($entry_state_has_zones_ship == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$ship_country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('ship_state', $zones_array,'',$disabled_ship);
      } else {
        echo tep_draw_input_field('ship_state',$ship_state,$disabled_ship);
      }
    } else {
      echo tep_draw_input_field('ship_state',$ship_state,$disabled_ship);
    }
	
	 if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?>
    </td>
  </tr>
<?php
  }
?>
  
   <tr>
    <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
    <td class="main"><?php echo tep_draw_input_field('ship_postcode',$ship_postcode, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
  </tr>
  

  <tr>
    <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
    <td class="main"><?php echo tep_get_country_list('ship_country',$ship_country, $disabled_ship) . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
  </tr>
 </td>
 </tr>
 
</table>
