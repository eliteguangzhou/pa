/*
  $Id: catalog/admin/includes/comment8r.js,v 1.0 20:57:52 NCB Exp $
 	easyCommentz by hanuman at Open Source Services
  Support forum at http://www.open-source-services.com/Forum/easyCommentz-EZC-v0.1-free-osCommerce/
*/

function clear_scrn(){
	document.getElementById('new_msg').innerHTML = "";
	document.getElementById('edit_msg').innerHTML = "";
	document.getElementById('display_msgs').innerHTML = "";
	document.getElementById('display_glob_sets').innerHTML = "";
}


function new_msg(){
	
	var output = "<table class='' border='1' rules='none' frame='box'><tr>";
	output += "<td align='center'>Product Name: </td>";	
	output += "<td><select id='sel_prod'>";

	for(x = 0; x < product_names.length; x++){		
		output += "<option value='" + product_ids[x] + "'>" + product_names[x] + "</option>";
	}		
	output += "</select></td>"; 	
	output += "</tr><tr>";
	output += "<td>Author: </td>";
	output += "<td><input type='text' id='author' value='Administrator' /></td>";
	output += "</tr><tr>";
	output += "<td>Message Title: </td>";
	output += "<td><input type='text' id='title' size='50' maxlength='100' /></td>";
	output += "</tr><tr>";
	output += "<td valign='top'>Comment: </td>";
	output += "<td><textarea id='comment' cols='50' rows='20'></textarea></td>";	
	output += "</tr><tr>";
	output += "<td colspan='2' align='right'><input type='button' value='Close' onClick='shut_msg()'><input type='button' value='Submit' onClick='save_new_msg()' /></td>";
	output += "</tr></table><br><br>";
	document.getElementById('new_msg').innerHTML = output;
}

function save_new_msg(){
	
	var send = new Image();
	send.src = "comment8r.php?action=save_new_msg&p_id=" + document.getElementById('sel_prod').value + "&name=" + document.getElementById('author').value + "&msg=" + document.getElementById('comment').value + "&title=" + document.getElementById('title').value;
	send="";
	
	var curDate = new Date();
	var month = curDate.getMonth() + 1;
	if(month.length != 1)month = '0' + month;
	 
	msg_product_ids.push(document.getElementById('sel_prod').value);
	msg_auth.push(document.getElementById('author').value);
	msg_tit.push(document.getElementById('title').value);
	msg_mess.push(document.getElementById('comment').value);
	msg_dat.push(curDate.getFullYear() + '-' + month + '-' + curDate.getDate() + ' ' + curDate.getHours() + ':' + curDate.getMinutes() + ':' + curDate.getSeconds());
	msg_ids.push(msg_ids[msg_ids.length]+1);
	
	alert('Message has been saved succesfully.');
	
	if(document.getElementById('display_msgs').innerHTML != ''){
		show_all_msg(msg_product_ids,msg_auth,msg_tit,msg_mess,msg_dat);
	}
	
	shut_msg();
}

function edit_msg(index){
	var output = "<table class='' border='1' rules='none' frame='box'><tr>";
	output += "<td align='center'>Product Name: </td>";
	output += "<td align='left'>" + product_names[product_ids.indexOf(msg_product_ids[index])] + "</td>";
	output += "</tr><tr>";
	output += "<td>Author: </td>";
	output += "<td><input type='text' id='ud_author' value='" + msg_auth[index] + "' /></td>";
	output += "</tr><tr>";
	output += "<td>Message Title: </td>";
	output += "<td><input type='text' id='ud_title' size='50' maxlength='100' value='" + msg_tit[index] + "'/></td>";
	output += "</tr><tr>";
	output += "<td valign='top'>Comment: </td>";
	output += "<td><textarea id='ud_comment' cols='50' rows='20'>" + msg_mess[index] + "</textarea></td>";
	output += "</tr><tr>";
	output += "<td colspan='2' align='right'><input type='button' value='Close' onClick='shut_msg()'><input type='button' value='Update' onClick='update_msg(" + index + ")' /></td>";
	output += "</tr></table><br><br>";
	document.getElementById('edit_msg').innerHTML = output;
}

function update_msg(index){
	var send = new Image();
	send.src = "comment8r.php?action=update_msg&msg_id=" + msg_ids[index] + "&name=" + document.getElementById('ud_author').value + "&msg=" + document.getElementById('ud_comment').value + "&title=" + document.getElementById('ud_title').value;
	send="";
	
	var curDate = new Date();
	var month = curDate.getMonth() + 1;
	if(month.length != 1)month = '0' + month;
	 
	msg_auth[index] = document.getElementById('ud_author').value;
	msg_tit[index] = document.getElementById('ud_title').value;
	msg_mess[index] = document.getElementById('ud_comment').value;
	msg_dat[index] = curDate.getFullYear() + '-' + month + '-' + curDate.getDate() + ' ' + curDate.getHours() + ':' + curDate.getMinutes() + ':' + curDate.getSeconds();
	
	alert('Message has been updated succesfully.');
	
	if(document.getElementById('display_msgs').innerHTML != ''){
		show_all_msg(msg_product_ids,msg_auth,msg_tit,msg_mess,msg_dat);
	}
	
	shut_msg();
	shut_show_msg();
}

function show_glob_sets() {
	var output = "<table class='' border='1' rules='none' frame='box'><tr>";
	output += "<td align='center'>Comment Area Width (%): </td>";
	output += "<td align='left'><input id='area_width' type='text' size='3' maxlength='3' value='" + glob_sets['area_width'] + "' /></td>";
	output += "</tr><tr>";
	output += "<td align='center'>Comment Area Alignment: </td>";
	output += "<td align='left'><input id='area_align' type='text' size='6' maxlength='6' value='" + glob_sets['area_align'] + "' /></td>";
	output += "</tr><tr>";
	output += "<td align='center'>Comment Area Heading: </td>";
	output += "<td align='left'><input id='head_txt' type='text' size='30' maxlength='50' value='" + glob_sets['head_txt'] + "' /></td>";
	output += "</tr><tr>";
	output += "<td align='center'>Comment Area Heading Alignment: </td>";
	output += "<td align='left'><input id='head_align' type='text' size='6' maxlength='6' value='" + glob_sets['head_align'] + "' /></td>";
	output += "</tr><tr>";
	output += "<td align='center'>Background Color: </td>";
	output += "<td align='left'><input id='bg_rgb' type='text' size='6' maxlength='6' value='" + glob_sets['bg_rgb'] + "' /></td>";
	output += "</tr><tr>";
	output += "<td align='center'>Text Color: </td>";
	output += "<td align='left'><input id='txt_rgb' type='text' size='6' maxlength='6' value='" + glob_sets['txt_rgb'] + "' /></td>";	
	output += "</tr><tr>";
	output += "<td colspan='2' align='right'><input type='button' value='Close' onClick='shut_glob_sets()'><input type='button' value='Update' onClick='update_glob_sets()' /></td>";
	output += "</tr></table>";
	document.getElementById('display_glob_sets').innerHTML = output;
}

function update_glob_sets(){
	
	var send = new Image();
	send.src = "comment8r.php?action=update_global_sets&area_width=" + document.getElementById('area_width').value + "&area_align=" + document.getElementById('area_align').value + "&head_txt=" + document.getElementById('head_txt').value + "&head_align=" + document.getElementById('head_align').value + "&bg_rgb=" + document.getElementById('bg_rgb').value + "&txt_rgb=" + document.getElementById('txt_rgb').value;
	send="";
	
	glob_sets['area_width'] = document.getElementById('area_width').value;
	glob_sets['area_align'] = document.getElementById('area_align').value;
	glob_sets['head_txt'] = document.getElementById('head_txt').value;
	glob_sets['head_align'] = document.getElementById('head_align').value;
	glob_sets['bg_rgb'] = document.getElementById('bg_rgb').value;
	glob_sets['txt_rgb'] = document.getElementById('txt_rgb').value;
	
	alert('Global Setting have been updated successfully.');
}


function shut_msg(){
	document.getElementById('new_msg').innerHTML = "";
	document.getElementById('edit_msg').innerHTML = "";
}

function shut_show_msg(){
	document.getElementById('display_msgs').innerHTML = "";
}

function shut_glob_sets(){
	document.getElementById('display_glob_sets').innerHTML = "";
}

function show_all_msg(msg_product_names,msg_auth,msg_tit,msg_mess,msg_dat){
	if(!Array.indexOf){
	    Array.prototype.indexOf = function(obj){
	        for(var i=0; i<this.length; i++){
	            if(this[i]==obj){
	                return i;
	            }
	        }
	        return -1;
	    }
	}
	var output = "<table border='1'><tr style='font-size: 14;font-weight: bold;'>";
	output += "<td align='center'>Product Name</td><td align='center'>Author</td><td align='center'>Title</td><td align='center'>Message</td><td align='center'>Date</td><td align='center'>Edit</td><td align='center'>Delete</td>";	
	output += "</tr>";
	
	for(x = 0; x < msg_product_names.length; x++){

		output += "<tr style='font-size: 12;'>";
		output += "<td align='left'>" + product_names[product_ids.indexOf(msg_product_ids[x])] + "</td><td align='center'>" + msg_auth[x] + "</td><td align='left'>" + msg_tit[x] + "</td><td align='left'>" + msg_mess[x] + "</td><td align='center'>" + msg_dat[x] + "</td><td align='center'><img src='images/icons/preview.gif' onClick='edit_msg(" + x + ");' /></td><td align='center'><img src='images/icons/delete.gif' onClick='deleteMsg(" + x + ");' /></td>";	
		output += "</tr>";
	}
	output += "<tr><td colspan='7' align='center'><input type='button' value='Close' onClick='shut_show_msg()' /></td></tr>";
	output += "</tr></table><br><br>";
	
	document.getElementById('display_msgs').innerHTML = output;
}

function deleteMsg(index){

	var send = new Image();

	send.src = "comment8r.php?action=delete_msg&msg_id=" + msg_ids[index] ;
	send="";
	
	msg_product_ids.splice(index,1);
	msg_auth.splice(index,1);
	msg_tit.splice(index,1);
	msg_mess.splice(index,1);
	msg_dat.splice(index,1);
	msg_ids.splice(index,1);
	
	alert('Message has been deleted succesfully.');
	
	if(document.getElementById('display_msgs').innerHTML != ''){
		show_all_msg(msg_product_ids,msg_auth,msg_tit,msg_mess,msg_dat);
	}
}
