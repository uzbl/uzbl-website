<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';
require_once 'markdown-1.0.1m/markdown.php';
require_once 'phatso.inc';

$URLS = array ('/'                => 'Index',
               '/index.php/'      => 'Index',
               '/faq.php/'        => 'FAQ',
               '/readme.php/'     => 'Readme',
               '/get.php/'        => 'Get',
               '/community.php/'  => 'Community',
               '/contribute.php/' => 'Contribute',
               '/commits.php/'    => 'Commits',
               '/news.php/'       => 'News');

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

function exec_FAQ (&$app, $params) {
    $navigation = navigation ('faq.php');
    $app->set ('navigation', $navigation);
    
    $content = Markdown(file_get_contents('../uzbl/docs/FAQ'));
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Readme (&$app, $params) {
    $navigation = navigation ('readme.php');
    $app->set ('navigation', $navigation);
    
    $content = Markdown(file_get_contents('../uzbl/README'));
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Get (&$app, $params) {
    $navigation = navigation ('get.php');
    $app->set ('navigation', $navigation);
    
    $content = Markdown(file_get_contents('../uzbl/docs/INSTALL'));
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Community (&$app, $params) {
    $navigation = navigation ('community.php');
    $app->set ('navigation', $navigation);
    
    $content = Markdown(file_get_contents('../uzbl/docs/COMMUNITY'));
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Contribute (&$app, $params) {
    $navigation = navigation ('contribute.php');
    $app->set ('navigation', $navigation);
    
    $content = Markdown(file_get_contents('../uzbl/docs/CONTRIBUTING'));
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Commits (&$app, $params) {
    $navigation = navigation ('commits.php');
    $app->set ('navigation', $navigation);
        
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_News (&$app, $params) {
    $navigation = navigation ('news.php');
    $app->set ('navigation', $navigation);
    
    $app->set ('content', $content);

    $app->render ('1col.php');
}

?>
