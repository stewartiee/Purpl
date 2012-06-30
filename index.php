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

?>ere' => 'id = '.$id));
}

if($a == NULL) {
    /* Get Page Content */
    $PageArray = $Database->GetSingleRow('pages',array('*'),array('where' => 'id = 1'));
}

$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$endtime = $mtime;
$totaltime = substr(($endtime - $starttime), 0, 10);

$ScriptExecution = "This page was created in ".$totaltime." seconds with a total of ".$Database->QueryCount." queries executed";

echo $Template->GeneratePage(array(), array('Title' => $PageArray['title'], 'Content' => $PageArray['content'], 'ScriptExecution' => $ScriptExecution));

?>