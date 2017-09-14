<?php

use \Curl\Curl;

class darkSkyController {

	private $darkSkyAPIKey = null;
	private $curlObject = null;

	function __construct() { 
		$config = include(DIRNAME(__FILE__) . '../../configuration/apiConfig.php');
		$this->darkSkyAPIKey = $config['darkSkyAPIKey'];
		$this->curlObject = new Curl();
	}

	public function getWeatherDataByCity($cityName) {
		
		$response = $this->curlObject->get('https://api.darksky.net/forecast/' . $this->darkSkyAPIKey . '/37.8267,-122.4233');
		$weatherData = $response->response;
		$this->curlObject->close();
		
		return $weatherData;
		// return $this->getBasicWeatherForecast($weatherData);
	}

	public function displayOpenWeatherAPIKey() {
		echo $this->darkSkyAPIKey;
		return true;
	}

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