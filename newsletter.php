<?php 
	if (isset($_GET['n']) && isset($_GET['p'])) {
		$code = (int) $_GET['n'];
		if (($rs = @file_get_contents('newsletters/'.$code.'.html')) !== false) {
			$rs = str_replace('{type}', $_GET['p'], str_replace('{newsletter}', $_GET['n'], $rs));
			$link = 'http://www.parfumrama.com{link}?newsletter='.$_GET['n'].'&type='.$_GET['p'];
			$link = str_replace('{link}', stripos($_GET['n'], 'b') !== false ? '/become_member.php' : '', $link);
			$rs = str_replace('{link}', $link, $rs);
			$rs = str_replace('{type}', $_GET['p'], $rs);
			$rs = str_replace('{newsletter}', $_GET['n'], $rs);
			echo $rs;
		}
		else
			echo 'Newsletter '.$_GET['n'].' inconnue ou partenaire manquant.';
	}
?>