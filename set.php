<?php
require 'vendor/autoload.php';
$params = array();
$params['hosts'] = array (
    'http://localhost:9200'
);



$client = new Elasticsearch\Client($params);

// Mapping
/*
$legoSetMapping = array(
    '_source' => array('enabled' => true),
	'properites' => array(
		'set_id' => array('type' => 'integer'),
		'name' => array('type' => 'string')
	)
);
$indexParams['body']['mappings']['set'] = $legoSetMapping;

// Create the index
$indexParams['index'] = 'pley_com';
$client->indices()->create($indexParams);
*/

$set = file_get_contents('./set');

$_data = json_decode($set, true);
$_cdn_base = $_data['cdnUrl'];

print "CDN URL Base: ".$_cdn_base."\n\n";

foreach ($_data['content'] as $key => $set)
{
    $_pley_id = $set['id'];
    
    $data['Set']['box_set_id'] = $set['sku'];
    $data['Set']['title']  = $set['title'];
    $data['Set']['subtitle']  = $set['title'];
    $data['Set']['description']  = $set['description'];
    
    $data['Set']['theme']  = $set['theme'];

    $data['Set']['age_start'] = $set['ageStart'];
    $data['Set']['age_end']   = $set['ageEnd'];
    $data['Set']['gender']    = $set['gender'];

    $images = $set['imageList'];

    $data['Set']['image_list_json'] = json_encode($set['imageList']);
    $data['Set']['store_list_json'] = json_encode($set['storeList']);

    print_r($data);

    $params = array();
    $params['body'] = $data['Set'];

    $params['index'] = 'pley_com';
    $params['type']  = 'lego_set';

    $params['id'] = $data['Set']['box_set_id'];

    // Index this Set to pley_hack/set/[box set id]
    $ret = $client->index($params);
    
    print "Indexed ".$data['Set']['box_set_id'].", Return from ElasticSearch was:\n ".print_r($ret)."\n\n";
}
