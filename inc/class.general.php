<?php
/*
 * Purpl
 * Development, 0.01 
 */

if(!defined("IN_PURPL")) die("Direct execution of this file isn't allowed.");

class General {
	
	function _GetVariable($Variable = NULL, $Default = NULL) {
	
		if(ISSET($_GET[$Variable])) {
			$Variable = $_GET[$Variable]; 
		} else {
			if($Default != NULL) $Variable = $Default; else $Variable = NULL;
		}
		
		return $Variable;
	
	}

}