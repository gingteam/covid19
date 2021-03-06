<?php

use Curl\Curl;

require 'vendor/autoload.php';

$response = [];

$curl = new Curl();

$curl->get('https://maps.vnpost.vn/apps/covid19/api/patientapi/list');

foreach ($curl->response->data as $data) {
    $response['vn'][] = [
        'name'      => $data->name,
        'address'   => $data->address,
        'group'     => $data->patientGroup,
        'lat'       => $data->lat,
        'lng'       => $data->lng,
    ];
}

$curl->reset();

$curl->setHeader('X-Access-Token', '5cf9dfd5-3449-485e-b5ae-70a60e997864');
$curl->get('https://api.covid19api.com/summary');

foreach ($curl->response->Countries as $data) {
	$response['global'][] = [
	  	'country'   => $data->Country,
	  	'total'     => $data->TotalConfirmed,
	  	'recovered' => $data->TotalRecovered,
	  	'deaths'    => $data->TotalDeaths,
	];
}

$curl->close();

echo json_encode($response);
