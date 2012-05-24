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
	
	$tab = $vars['tab'];
	$user_guid = $vars['user_guid'];
	
	$settingsselect = ''; 
	$statsselect = '';
	switch($tab) {
		case 'globalsettings':
			$listglobal = 'class="selected"';
			break;
		case 'giftsettings':
			$listgifts = 'class="selected"';
			break;
	}
	
?>
<div class="contentWrapper">
	<div id="elgg_horizontal_tabbed_nav">
		<ul>
			<li <?php echo $listglobal; ?>><a href="<?php echo $CONFIG->wwwroot . 'mod/gifts/admin.php?tab=globalsettings'; ?>"><?php echo elgg_echo('gifts:settings:globalsettings'); ?></a></li>
			<li <?php echo $listgifts; ?>><a href="<?php echo $CONFIG->wwwroot . 'mod/gifts/admin.php?tab=giftsettings'; ?>"><?php echo elgg_echo('gifts:settings:giftsettings'); ?></a></li>			
		</ul>
	</div>
<?php
	switch($tab) {
		case 'globalsettings':
			echo elgg_view("gifts/globalsettings");
			break;
		case 'giftsettings':
			echo elgg_view("gifts/giftsettings");
			break;
	}
?>
</div>
