<?php
require 'vendor/autoload.php';

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
	    echo "IMAGES:\n\n";
	    $images = json_encode($set['imageList']);
    	print $images;
    }

    $data['Set']['lego_catalog_url'] = 'http://shop.lego.com/catalog/productLargeView.jsp?modalView=true&productCode='.$set['sku'].'&scene7Video=0&scene7Spin=0';


    print_r($data);
}
