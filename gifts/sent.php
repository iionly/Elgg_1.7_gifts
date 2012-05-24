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

	// Show your sent gifts

	// Start engine
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	$area2 = elgg_view_title(elgg_echo('gifts:sent'));

       	$user_guid = get_loggedin_userid();

        $area2 .= elgg_list_entities(array('types' => 'object', 'subtypes' => 'gift', 'owner_guids' => $user_guid));

	set_context('gifts');

	// Format page
	$body = elgg_view_layout('two_column_left_sidebar', $area1, $area2);

	// Draw it
	echo page_draw(elgg_echo('gifts:yourgifts'),$body);
?>