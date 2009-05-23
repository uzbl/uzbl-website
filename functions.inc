<?php
 
require_once 'simplepie.inc';

function
getfeed ($uri) {
    $feed = new SimplePie ($uri);
 
    $feed->handle_content_type ();
    
    $items = array();
    foreach ($feed->get_items () as $item) {
        $info = array('permalink'   => $item->get_permalink (),
                      'title'       => $item->get_title (),
                      'description' => $item->get_description (),
                      'date'        => $item->get_date ('j F Y | g:i a'),
                      'date2'       => $item->get_date ('U'));
        $items[] = $info;
    }

    return $items;
}

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
            $body = nl2br (trim ($body));

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
recentcommits ($branch, $limit, $detailed) {
    $commits     = getfeed ('http://github.com/feeds/Dieterbe/commits/uzbl/' . $branch);
    $num_commits = 0;
    $output      = '';

    foreach ($commits as $commit) {
        if ($num_commits < $limit) {
            if ($detailed) {
                $output .= "<li><span class='commithead'><h3><a href='{$commit['permalink']}'>{$commit['title']}</a></h3> <span class='commitdate'>{$commit['date']}</span> <span class='branch'><a href='http://github.com/Dieterbe/uzbl/tree/experimental'>experimental</a></span></span>\n";
                $output .= "{$commit['description']}</li>\n";
            } else {
                $title = $commit['title'];
                if (strlen ($title) > 35)
                    $title = substr ($title, 0, 32) . '...';

                $output .= "<li>{$title} <span class='branch'>experimental</span></li>\n";
                $num_commits++;
            }
        }
    }

    return $output;
}


function
news ($page) {
    $newsarray = getnews (0);
    krsort ($newsarray);
    $news = "";

    /* Pagintation */
    $newsperpage = 20;
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

    return $news . $newslinks;
}

function
navigation () {
    $pages = array ('/'              => 'Home',
                    'faq.php'        => 'FAQ',
                    'readme.php'     => 'Readme',
                    'get.php'        => 'Get',
                    'community.php'  => 'Community',
                    'contribute.php' => 'Contribute',
                    'wiki/'          => 'Wiki',
                    'bugs/'          => 'Bugs');

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

?>