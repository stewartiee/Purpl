<?php
/*
 * Purpl
 * Development, 0.01 
 */

/* Load Global Configuration */
require_once('inc/global.php');

$a = $General::_GetVariable('a'); // a = action
$i = $General::_GetVariable('i', 'home'); // i = index
$f = $General::_GetVariable('f', 'index'); // f = function (used for plugins mostly)

if($a == 'page') {

    $PageContent = Text::PageContent($i);
    
    echo Template::GeneratePage(array('content_output'), $PageContent);
    
} elseif($a == 'plugin') {

	$PluginContent = Text::PluginContent($i, $f, $f);

	echo $PluginContent;
	
}