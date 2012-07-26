<?php
/*
 * Purpl
 * Development, 0.01 
 */

if(!defined("IN_PURPL")) die("Direct execution of this file isn't allowed.");

class Text {
    
    function PageContent($Identifier = NULL, $File = NULL) 
    {
        if($Identifier == NULL) die("No identifier for the page was found.");
        
        if($File == NULL) {
            $Content = "content/$Identifier/$Identifier.txt";
        } else {
            $Content = "content/$Identifier/$File.txt";
        }
        
        $PageArray = array();
        
        if(Text::_FileExists($Content)) :
        	$File = file_get_contents($Content);
        	$Sections = explode("\n------------\n", $File);
        	$CountSections = Text::_Count($Sections);
        	
        	for($i_section = 0;$i_section < $CountSections;$i_section++) {
        		$Section = $Sections[$i_section];
        		
        		$Line = explode(" :: ", $Section);
        		
        		foreach($Line as $Key => $Value) {
        			
        			if($Key == 0 and $i_section != 0) {
        				$PageArray[$Tag] = $Tag_Value;
        			}
        			
        			if($Key == 0) $Tag = str_replace(' ', '', $Value);
        			if($Key == 1) $Tag_Value = $Value;
        			
        		}
        		
        		$PageArray[$Tag] = $Tag_Value;
        	}
        	
        	return $PageArray;
        else :
            return Text::_Error404();
        endif;
    }
    
    function DynamicPage($Identifier = NULL, $Unique = 0)
    {
        if($Identifier == NULL) die("No identifier for the page was found.");
        
        $Unique = str_pad($Unique, 2, "0", STR_PAD_LEFT);

        if(Text::_FileExists("content/$Identifier/$Identifier-$Unique.txt")) :
            return json_decode(file_get_contents("content/$Identifier/$Identifier-$Unique.txt"), true);
        else :
            return Text::_Error404();
        endif;
    }
    
    function PluginContent($Identifier = NULL, $File = NULL, $View = 'index')
    {
        require('config.php');
        
        echo "Identifier = $Identifier, File = $File, View = $View";
        
        
        if($Identifier == NULL) die("No identifier for the page was found.");

		$Content = PLUGIN_DIR."$Identifier/content/$File.txt";
		
        if(Text::_FileExists($Content)) :
            
        	$File = file_get_contents($Content);
        	$Sections = explode("\n------------\n", $File);
        	$CountSections = Text::_Count($Sections);
        	
        	for($i_section = 0;$i_section < $CountSections;$i_section++) {
        		$Section = $Sections[$i_section];
        		
        		$Line = explode(" :: ", $Section);
        		
        		foreach($Line as $Key => $Value) {
        			
        			if($Key == 0 and $i_section != 0) {
        				$PageArray[$Tag] = $Tag_Value;
        			}
        			
        			if($Key == 0) $Tag = str_replace(' ', '', $Value);
        			if($Key == 1) $Tag_Value = $Value;
        			
        		}
        		
        		$PageArray[$Tag] = $Tag_Value;
        	}
        	
        	require_once(PLUGIN_DIR."$Identifier/plugin.php");
        	
        	$Plugin = new $Identifier_Plugin;
        	
        	return $Plugin->view($PageArray);
        	
        	//return $Plugin->$View($PageArray);
       	else :
            return Text::_Error404();
        endif;
    }
    
    function _Error404()
    {
        return json_decode(file_get_contents("content/errors/404.txt"), true);
    }
    
    function _FileExists($File = NULL)
    {
        if(file_exists($File)) :
            return TRUE;
        else :
            return FALSE;
        endif;
    }
    
    function _Count($Array) {
    	return count($Array);
	}
} // close class TextParse