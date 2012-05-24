<?php

	//Load Plugin Settings
	$plugin = find_plugin_settings('gifts');

	$showallgifts	= $plugin->showallgifts;
	$useuserpoints  = $plugin->useuserpoints;
	$giftcount	= $plugin->giftcount;

        $ts = time();
        $token = generate_action_token($ts);
        $security = "?__elgg_token=$token&__elgg_ts=$ts";
	$action = $vars['url'] . 'action/gifts/savegifts' . $security;

	if($useuserpoints == 1 && function_exists('userpoints_get')) {
		$pTemp = userpoints_get(get_loggedin_userid());
		$points = $pTemp['approved'];
	}

	$form = "<input type=\"hidden\" name=\"giftcount\" value=\"$giftcount\" />";
        $gift_count = $giftcount;
        for ($i=1;$i<=$gift_count;$i++) {
            $form .= "<h2>".elgg_echo('gifts:settings:title')." #$i</h2>";
            $form .= elgg_view('input/text',array('internalname'=>'params[gift_'.$i.']','value'=>get_plugin_setting('gift_'.$i, 'gifts')));

            if ($useuserpoints == 1) {
                $form .= elgg_echo('gifts:settings:userpoints')." #$i";
                $form .= elgg_view('input/text',array('internalname'=>'params[giftpoints_'.$i.']','value'=>get_plugin_setting('giftpoints_'.$i, 'gifts')));
                if (function_exists('userpoints_delete')) {}
                //$form .= elgg_echo('gifts:settings:code')." #$i";
                //$form .= elgg_view('input/longtext',array('internalname'=>'params[giftcode_'.$i.']','value'=>get_plugin_setting('giftcode_'.$i, 'gifts')));
            }

            //elgg_view("input/file",array('internalname' => 'icon'))
            $form .= elgg_echo('gifts:settings:image')." #$i<br/>";
            $form .= elgg_view('input/file',array('internalname'=>'giftimage_'.$i));

            // Show Image if already uploaded
            $imgfile = dirname(dirname(dirname(dirname(__FILE__))))."/images/gift_".$i.".jpg";
            //$form .= $imgfile;
            if (file_exists($imgfile)) {
                $form .= '<img src="'.$vars['url'].'mod/gifts/images/gift_'.$i.'_medium.jpg" /><br/>';
            }

        }

    $form .= "<br><br>".elgg_view('input/submit', array('value' => elgg_echo("save")));
    $form .= "</p>";
    echo elgg_view('input/form', array('action' => $action, 'enctype'=>"multipart/form-data"  ,'body' => $form));

?>