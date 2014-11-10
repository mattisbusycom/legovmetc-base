<?php
$set = file_get_contents('./set');

$_data = json_decode($set, true);
$_cdn_base = $data['cdnUrl'];

print "CDN URL Base: ".$_cdn_base."\n\n";

sleep(1);

foreach ($_data['content'] as $key => $set) {
	echo "Key: ".$key."\n";

	$_set_id = $data['Set']['set_id'];
	
	$data['Set']['set_id'] = $set['sku'];
	$data['Set']['title']  = $set['title'];
	$data['Set']['theme']  = $set['theme'];
	$data['Set']['subtitle']  = $set['title'];
	$data['Set']['description']  = $set['description'];
	
	$data['Set']['lego_url']     = $set['storeList'][1]['url'];
	$data['Set']['amazon_url']   = $set['storeList'][0]['url'];

	$data['Set']['main_image'] = 'http://shop.lego.com/catalog/productLargeView.jsp?modalView=true&productCode='.$_set_id.'&scene7Video=0&scene7Spin=0';

	$data['Set']['age_range'] = json_encode(array('start' => $set['ageStart'], 'end' => $set['ageEnd']));
	
	$set_json = json_encode($data['Set']);

	print_r($data);
	print json_encode($set);
	print "\n\n\n\n\n";
}
