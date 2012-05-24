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
	global $CONFIG;  
	$settings_url = $CONFIG->wwwroot . 'mod/gifts/admin.php?tab=globalsettings';

?>

<p>
<a href="<?php echo $settings_url; ?>"><?php echo elgg_echo('gifts:settings:title'); ?></a>
</p>
