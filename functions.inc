<?php
 
require_once 'markdown-1.0.1m/markdown.php';

function
getnews ($verbosity) { /* 1 = Display full body text
                          0 = Display first 1000 characters of body text
                         -1 = Display first 200 characters of body text.
                       */
    $news        = array ();
    $dir_handle  = @opendir ('news/');

    while ($file = readdir ($dir_handle)) {
        if(stristr ($file, '.txt')) {
            $filenum    = str_replace ('.txt', '', $file);
            $id         = intval ($filenum);
            $contentarr = file ("news/{$file}");
            $title      = trim ($contentarr[0]);
            $date       = trim ($contentarr[2]);

            unset ($contentarr[0]);
            unset ($contentarr[1]);
            unset ($contentarr[2]);
            unset ($contentarr[3]);

            $body = trim (implode ('', $contentarr));
            if ($verbosity == 0 and strlen ($body) > 1000) {
                $body = substr ($body, 0, 1000) . "...";
            } else if ($verbosity == -1 and strlen ($body) > 200) {
                $body = substr ($body, 0, 200) . "...";
            }

            $body = Markdown($body);

            $news[$id] = array ('id'    => $id,
                                'title' => $title,
                                'date'  => $date,
                                'body'  => $body);
          }
      }
    closedir ($dir_handle);
    return $news;
}


function
news ($page, $navlinks, $archivelink) {
    $newsarray = getnews (1);
    krsort ($newsarray);
    $news = "";

    /* Pagination */
    $newsperpage = 2;
    $gonext      = FALSE;
    $goback      = FALSE;
    $nextpage    = $page + 1;
    $lastpage    = $page - 1;
    
    /* News display */
    $count = 0;
    foreach ($newsarray as $item) {
	if ($count < ($page + 1) * $newsperpage and $count >= $page * $newsperpage) {
	    $news .= "<div class=\"newsitem\">
                <h3><a href=\"/news.php?id={$item['id']}\" title=\"{$item['title']}\">{$item['title']}</a></h3>
                <span class=\"date\">{$item['date']}</span>
                <p>{$item['body']}</p>
              </div>";
	}
	$count ++;
    }

    $gonext = ($page < ceil(count($newsarray) / $newsperpage));
    $goback = ($page != 0);
    
    $newslinks = "";
    if (($gonext or $goback) and ($navlinks or $archivelink)) {
        $newslinks = '<ul id="newslinks">';

        if ($goback and $navlinks) {
            $newslinks .= "<li><a href=\"http://www.uzbl.org/index.php?page={$lastpage}\">&laquo; Previous</a></li>";
        }

        if ($gonext and $navlinks) {
            $newslinks .= "<li><a href=\"http://www.uzbl.org/index.php?page={$nextpage}\">Next &raquo;</a></li>";
        }

        if ($archivelink) {
            $newslinks .= "<li><a href=\"http://www.uzbl.org/archives.php\">Archives</a></li>";
        }
        
        $newslinks .= '</ul>';
    }

    return $news . $newslinks;
}

function
navigation () {
    $pages = array (
        '/'              => 'Home',
        'faq.php'        => 'FAQ',
        'readme.php'     => 'Readme',
        'get.php'        => 'Get',
        'community.php'  => 'Community',
        'contribute.php' => 'Contribute',
        'https://github.com/uzbl/uzbl/issues' => 'Bugs'
    );

    $indexaliases = array ('', 'index.php', 'news.php', 'commits.php'); // These things should highlight "Home" in the navbar.
    $uri          = str_replace ('/', '', $_SERVER['REDIRECT_URL']);
    $uri          = (in_array ($uri, $indexaliases)) ? '/' : $uri;

    $output = '';
    foreach ($pages as $page => $name) {
        $id     = ($page == $uri) ? ' id="selected"' : '';
        $link   = (substr ($page, 0, 1) == '/') ? "/{$page}" : $page;
        $output = "<li{$id}><a href=\"{$page}\">{$name}</a></li>\n{$output}";
    }

    return $output;
}

function
markdown_file ($file) {
    $filecontents = file_get_contents ($file);
    //$filecontents = htmlentities      ($filecontents);
    $markdown     = Markdown          ($filecontents);

    return $markdown;
}

?>
