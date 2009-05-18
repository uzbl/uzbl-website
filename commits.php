<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';
require_once 'markdown-1.0.1m/markdown.php';

$master       = getfeed ('http://github.com/feeds/Dieterbe/commits/uzbl/master');
$experimental = getfeed ('http://github.com/feeds/Dieterbe/commits/uzbl/experimental');

$commits      = array ();
$commit_limit = 50; // 50 should be enough...

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
      
      <div id="main">
        <h2>Last 20 Commits</h2>
        <ul id="morecommits">
<?php
$num_commits = 0;

foreach ($commits as $comm)
  {
    if ($num_commits < $commit_limit) {
      echo "<li>\n";
      echo "<span class='commithead'><h3><a href='{$comm['permalink']}'>{$comm['title']}</a></h3> <span class='commitdate'>{$comm['date']}</span> <span class='branch'><a href='http://github.com/Dieterbe/uzbl/tree/{$comm['branch']}'>{$comm['branch']}</a></span></span>\n";
      echo "{$comm['description']}\n";
      echo "</li>\n";
      $num_commits++;
    }
  }
?>
        </ul>
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
