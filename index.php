<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';
require_once 'markdown-1.0.1m/markdown.php';
require_once 'phatso.inc';

$URLS = array ('/'                => 'Index',
               '/index.php/'      => 'Index',
               '/archives.php/'   => 'Archives',
               '/faq.php/'        => 'FAQ',
               '/readme.php/'     => 'Readme',
               '/keybindings.php/'=> 'Keybindings',
               '/get.php/'        => 'Get',
               '/community.php/'  => 'Community',
               '/contribute.php/' => 'Contribute',
               '/commits.php/'    => 'Commits',
               '/news.php/'       => 'News',
               '/doesitwork/.*'   => 'doesitwork',
               '/fosdem2010/.*'   => 'fosdem2010');

$phatso = new Phatso();
$phatso->run ($URLS);

function exec_doesitwork ($app, $params) {
	$navigation = navigation ();
	$app->set ('navigation', $navigation);

	$content  = '<h1 style="text-align: center;">Seems like it works!</h1>';
	$content .= '<h2>Next Steps</h2><ul>';
	$content .= "<li>Take a look at the <a href='http://uzbl.org/keybindings.php'>keybinding cheat sheet</a></li>";
	$content .= '<li>Explore the example configuration (<kbd>~/.config/uzbl/config</kbd>)</li>';
	$content .= "<li>If you're using uzbl-tabbed, edit the config to select a different <kbd>NEW_WINDOW</kbd> event handler so windows open in a new tab (search the config for <kbd>NEW_WINDOW</kbd>)</li>";
	$content .= '</ul>';

	$app->set ('content', $content);
	$app->render ('1col.php');
}

function exec_Index ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $commits  = recentcommits ('next', 7, false);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('experimental', 7, false);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('master', 7, false);
    $app->set ('recentcommits', $commits);
    
    $news = news ((! isset ($_GET['page']) || ! is_numeric ($_GET['page'])) ? 0 : intval ($_GET['page']), False, True);
    $app->set ('news', $news);
    
    $app->render ('index.php');
}

function exec_Archives ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);

    $newsarray = getnews (1);
    krsort ($newsarray);
    $news = "";

    /* News display */
    $count = 0;
    foreach ($newsarray as $item) {
	$news .= "<div class=\"news\">
                <h3><a href=\"/news.php?id={$item['id']}\" title=\"{$item['title']}\">{$item['title']}</a></h3>
                <span class=\"date\">{$item['date']}</span>
                <p>{$item['body']}</p>
              </div>";
    }

    $app->set ('content', $news);
    $app->render ('1col.php');
}

function exec_FAQ ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/FAQ.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Readme ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/README.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Keybindings ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/KEYBINDINGS.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Get ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/INSTALL.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Community ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/COMMUNITY.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Contribute ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);
    
    $content = markdown_file('../uzbl/docs/CONTRIBUTING.md');
    $app->set ('content', $content);

    $app->render ('1col.php');
}

function exec_Commits ($app, $params) {
    $navigation = navigation ();
    $app->set ('navigation', $navigation);

    $commits  = "<ul id=\"morecommits\">\n";
    $commits .= recentcommits ('next', 7, true);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('experimental', 7, true);
    $commits .= "<li><hr /></li>\n";
    $commits .= recentcommits ('master', 7, true);
    $commits .= "</ul>\n";

    $app->set ('content', $commits);

    $app->render ('1col.php');
}

function exec_News ($app, $params) {
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

function exec_fosdem2010 ($app, $params) {
  $_GET['id'] = 25;
  exec_News ($app, $params);
}

?>
