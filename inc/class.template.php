<?php
/*
 * Purpl
 * Development, 0.01 
 */

class Template {
    
    function GeneratePage($AdditionalBlocks = array(), $Tags = array())
    {
        $Page = $this->GetBlock('header', $Tags);
        
        foreach($AdditionalBlocks as $Block)
        {
            $Page .= $this->GetBlock($Block, $Tags);
        }
        
        $Page .= $this->GetBlock('footer', $Tags);
        
        return $Page;
    }
    
    function GetBlock($Name = NULL, $Tags = array())
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
            return $this->_ParseBlock($BlockContent, $Tags);
        } else {
            return $BlockContent;
        }
    }
    
    
    function _ParseBlock($Block, $TagsArray = array())
    {
        $ParsedContent = '';
        foreach($TagsArray as $Tag => $Val) {
            $Block = str_replace('{'.$Tag.'}', $Val, $Block);
        }
        
        return $Block;
    }
    
} // close class Template