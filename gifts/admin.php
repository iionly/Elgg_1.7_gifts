<?php
	include_once dirname(dirname(dirname(__FILE__))) . "/engine/start.php";

	global $CONFIG;

        admin_gatekeeper();

	set_context('admin');
	set_page_owner($_SESSION['guid']);

	$tab = get_input('tab') ? get_input('tab') : 'globalsettings';
        $user_guid = get_input('user_guid');

	$body = elgg_view_title(elgg_echo('gifts:settings:title'));

	$body .= elgg_view("admin/gifts", array('tab' => $tab, 'user_guid' => $user_guid));

	page_draw(elgg_echo('gifts:settings:title'), elgg_view_layout("two_column_left_sidebar", '', $body));

?>
