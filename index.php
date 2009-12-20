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
               '/news.php/'       => 'News',
               '/doesitwork/'     => 'doesitwork');

$phatso = new Phatso();
$phatso->run ($URLS);

function exec_doesitwork (&$app, $params) {
	$navigation = navigation ();
	$app->set ('navigation', $navigation);
	$content = '<br><br><br><br><br><br><img src="img/uzbl-logo-xmas.png" alt="Uzbl"/><br><strong>Seems like it works</strong>';
	$app->set ('content', $content);
	$app->render ('1col.php');
}

function exec_Index (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $commits  = recentcommits ('experimental', 7, false);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('master', 7, false);
    $app->set ('recentcommits', $commits);
    
    $news = news ((! isset ($_GET['page']) || ! is_numeric ($_GET['page'])) ? 0 : intval ($_GET['page']));
    $app->set ('news', $news);
    
    $app->render ('index.php');
}

function exec_FAQ (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/FAQ');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Readme (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/README');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Get (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/INSTALL');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Community (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/COMMUNITY');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Contribute (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/CONTRIBUTING');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Commits (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);

    $commits  = "<ul id=\"morecommits\">\n";
    $commits .= recentcommits ('experimental', 7, true);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('master', 7, true);
    $commits .= "</ul>\n";

    $app->set ('content', $commits);

    $app->render ('1col.php');
}

function exec_News (&$app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $newsarray = getnews (1);
    $news = "";
    
    if (isset ($newsarray[$_GET['id']])) {
        $content = "<div class=\"newsitem\">
                      <h2>{$newsarray[$_GET['id']]['title']}</h2>
                      <span class=\"date\">{$newsarray[$_GET['id']]['date']}</span>
                      <p>{$newsarray[$_GET['id']]['body']}</p>
                    </div>";
    } else {
        $content = "<div class=\"error\">News item could not be found.</div>";
    }

    $app->set ('content', $content);

    $app->render ('1col.php');
}

?>
