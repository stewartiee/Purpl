<?php
/*
 * Purpl
 * Development, 0.01 
 */

define("IN_PURPL", TRUE);
require_once("inc/config.php");

/* Load Database Class */
require_once(INC_DIR."class.database.php");
$Database = new Database;

$Database->DatabaseConnect();

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