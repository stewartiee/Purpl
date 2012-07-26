<?php
/*
 * Purpl
 * Development, 0.01 
 */

define("IN_PURPL", TRUE);
require_once("inc/config.php");

/* Load General Class */
require_once(INC_DIR."class.general.php");
$General = new General;

/* Load Text Class */
require_once(INC_DIR."class.textparser.php");
$Text = new Text;

/* Load Template Class */
require_once(INC_DIR."class.template.php");
$Template = new Template;

/* Load Plugins Class */
require_once(INC_DIR."class.plugins.php");
$Plugins = new Plugins;

/* Run Global Hook */
$Plugins::Run_Hook('global_start');