<?php

require_once(DIRNAME(__FILE__) . '/class.locationController.php');

use \Curl\Curl;

class darkSkyController {

	private $darkSkyAPIKey 		= null;
	private $curlObject 		= null;
	private $locationController = null; 

	function __construct() { 
		$config 					= include(DIRNAME(__FILE__) . '../../configuration/apiConfig.php');
		$this->darkSkyAPIKey 		= $config['darkSkyAPIKey'];
		$this->curlObject 			= new Curl();
		$this->locationController 	= new locationController();
	}

	/*
	* Argument $cityname
	* calls api to get data
	* calls function to return 
	* profanity string
	* returns profanity string
	*/
	public function getWeatherDataByCity($cityName) {
		$latLong = $this->locationController->getCoordinatesFromCityName($cityName);
		$response = $this->curlObject->get('https://api.darksky.net/forecast/' . $this->darkSkyAPIKey . '/' . $latLong);
		$weatherData = $response->response;
		$this->curlObject->close();
		
		return $weatherData;
		// return $this->getBasicWeatherForecast($weatherData);
	}

	/*
	* Argument $cityname
	* returns APIKEY when needed
	*/
	private function displayOpenWeatherAPIKey() {
		echo $this->darkSkyAPIKey;
		return true;
	}

	/*
	* Argument $weatherData
	* returns profanity string
	*/
	private function getBasicWeatherForecast($weatherData) {
		$data = json_decode($weatherData);
		
		$currentStatus = $data->weather;
		$statusString = null;

		if(count($currentStatus) > 1) {
			foreach($currentStatus as $status) {
				switch($status->main) {
					case 'Rain':
					$statusString .= ' raining and '; 
					break;
					case 'Thunderstorm':
					$statusString .= ' thundering and ';
					break;
					case 'Clear':
					$statusString .= ' clear and ';
					break;
					default:
					$statusString .= 0;
				}
			}
		} else {
			$statusString .= strtolower($currentStatus[0]->main);
		}

		if(!empty($statusString)) {
			$statusString = rtrim($statusString, ' and ');
			return 'It is currently fucking ' . $statusString . ' in ' . $data->name;
		}

		return 'Sorry I could get not get fucking anything back';
		
	}
	
}