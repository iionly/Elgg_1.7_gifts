<?php
	// Get the required points for an gift
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	global $CONFIG;
	
	$GiftID = get_input('id');
	
	$points = get_plugin_setting('giftpoints_'.$GiftID, 'gifts');
	
	if($points == "") {
		echo 0;
	} else {
		echo $points;
	}
?>