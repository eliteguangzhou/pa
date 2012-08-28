<?php
/*
  $Id: catalog/admin/includes/classes/comment8r/delegate.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/
class delegate {
	
	var $db;
	var $arr_message_sets;
		
	function delegate(){
		include_once(DIR_WS_CLASSES . 'comment8r/dao.php');
		$this->db = new dao();
	}
	
	function saveNewMessage($arr_msg){
		$this->db->saveNMessage($arr_msg);
	}
	
	function getAllMessages(){
		return $this->db->getAMessages();
	}
	
	function deleteMessage($index){
		$this->db->delMessage($index);
	}
	
	function updateMessage($arr_msg){
		$this->db->udMessage($arr_msg);
	}
	
	function getGlobSets(){
		return $this->db->getGlobalSets();
	}
	
	function updateGlobSets($new_sets){
		return $this->db->updateGlobalSets($new_sets);
	}
}
?>