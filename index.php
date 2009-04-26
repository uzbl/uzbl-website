<?php
error_reporting (E_ERROR | E_PARSE);

require_once 'functions.inc';

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

	<link rel="stylesheet" href="/template/style.css" type="text/css" />
	<!--<link rel="shortcut icon" type="application/ico" href="/favicon.ico" />
	<base href="http://www.uzbl.org/"/>-->
  </head>

  <body>
    <div id="page">
      <div id="header">
        <h1>Uzbl</h1>
        <p>The uzbl browser.</p>
      </div>
      
      <div id="navigation">
        <ul>
          <li><a href="/get.php">Get</a></li>
          <li><a href="/contribute.php">Contribute</a></li>
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
            $title = substr ($title, 0, 35) . '...';

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
            <li>dusanx
              <ol>
                <li><a href="http://github.com/dusanx/uzbl/tree/master">master</a></li>
            </ol></li>
            <li>Barrucadu
              <ol>
                <li><a href="http://github.com/Barrucadu/uzbl/tree/experimental">experimental</a></li>
            </ol></li>
          </ul>
        </div>
      </div>
      
      <div id="left">
        <div id="about">
          <h2>The uzbl browser&hellip;</h2>
          <p>&hellip;a minimal WebKit browser with vim-like commands, modes, no unnecessary interface elements (we really cracked down on those), and all controllable from a FIFO and with external scripts - what more could you want? Uzbl exists to supply a browser that follows the UNIX philosophy - &quot;Write programs that do one thing and do it well. Write programs to work together. Write programs to handle text streams, because that is a universal interface.&quot;</p>
          <p>Uzbl is under heavy development at the moment and shouldn't really be used unless as your main browser. Unless you're daring of course. The latest 'stable' branch is located in Dieterbe's master branch, and the latest development version in his experimental branch. You can, however, run code from the other developers branches, it just might not work.</p>
          <p>You can find us in IRC at irc.freenode.net, in channel #uzbl.</p>
        </div>
        
        <div id="news">
          <h2>Latest News</h2>
          
          <div class="newsitem">
            <h3>The mostly-uzbl website</h3>
            <span class="date">2009-04-26</span>
            <p>Uzbl now has a website, while there isn't much on it right now, I have a TODO list of features to implement. Like a news RSS feed. Possibly a simple forum in the future. Whatever. So, this will serve as the project's home page from now on :)</p>
          </div>          
        </div>
      </div>
    </div>
  </body>
</html>
