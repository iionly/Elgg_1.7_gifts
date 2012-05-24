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

    /*
     * Initialize Plugin
     */
    function gifts_init() {
      global $CONFIG;

      // Set Plugin Version for Update Checks
      set_plugin_setting('version', '0.2.0', 'gifts');

      register_translations($CONFIG->pluginspath . "gifts/languages/");
      // Show in Menu
      if (isloggedin()) {
        add_menu(elgg_echo('gifts:menu'), $CONFIG->wwwroot."pg/gifts/" . $_SESSION['user']->username . "/index");
      }

      // hide menu in admin area
      if (get_context() != 'admin') {
	if (get_context() == "gifts") {
	  add_submenu_item(elgg_echo('gifts:yourgifts'),$CONFIG->wwwroot."pg/gifts/" . $_SESSION['user']->username . "/index");

	  // Show all gifts?
	  if(get_plugin_setting('showallgifts', 'gifts') == 1) {
	    add_submenu_item(elgg_echo('gifts:allgifts'),$CONFIG->wwwroot."pg/gifts/" . $_SESSION['user']->username . "/all");
	  }

	  add_submenu_item(elgg_echo('gifts:sent'),$CONFIG->wwwroot."pg/gifts/" . $_SESSION['user']->username . "/sent");
	  add_submenu_item(elgg_echo('gifts:sendgifts'),$CONFIG->wwwroot."pg/gifts/" . $_SESSION['user']->username . "/sendgift");
        }
      }

      // Add Widget
      add_widget_type('gifts',elgg_echo("gifts:widget"),elgg_echo("gifts:widget:description"));

      register_page_handler('gifts','gifts_page_handler');
      register_entity_url_handler('gifts_url','object','gifts');
      extend_view('profile/menu/links','gifts/menu');
      extend_view('css','gifts/css');
    }

    function gifts() {
      if (!@include_once(dirname(dirname(__FILE__))) . "/gifts/index.php") return false;
      return true;
    }

    /*
     * Page Handler
     */
    function gifts_page_handler($page) {
      if (isset($page[0])) {
	set_input('username',$page[0]);
      }

      if (isset($page[1])) {
	switch($page[1]) {
	  case "read":  set_input('guid',$page[2]);
			@include(dirname(dirname(dirname(__FILE__))) . "/index.php"); return true;
			break;
	  case "index":	@include(dirname(__FILE__) . "/index.php"); return true;
			break;
	  case "sent":	@include(dirname(__FILE__) . "/sent.php"); return true;
			break;
	  case "sendgift": @include(dirname(__FILE__) . "/sendgift.php"); return true;
			   break;
	  case "all": @include(dirname(__FILE__) . "/all.php"); return true;
		      break;
	}
      } else {
	@include(dirname(__FILE__) . "/index.php");
	return true;
      }

      return false;
    }

    /*
     * URL Handler
     */
    function gifts_url($entity) {
      global $CONFIG;
      $title = $entity->title;
      $title = friendly_title($title);
      return $CONFIG->url . "pg/gifts/" . $entity->getOwnerEntity()->username . "/read/".$entity->getGUID();
    }

    /*
     * Create Admin Menu
     */
    function gifts_adminmenu() {
      global $CONFIG;
      if (get_context() == 'admin' && isadminloggedin()) {
	add_submenu_item(elgg_echo('gifts:settings:title'), $CONFIG->url . "mod/gifts/admin.php");
      }
    }

    register_elgg_event_handler('init','system','gifts_init');
    register_elgg_event_handler('pagesetup','system','gifts_adminmenu');
    register_action("gifts/settings", false, $CONFIG->pluginspath . "gifts/actions/savesettings.php");
    register_action("gifts/savegifts", false, $CONFIG->pluginspath . "gifts/actions/savegifts.php");
    register_action("gifts/sendgift", false, $CONFIG->pluginspath . "gifts/actions/send.php");

?>