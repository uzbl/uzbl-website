<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';
require_once 'markdown-1.0.1m/markdown.php';
require_once 'phatso.inc';

$URLS = array ('/'           => 'Index',
               '/index.php/' => 'Index');

$phatso = new Phatso();
$phatso->run ($URLS);

function exec_Index (&$app, $params) {
    $navigation = navigation ('/');
    
    $app->set ('navigation', $navigation);
    
    $commits  = recentcommits ('master', 7);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('experimental', 7);
    
    $app->set ('recentcommits', $commits);
    
    $news = news ((! isset ($_GET['page']) || ! is_numeric ($_GET['page'])) ? 0 : intval ($_GET['page']));
    
    $app->set ('news', $news);
    
    $app->render ('index.php');
}

?>
