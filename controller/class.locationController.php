<?php

use \Curl\Curl;

class locationController {

	private $curlObject = null;
	private $baseUrl 	= 'http://maps.googleapis.com/maps/api/geocode/json?address=';

	function __construct() {
		$this->curlObject = new Curl();
	}

	public function getCoordinatesFromCityName($cityname) {
		$latLong = null;
		// http://maps.googleapis.com/maps/api/geocode/json?address=Bangalore
		$response = json_decode(file_get_contents($this->baseUrl . $cityname));
		$latLong .= $response->results[0]->geometry->location->lat . ',';
		$latLong .= $response->results[0]->geometry->location->lng;
		return $latLong;
	}

}