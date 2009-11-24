<?php 
	$homePage = explode(':', Configure::read('CMScout.Core.homePage'));
	$homePageOptions = Configure::read('CMScout.Core.homePageOption');
	
	$homePage['plugin'] = $homePage[0];
	$homePage['controller'] = $homePage[1];
	$homePage['action'] = $homePage[2];
	
	echo $this->element($homePage['controller'] . '_' . $homePage['action'], array('plugin' => $homePage['plugin'], 'options' => $homePageOptions));
?>