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
?>