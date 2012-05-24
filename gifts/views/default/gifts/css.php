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
?>


.user_menu_gift {
margin:0;
padding:0;
}

#gift_preview {
    /* Container for Gift Preview Image */
}

.river_user_gifts {
    background:transparent url(<?php echo $vars['url']; ?>mod/gifts/river_icon_gifts.gif) no-repeat scroll left -1px;
}

/* Gifts Widget */
.gifts_widget_wrapper {
	background-color: white;
	margin:0 10px 5px 10px;
	padding:5px;
	min-height:35px;
	-webkit-border-radius: 8px; 
	-moz-border-radius: 8px;
}
.gifts_widget_icon {
	float: left;
	margin-right: 10px;
}
.gifts_timestamp {
	color:#666666;
	margin:0;
}
.gifts_desc {
	display:none;
	line-height: 1.2em;
}
.gifts_widget_content {
	margin-left: 35px;
}
.gifts_title {
	margin:0;
	line-height: 1.2em;
}
