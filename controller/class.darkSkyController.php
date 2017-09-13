<?php

class darkSkyController {

	private $darkSkyAPIKey = null;
	private $curlObject = null;

	function __construct() { 
		$config = include_once(DIRNAME(__FILE__) . '../../configuration/apiConfig.php');
		$this->darkSkyAPIKey = $config['darkSkyAPIKey'];
		$this->curlObject = new Curl\Curl();
	}

	public function getWeatherDataByCity($cityName) {
		//https://api.darksky.net/forecast/ed844c0e55668d72dc1d7634a338c961/37.8267,-122.4233
		var_dump($this->darkSkyAPIKey);
		die;
		$response = $this->curlObject->get('https://api.darksky.net/forecast/ed844c0e55668d72dc1d7634a338c961/37.8267,-122.4233');
		var_dump($response->response);
		die;	
		$weatherData = $response;
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