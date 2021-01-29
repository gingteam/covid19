<?php

use Curl\Curl;

require 'vendor/autoload.php';

$curl = new Curl();

$curl->setHeader('X-Access-Token', '5cf9dfd5-3449-485e-b5ae-70a60e997864');

$curl->get('https://api.covid19api.com/summary');

$response = [];
foreach ($curl->response->Countries as $data) {
	$response[] = [
	  	'Country'   => $data->Country,
	  	'Total'     => $data->TotalConfirmed,
	  	'Recovered' => $data->TotalRecovered,
	  	'Deaths'    => $data->TotalDeaths,
	];
}

$curl->close();

echo json_encode($response);
