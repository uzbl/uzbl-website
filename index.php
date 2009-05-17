<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';
require_once 'markdown-1.0.1m/markdown.php';
/* ***** Commit messages ***** */
$master       = getfeed ('http://github.com/feeds/Dieterbe/commits/uzbl/master');
$experimental = getfeed ('http://github.com/feeds/Dieterbe/commits/uzbl/experimental');

$commits      = array ();
$commit_limit = 15; // Only show the 15 most recent commits.

/* BEGIN ugly method */
foreach ($master as $commit)
{
    $commits[$commit['date2']]           = $commit;
    $commits[$commit['date2']]['branch'] = 'master';
}
foreach ($experimental as $commit)
{
    $commits[$commit['date2']]           = $commit;
    $commits[$commit['date2']]['branch'] = 'experimental';
}
ksort ($commits, SORT_NUMERIC);
$commits = array_reverse ($commits);
/* END ugly method - there has to be a better way of doing that */

/* ***** News ***** */
$newsarray = getnews (0);
krsort($newsarray);
$news = "";

/* Pagintation */
$newsperpage = 20;
$page        = (! isset ($_GET['page']) || ! is_numeric ($_GET['page'])) ? 0 : intval ($_GET['page']);
$gonext      = FALSE;
$goback      = FALSE;
$nextpage    = $page + 1;
$lastpage    = $page - 1;

for ($i = ($page * $newsperpage) + $newsperpage; $i < $newscount; $i ++) {
    unset ($newsarray[$i]);
    $gonext = TRUE;
}

if ($page > 0) {
  for ($i = 0; $i < $page * $newsperpage and $i < $newscount; $i ++) {
        unset ($newsarray[$i]);
        $goback = TRUE;
    }
}

/* News display */
foreach ($newsarray as $item) {
    $news .= "<div class=\"newsitem\">
                <h3><a href=\"/news.php?id={$item['id']}\" title=\"{$item['title']}\">{$item['title']}</a></h3>
                <span class=\"date\">{$item['date']}</span>
                <p>{$item['body']}</p>
              </div>";
}

$newslinks = "";
if ($gonext or $goback) {
    $newslinks = '<ul id="newslinks">';
    if ($gonext) {
        $newslinks .= "<li><a href=\"http://www.uzbl.org/index.php?page={$nextpage}\">Next &raquo;</a></li>";
    }

    if ($goback) {
        $newslinks .= "<li><a href=\"http://www.uzbl.org/index.php?page={$lastpage}\">Previous &laquo;</a></li>";
    }
    $newslinks .= '</ul>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<meta name="keywords" content="uzbl, browser, open source"/>
	<meta name="description" content="Uzbl is a lightweight webkit browser following the UNIX philosophy - to do one thing and do it well."/>
	<meta name="author" content="Michael Walker"/>
	<meta name="robots" content="FOLLOW,INDEX"/>

	<title>Uzbl - the uzbl browser.</title>

	<link rel="stylesheet" href="/template/<?php echo (! isset ($_GET['css'])) ? "style" : $_GET['css']; ?>.css" type="text/css" />
    <link rel="alternate" type="application/atom+xml" title="Uzbl News" href="/atom.xml" />
	<link rel="shortcut icon" type="image/png" href="/favicon.png" />
	<base href="http://www.uzbl.org/"/>
  </head>

  <body>
    <div id="page">
      <div id="header">
        <img src="img/uzbl-logo.png" />
        <p>The uzbl browser.</p>
      </div>
      
      <div id="navigation">
        <ul>
          <li><a href="/bugs/">Bugs</a></li>
          <li><a href="/contribute.php">Contribute</a></li>
          <li><a href="/get.php">Get</a></li>
          <li><a href="/readme.php">Readme</a></li>
          <li><a href="/faq.php">Faq</a></li>
          <li id="selected"><a href="/">Home</a></li>
        </ul>
      </div>
      
      <div id="right">
        <div id="commits">
          <h2>Recent Commits</h2>
          <ul>
<?php
$num_commits = 0;

foreach ($commits as $comm)
{
    if ($num_commits < $commit_limit) {
        $title = $comm['title'];
        if (strlen ($title) > 35)
            $title = substr ($title, 0, 32) . '...';

        echo "<li>{$title} <span class='branch'>{$comm['branch']}</span></li>\n";
        $num_commits++;
    }
}
?>
          </ul>
        </div>
        
        <div id="branches">
          <h2>Branches</h2>
          <ul>
            <li>Dieterbe
              <ol>
                <li><a href="http://github.com/Dieterbe/uzbl/tree/master">master</a></li>
                <li><a href="http://github.com/Dieterbe/uzbl/tree/experimental">experimental</a></li>
            </ol></li>
            <li>Anydot
              <ol>
                <li><a href="http://github.com/anydot/uzbl/tree/experimental">experimental</a></li>
            </ol></li>
            <li>Barrucadu
              <ol>
                <li><a href="http://github.com/Barrucadu/uzbl/tree/experimental">experimental</a></li>
            </ol></li>
            <li>Dusanx
              <ol>
                <li><a href="http://github.com/dusanx/uzbl/tree/master">master</a></li>
            </ol></li>
            <li>Rob M
              <ol>
                <li><a href="http://github.com/robm/uzbl/tree/experimental">experimental</a></li>
            </ol></li>
          </ul>
        </div>
      </div>
      
      <div id="left">
        <div id="about">
          <h2>The uzbl browser&hellip;</h2>
          <p>&hellip;a keyboard controlled (modal vim-like bindings, or with modifier keys) browser based on Webkit.</p>
          <p>very minimal interface.  No unnecessary interface elements</p>
          <p>controllable through a FIFO and with external scripts.</p>
          <p>what is not browsing, is not in uzbl.  Things like url changing, loading/saving of bookmarks, saving history,.. are handled through <b>external</b> scripts that you write</p>
          <p>Uzbl keeps it simple, and puts <b>you</b> in charge.</p>
          <p>Uzbl follows the UNIX philosophy - &quot;Write programs that do one thing and do it well. Write programs to work together. Write programs to handle text streams, because that is a universal interface.&quot;</p>
          <p>Uzbl is under heavy development at the moment and shouldn't really be used as your main browser. Unless you're daring of course. The latest 'stable' branch is located in Dieterbe's master branch, and the latest development version in his experimental branch. You can, however, run code from the other developers branches, it just might not work.</p>
          <p>You can find us in IRC at irc.freenode.net, in channel #uzbl.</p>
        </div>
        
        <div id="news">
          <h2>Latest News</h2>
<?php
echo $news;
echo $newslinks;
?>          
        </div>
      </div>
    </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4514522-11");
pageTracker._trackPageview();
} catch(err) {}</script>
  </body>
</html>
