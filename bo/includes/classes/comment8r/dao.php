<?php
/*
  $Id: catalog/admin/includes/classes/comment8r/dao.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/

class dao {
	
	function dao(){
		
	}
	
	function saveNMessage($arr_Msg){
		tep_db_query("insert into " . TABLE_COMM_MESSAGES . " (product_id, msg_date, msg_title, msg, name) values ('" . tep_db_input($arr_Msg['p_id'])  . "', CURRENT_TIMESTAMP ,'" . tep_db_input($arr_Msg['title'])  . "','" . tep_db_input($arr_Msg['msg'])  . "','" . tep_db_input($arr_Msg['name']) . "')");
	}
	
	function getAMessages(){
		return tep_db_query("select * from "  . TABLE_COMM_MESSAGES . " order by msg_id");
	}
	
	function delMessage($index){
		tep_db_query("delete from " . TABLE_COMM_MESSAGES . " where msg_id = '" . $index . "'");
	}
	
	function udMessage($arr_msg){
		tep_db_query("update " . TABLE_COMM_MESSAGES . " set msg_date = CURRENT_TIMESTAMP, msg_title = '" . tep_db_input($arr_msg['title']) . "', msg = '" . tep_db_input($arr_msg['msg']) . "', name = '" . tep_db_input($arr_msg['name']) . "' where msg_id = '" . $arr_msg['msg_id'] . "'");
	}
	
	function getGlobalSets(){
		$raw = tep_db_query("select * from "  . TABLE_COMM_GLOBALS);
		return @tep_db_fetch_array($raw);
	}
	
	function updateGlobalSets($new_sets){
		tep_db_query("update "  . TABLE_COMM_GLOBALS . " set area_width = '" . tep_db_input($new_sets['area_width']) . "',area_align = '" . tep_db_input($new_sets['area_align']) . "',head_txt = '" . tep_db_input($new_sets['head_txt']) . "',head_align = '" . tep_db_input($new_sets['head_align']) . "',txt_rgb = '" . tep_db_input($new_sets['txt_rgb']) . "',bg_rgb = '" . tep_db_input($new_sets['bg_rgb']) . "'");
	}

}
?>