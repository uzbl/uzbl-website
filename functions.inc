<?php
 
require_once 'simplepie.inc';

function
getfeed ($uri)
{
    $feed = new SimplePie ($uri);
 
    $feed->handle_content_type ();
    
    $items = array ();
    foreach ($feed->get_items () as $item)
    {
        $info = array ('permalink'   => $item->get_permalink (),
                       'title'       => $item->get_title (),
                       'description' => $item->get_description (),
                       'date'        => $item->get_date ('j F Y | g:i a'),
                       'date2'       => $item->get_date ('U'));
        $items[] = $info;
    }

    return $items;
}

?>