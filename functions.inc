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
getnews () {
    $news        = array ();
    $dir_handle  = @opendir ('news/');

    while ($file = readdir ($dir_handle)) {
        if(stristr ($file, '.txt')) {
            $filenum    = str_replace ('.txt', '', $file);
            $id         = intval ($filenum);
            $contentarr = file ("news/{$file}");
            $title      = $contentarr[0];
            $date       = $contentarr[2];

            unset ($contentarr[0]);
            unset ($contentarr[1]);
            unset ($contentarr[2]);
            unset ($contentarr[3]);

            $body       = nl2br (implode ('', $contentarr));

            $news[$id] = array ('title' => $title,
                                'date'  => $date,
                                'body'  => $body);
          }
      }
    closedir ($dir_handle);
    return $news;
}
?>