<?php
/*
 * Purpl
 * Development, 0.01 
 */

class Template {
    
    function GeneratePage($AdditionalBlocks = array(), $Tags = array())
    {
        $Page = Template::GetBlock('header', $Tags);
        
        foreach($AdditionalBlocks as $Block)
        {
            $Page .= Template::GetBlock($Block, $Tags);
        }
        
        $Page .= Template::GetBlock('footer', $Tags);
        
        return $Page;
    }
    
    function GetBlock($Name = NULL, $Tags = array(), $Refine = FALSE)
    {
        
        if($Name == NULL) die("No block name was passed."); else require('config.php');
        
        /* Load our theme.xml for the current theme. */
        $theme_xml = simplexml_load_file(THEME_DIR.$Config['default_theme']."/theme.xml");
  
        foreach($theme_xml->block as $block)
        {
            if($block['name'] == $Name) {
                $BlockContent = (string)$block;
            }
        }
        
        if(count($Tags) > 0) {
            return Template::_ParseBlock($BlockContent, $Tags);
        } else {
            if($Refine == TRUE) {
                return Template::_ParseBlock($BlockContent);
            } else {
                return $BlockContent;    
            }
        }
    }
    
    
    function _ParseBlock($Block, $TagsArray = array())
    {
        foreach($TagsArray as $Tag => $Val) {
            $Block = str_replace('{'.$Tag.'}', $Val, $Block);
        }

        $Block = preg_replace('/{B:(\w+)}/e', '$1', $Block);
        
        return $Block;
    }
    
} // close class Template