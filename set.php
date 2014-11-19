<?php
require 'vendor/autoload.php';
$params = array();
$params['hosts'] = array('http://54.68.196.181:9200');
$client = new Elasticsearch\Client($params);

// Create the index

$_set = file_get_contents('./set');

$pley = json_decode($_set, true);
$pley_cdn_url = $data['cdnUrl'];

foreach ($pley['content'] as $key => $set)
{
    $data['set_id']     = $set['sku'];
    $data['theme']      = $set['theme'];

    $data['Set']['name']        = $set['title'];
    $data['Set']['price']       = $set['price'];
    $data['Set']['description'] = $set['description'];

    $data['Set']['age_start'] = $set['ageStart'];
    $data['Set']['age_end']   = $set['ageEnd'];
    $data['Set']['gender']    = $set['gender'];

    $images = $set['imageList']; 
    if (array_key_exists('at1x', $images['main'])) {
    	foreach ($images['main']['at1x'] as $picture) {
		print "PATH: ".$picture."\n";
		//$data['Set']['image_urls'][] = $picture['path'];
   	}
    }

    $stores = $set['storeList'];
    if (array_key_exists('0', $stores)) {
	$data['Set']['LegoStore'][] = array('retailer' => $stores[0]['name'], 'link' => $stores[0]['url']);
    }
    if (array_key_exists('1', $stores)) {
	$data['Set']['LegoStore'][] = array('retailer' => $stores[1]['name'], 'link' => $stores[1]['url']);
    }
}
