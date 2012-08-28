<?php
/*
  $Id: catalog/includes/classes/comment8r/message_set.php,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/

class message_set {
	
	var $db = '';
	var $p_id = '';
	var $arr_messages = array(array());
	var $arr_settings = array();

	
	function message_set($product_id){
		include_once(DIR_WS_CLASSES . 'comment8r/dao.php');
		$this->db = new dao();
		$this->getMSetProperties();
		$this->p_id = $product_id;
	}
	
	function getMSetProperties(){
		$this->arr_settings = $this->db->getGlobalSets();
	}
	
	function getMessages4Prod(){
		return $this->db->getMessagesForProduct($this->p_id);
	}
	
	function getNewMessageEditor(){
		$output = '';
		$output .= $this->getValidation();
		
		$bg_rgb = $this->arr_settings['bg_rgb'];
		$sz_captcha = 'captcha';
		$sz_cap_file = 'securimage/securimage_show.php?';
		$reload_captcha = '<a href="#" onclick="document.getElementById(\'' . $sz_captcha . '\').src =\'' . $sz_cap_file . '\' + Math.random(); return false">Reload Image</a>';
		$action = tep_href_link('ossCommentz.php', 'action=addComment', 'NONSSL');
		$form = '<form name="addOSSComment" action="' . $action . '" method="post" onSubmit="return isValid();">';
		
		$output .= '<tr><td>' . $form . '<table bgcolor=' . $bg_rgb . ' width=100% border=1 rules=none frame=box>';

		$output .= '<tr><td>Author: </td><td><input type=text id=name name=name size="30" maxlength="30"/></td></tr>';
		$output .= '<tr><td>Message Title: </td><td><input type=text id=title name=title size=50 maxlength=100 /></td></tr>';
		$output .= '<tr><td>Comment: </td><td><textarea id=msg name=msg cols=50 rows=5></textarea></td></tr>';
		$output .= '<tr><td align="right" colspan="2"><table><tr><td><img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" /></td><td style="font-size: 10;">' . $reload_captcha .
		
		'<br><input type="text" name="captcha_code" size="10" maxlength="6" />
		<input type="hidden" name="url" value="' . HTTP_SERVER . $_SERVER['REQUEST_URI'] . '" />
		<input type="hidden" name="p_id" value="' . $this->p_id . '" />
		<input type="submit" value="Send" /></td></tr></table></td></tr>';
		
		$output .= '</table></form></td></tr>';
		return $output;
	}
	
	function getValidation(){
		
		$output = '';
		$name = 'name';
		$name_err = 'Please make sure the AUTHOR name is at least 3 characters long';//translate
		$title = 'title';
		$title_err = 'Please make sure the MESSAGE TITLE is at least 5 characters long';//translate
		$msg = 'msg';
		$msg_err = 'Please make sure the COMMENT is at least 10 characters long';//translate
		$output .= '<script language="javascript">';
		$output .= 'function isValid(){';
		$output .= 'if(document.getElementById(\'' . $name . '\').value.length < 3){alert(\'' . $name_err . '\');return false;}';
		$output .= 'if(document.getElementById(\'' . $title . '\').value.length < 5){alert(\'' . $title_err . '\');return false;}';
		$output .= 'if(document.getElementById(\'' . $msg . '\').value.length < 10){alert(\'' . $msg_err . '\');return false;}';
		$output .= 'return true;}</script>';
		return $output;
	}
	
	function getMessageSet($captcha_ok){
		
		$output = '';
		
		$area_width = $this->arr_settings['area_width'] . "%";
		$area_align = $this->arr_settings['area_align'];
		$head_txt = $this->arr_settings['head_txt'];
		$head_align = $this->arr_settings['head_align'];
		$txt_rgb = $this->arr_settings['txt_rgb']; 
		$bg_rgb = $this->arr_settings['bg_rgb']; 
		
		$mess_query = $this->getMessages4Prod();
		
		$mess_count = 0;
		while($message = @tep_db_fetch_array($mess_query)){
	
			$this->arr_messages[$mess_count]['msg_id'] = $message['msg_id'];
			$this->arr_messages[$mess_count]['name'] = $message['name'];
			$this->arr_messages[$mess_count]['msg_title'] = $message['msg_title'];
			$this->arr_messages[$mess_count]['msg'] = $message['msg'];
			$this->arr_messages[$mess_count]['msg_date'] = $message['msg_date'];
		
			$mess_count++;
		}
		
		if(count($this->arr_messages) > 0){
			$output .= '<font color=' . $txt_rgb . ' ><table align=' . $area_align . ' width=' . $area_width . '><tr>
        <td><br></td>
      </tr><tr><td align=' . $area_align . '><table width=100%><tr>
        <td align=' . $head_align . '><b>' . $head_txt . '</b></td>
      </tr>';
      
      if($captcha_ok == 'false'){
      	$output .= '</font><tr>
        <td align=' . $head_align . '><b><font color="red" style="font-weight: bold;">The CAPTCHA code was incorrectly entered. Please try again.</font></b></td>
      </tr><font color=' . $txt_rgb . ' >';
      	
      }
            
			for($i = 0; $i < count($this->arr_messages);$i++){
if(strlen($this->arr_messages[$i]['msg_title']) > 0){				
				$msge = $this->arr_messages[$i]['msg'];
				
				$msge = preg_replace("/(\r\n¦\n¦\r)/", "\n", $msge); 
				$msge = preg_replace("/\n\n+/", "\n\n", $msge); 
				$msge = preg_replace('/\n?(.+?)(\n\n¦\z)/s', "<p>$1</p>", $msge);
				$msge = preg_replace('¦(?<!</p>)\s*\n¦', "<br />", $msge);
				
				$output .= '<tr><td><table bgcolor =' . $bg_rgb . ' width=100% border=1 rules=none frame=box><tr><td style="font-size: 14;">';
				$output .= '<b>' . stripslashes($this->arr_messages[$i]['msg_title']) . '</b><font style="font-size: 10;"> posted by </font><b>' . stripslashes($this->arr_messages[$i]['name']) . '</b><font style="font-size: 10;"> on ' . $this->arr_messages[$i]['msg_date'] . '</font>';
				$output .= '<br><hr size="1"  /></td></tr>';
				$output .= '<tr><td>';
				$output .= stripslashes($msge);
				$output .= '</td></tr></table></td></tr>';
				
			}
		}		
			$output .= $this->getNewMessageEditor();
			$output .= '<tr><td style="font-size: 10;" align="right">Powered by <a target="_blank" href="http://www.open-source-services.com">easyCommentz</a></td></tr>';
			$output .= '</table></td></tr></table></font>';
		}		
		return $output;
	}
}