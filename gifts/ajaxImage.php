<?php
	// Returns the Image Code for Image Preview
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	global $CONFIG;
	
	$imageID = get_input('id');
	
	$imagefile = "gift_".$imageID."_default.jpg";
	$imgfile =  (dirname(__FILE__))."/images/".$imagefile;
                
    if (file_exists($imgfile)) {
    	echo "<img src=\"".$CONFIG->url.'mod/gifts/images/'.$imagefile."\" />";
    } else {
    	echo "<img src=\"".$CONFIG->url."mod/gifts/images/noimage.jpg\" />";
	} 
?>