<?php
/*
  $Id: catalog/includes/classes/comment8r/dao.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/

class dao {
	
	function dao(){
		
	}
	
	function saveNMessage($arr_Msg){
		tep_db_query("insert into " . TABLE_COMM_MESSAGES . " (product_id, msg_date, msg_title, msg, name) values ('" . tep_db_input($arr_Msg['p_id'])  . "', CURRENT_TIMESTAMP ,'" . tep_db_input($arr_Msg['title'])  . "','" . tep_db_input($arr_Msg['msg'])  . "','" . tep_db_input($arr_Msg['name']) . "')");
	}
	
	function getGlobalSets(){
		$raw = tep_db_query("select * from "  . TABLE_COMM_GLOBALS);
		return @tep_db_fetch_array($raw);
	}
	
	function getMessagesForProduct($pid){
		return tep_db_query("select * from "  . TABLE_COMM_MESSAGES . " where product_id='" . $pid . "' order by msg_date");
	}
}
?>