<?php
/*
  $Id: catalog/includes/classes/comment8r/delegate.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/
class delegate {
	
	var $db;
	var $arr_message_sets;
	var $mess_set;
		
	function delegate(){
		include_once(DIR_WS_CLASSES . 'comment8r/dao.php');
		include_once(DIR_WS_CLASSES . 'comment8r/message_set.php');
		$this->db = new dao();
	}

	function saveNewMessage($arr_msg){
		$this->db->saveNMessage($arr_msg);
	}
	
	function displayMessageSet4Prod($prod_id,$captcha_ok){
		$this->mess_set = new message_set($prod_id);
		echo $this->mess_set->getMessageSet($captcha_ok);
	}
}
?>