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
        
        if(Text::_FileExists($Content)) :
            return json_decode(file_get_contents($Content), true);
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
} // close class TextParse