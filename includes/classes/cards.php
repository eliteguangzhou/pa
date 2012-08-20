<?php
  class cards {
  
	var $list = array();
	var $total = 0;
    
	function cards() {
		global $check_server, $currencies, $currency;
		
		$rs = tep_db_query('SELECT * FROM cards');
		while($r = tep_db_fetch_array($rs)) {
			$this->list[$r['code']] = array(
				'duration' => $r['duration'],
				'enabled' => $r['enabled'],
				'price' => $r['price']
			);
			
			if ($r['enabled'])
				$this->total++;
		}
		
		if ($check_server == 'en') {
			$this->list['card1']['price'] = 29.95 / $currencies->currencies[$currency]['value'];
			$this->list['card3']['price'] = 49.95 / $currencies->currencies[$currency]['value'];
		}
	}
 }
?>