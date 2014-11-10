<?php
require 'vendor/autoload.php';

$layer2 = new Elasticsearch\Client();
$params = array();
$params['index'] = 'pley';
$params['type']  = 'sets';

$set = file_get_contents('./set');

$_data = json_decode($set, true);
$_cdn_base = $data['cdnUrl'];

print "CDN URL Base: ".$_cdn_base."\n\n";

foreach ($_data['content'] as $key => $set)
{
    $_set_id = $data['Set']['set_id'];

    $data['Set']['set_id'] = $set['sku'];
    $data['Set']['title']  = $set['title'];
    $data['Set']['theme']  = $set['theme'];
    $data['Set']['subtitle']  = $set['title'];
    $data['Set']['description']  = $set['description'];

    // Age Range
    $data['Set']['age_start'] = $set['ageStart'];
    $data['Set']['age_end']   = $set['ageEnd'];

    if (is_array($set['imageList']))
    {
	    echo "images:\n\n";
	    $images = json_encode($set['imagelist']);
            foreach ($set['imagelist'] as $img) {
                $data['Set']['main_image'] = ''.$_cdn_base.''.$img['path'].'';
            }
    }

    $params = array();
    $params['index'] = 'pley';
    $params['type']  = 'sets';	

    $params['body'] = $data['Set'];
 
}
