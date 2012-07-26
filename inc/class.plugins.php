<?php
/*
 * Purpl
 * Development, 0.01 
 */

if(!defined("IN_PURPL")) die("Direct execution of this file isn't allowed.");

class Plugins {
    
    
    function Run_Hook($Name = NULL)
    {
        if($Name == 'global_start') {
            include(INC_DIR."plugins/hello_world/hello_world.php");
        }
    }
    
    
} // close class Plugins