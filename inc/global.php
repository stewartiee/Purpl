<?php
/*
 * Purpl
 * Development, 0.01 
 */

define("IN_PURPL", TRUE);
require_once("inc/config.php");

/* Load Text Class */
require_once(INC_DIR."class.textparser.php");
$Text = new Text;

/* Load Template Class */
require_once(INC_DIR."class.template.php");
$Template = new Template;

/* Load Plugins Class */
require_once(INC_DIR."class.plugins.php");
$Plugins = new Plugins;


function GetVariable($Name = NULL) {
    if(isset($_GET[$Name])) $Get = $_GET[$Name]; else $Get = NULL;
    return $Get;
}