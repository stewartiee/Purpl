<?php
/*
 * Purpl
 * Development, 0.01 
 */

require_once('inc/global.php');

$a = GetVariable('a');

if($a == 'p') {
    $id = GetVariable('id');
    $PageContent = Text::PageContent($id);
}

if($a == NULL) {
    /* Get the homepage. */
    $PageContent = Text::PageContent('home');
}

echo Template::GeneratePage(array('content_output'), $PageContent);

?>