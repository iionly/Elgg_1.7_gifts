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



	// Start engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	$area2 = elgg_view_title(elgg_echo('gifts:allgifts'));
        // Show All gifts enabled?
	if(get_plugin_setting('showallgifts', 'gifts') == 1) {
	  $area2 .= elgg_list_entities(array('types' => 'object', 'subtypes' => 'gift'));
	}

	set_context('gifts');

	// Format page
	$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);

	// Draw it
	echo page_draw(elgg_echo('gifts:allgifts'),$body);
?>