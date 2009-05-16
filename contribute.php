<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<meta name="keywords" content="uzbl, browser, open source"/>
	<meta name="description" content="Uzbl is a lightweight webkit browser following the UNIX philosophy - to do one thing and do it well."/>
	<meta name="author" content="Michael Walker"/>
	<meta name="robots" content="FOLLOW,INDEX"/>

	<title>Contribute to Uzbl</title>


	<link rel="stylesheet" href="/template/style.css" type="text/css" />
    <link rel="alternate" type="application/atom+xml" title="Uzbl News" href="/atom.xml" />
	<!--<link rel="shortcut icon" type="application/ico" href="/favicon.ico" />-->
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
          <li><a href="/faq.php">Faq</a></li>
          <li><a href="/get.php">Get</a></li>
          <li id="selected"><a href="/contribute.php">Contribute</a></li>
          <li><a href="/">Home</a></li>
        </ul>
      </div>
      
      <div id="main">
         <?php
            require_once 'markdown-1.0.1m/markdown.php';
            echo Markdown(file_get_contents('../uzbl/docs/CONTRIBUTING'));?>
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
