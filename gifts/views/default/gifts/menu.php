<?php

	/**
	 * Elgg hoverover extender for gifts
	 *
	 * @package Gifts
	 */
if (isloggedin()) {
?>

	<p class="user_menu_gift">
		<a href="<?php echo $vars['url']; ?>mod/gifts/sendgift.php?send_to=<?php echo $vars['entity']->guid; ?>"><?php echo elgg_echo("gifts:send"); ?></a>
	</p>
<?php
}
?>
