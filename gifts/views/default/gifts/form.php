<?php
	/**
	 * Elgg Gifts plugin
	 * Send gifts to you friends
	 *
	 * @package Gifts
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Christian Heckelmann
	 * @copyright Christian Heckelmann
	 * @link http://www.heckelmann.info
	 */
	$useuserpoints  = get_plugin_setting('useuserpoints', 'gifts');
	if($useuserpoints == 1 && function_exists('userpoints_get')) {
		$pTemp = userpoints_get(get_loggedin_userid());
		$points = $pTemp['approved'];
	}

	$ts = time();
        $token = generate_action_token($ts);
        $security = "?__elgg_token=$token&__elgg_ts=$ts";
?>
<div class="contentWrapper">

<script type="text/javascript">
function gifts_previewImage(ImageID) {
	ImageID++;
	var ajaxImage = '<?php echo $vars['url']; ?>mod/gifts/ajaxImage.php?id='+ImageID;

	// Check if Image file is available!!!
	$.ajax({
	  url: ajaxImage,
	  cache: false,
	  success: function(html){
	    //$("#results").append(html);
	    $('#gift_preview')[0].innerHTML = html;
	  }
	});

	// Need here a dynamic function to check userpoints
	<?php
		if($useuserpoints == 1){
			echo "calculateUserpoints(ImageID,$points);";
		}
	?>
}

function calculateUserpoints(GiftID,Points) {
	// Calculating Userpoints and display send button when point are enough
	// Else display error message
	//<input type="submit" value="<?php echo elgg_echo('gifts:send'); ?>

	var ajaxGetPoints = '<?php echo $vars['url']; ?>mod/gifts/ajaxGetPoints.php?id='+GiftID;

	var Cost = $.ajax({
	  url: ajaxGetPoints,
	  async: false
	}).responseText;

	if(Cost == "") Cost = 0;

	if(Cost <= Points) {
		// Add hidden field with the cost of this gift
		var code='<input type="hidden" name="giftcost" value="'+Cost+'" /><input type="submit" value="<?php echo elgg_echo('gifts:send'); ?>"/>';
		$('#gift_cost')[0].innerHTML = '<?php echo elgg_echo('gifts:pointscost'); ?>'+Cost;
		$('#sendButton')[0].innerHTML = code;
	} else {
		var code='<?php echo elgg_echo('gifts:notenoughpoints');?>';
		$('#gift_cost')[0].innerHTML = '<?php echo elgg_echo('gifts:pointscost'); ?>'+Cost;
		$('#sendButton')[0].innerHTML = code;
	}
}

$(document).ready(function () {
	gifts_previewImage(0);
});
</script>

<form action="<?php echo $vars['url']; ?>action/gifts/sendgift<?php echo $security; ?>" method="post">

<?php

	if($useuserpoints == 1){
		echo sprintf(elgg_echo("gifts:pointssum"), $points)."<br/>";
	}

	$send_to = get_input('send_to');
	// Already send_to?
	if($send_to){
	    	//get the user object
    	        $user = get_user($send_to);

    	        //draw it
    		echo "<label>" . elgg_echo("gifts:friend") . ":</label><br/><div class=\"messages_single_icon\">" . elgg_view("profile/icon",array('entity' => $user, 'size' => 'tiny')) . $user->username;
    		echo "</div><br class=\"clearfloat\" />";
    		//set the hidden input field to the recipients guid
    	        echo "<input type=\"hidden\" name=\"send_to\" value=\"{$send_to}\" />";
	}else{

?>

    <p><label><?php echo elgg_echo('gifts:friend'); ?>: </label>
    <select name='send_to'>
    <?php
        echo "<option value=''></option>";
        foreach($vars['friends'] as $friend){
            echo "<option value='{$friend->guid}'>" . $friend->name . "</option>";
        }

    ?>
    </select></p>

    <?php
        // Add Friends Picker to send gifts to multiple firends
        /*if ($friends = get_entities_from_relationship('friend',$_SESSION['guid'],false,'user','',0,'',9999)) {
            echo elgg_view('friends/picker',array('entities' => $friends, 'internalname' => 'user_guid', 'highlight' => 'all'));
        }*/
    ?>
<?php
}
?>
<p><?php echo elgg_echo('gifts:selectgift'); ?><br />
    <select name='gift_id' onChange="gifts_previewImage(this.selectedIndex);">
<?php
    $gift_count = get_plugin_setting('giftcount'.$i, 'gifts');
    for ($i=1;$i<=$gift_count;$i++)
    {
        echo "<option value='{$i}'>".get_plugin_setting('gift_'.$i, 'gifts')."</option>";
    }
?>
    </select>
</p>

<div id="gift_cost">&nbsp;</div>
<div id="gift_preview">&nbsp;</div>

<p><?php echo elgg_echo('gifts:message'); ?><br />
<?php echo elgg_view('input/longtext',array('internalname' => 'body')); ?></p>

<p>
<div id="access">
<?php
        $access = get_default_access();
        $out = '<p><label>'.elgg_echo("access").'<br />';
        $out .= elgg_view("input/access",array('internalname' => 'access','value'=>$access));
        $out .= '</label></p>';
        echo $out;
?>
</div>
<div id="sendButton">
<?php
	if($useuserpoints == 1){
		// Only show send button if you got enough points
		echo "&nbsp;";
	} else {
	?><input type="submit" value="<?php echo elgg_echo('gifts:send'); ?>" /><?php
	}
?>
</div>
</p>

</form>

</div>