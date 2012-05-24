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

	// only logged in users
	gatekeeper();
        action_gatekeeper();

	// get the form input
	$receiver = get_input('send_to');
	$gift_id = get_input('gift_id');
	$body = get_input('body');
	$cost = get_input('giftcost');
        $access = get_input('access');

	$sender = get_entity(get_loggedin_userid());

	// Userpoints
	$useuserpoints  = get_plugin_setting('useuserpoints', 'gifts');
	if($useuserpoints == 1 && function_exists('userpoints_subtract')) {
		$pTemp = userpoints_get(get_loggedin_userid());
		$points = $pTemp['approved'];

		// Set new Point Value
		if(userpoints_subtract(get_loggedin_userid(), $cost, 'Gifts')) {
			system_message(elgg_echo('gifts:pointsuccess'));
		}else{
			system_message(elgg_echo('gifts:pointfail'));
		}
	}

	// No Friend selected?
	if (empty($receiver) || empty($gift_id)) {
		register_error(elgg_echo("gifts:blank"));
		forward("pg/gifts/".$sender->name."/sendgift");
	}

	// create a gifts object
	$gift = new ElggObject();
	$gift->description = $body;
	$gift->receiver = $receiver;
	$gift->gift_id = $gift_id;
	$gift->subtype = "gift";

        $gift->access_id = $access;

	$gift->owner_guid = get_loggedin_userid();

	// save to database
	$gift->save();

	$sender = get_entity(get_loggedin_userid());
	$msgto = get_entity($receiver);

	// send mail notification
	global $CONFIG;
	notify_user($msgto->getGUID(), $sender->getGUID(), elgg_echo('gifts:mail:subject'),
		sprintf(
					elgg_echo('gifts:mail:body'),
					$sender->name,
					$CONFIG->wwwroot . "pg/gifts/" . $msgto->username . "/index"
				)
	);


	// Add to river
	add_to_river('river/object/gifts/create','gifts',$gift->owner_guid,$gift->receiver);
        system_message(elgg_echo('gifts:sendok'));
	// display gift
	forward($gift->getURL());
?>