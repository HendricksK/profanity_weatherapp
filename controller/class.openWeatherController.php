<?php

use \Curl\Curl;

class openWeatherController {

	private $openWeatherAPIKey = null;
	private $curlObject = null;

	function __construct() { 
		$config = include(DIRNAME(__FILE__) . '../../configuration/apiConfig.php');
		$this->openWeatherAPIKey = $config['openWeatherAPIKey'];
		$this->curlObject = new Curl();
	}

	public function getWeatherDataByCity($cityName) {
		//api.openweathermap.org/data/2.5/weather?q={city name}
		$response = $this->curlObject->get('http://api.openweathermap.org/data/2.5/weather?q=' . $cityName . '&appid=' . $this->openWeatherAPIKey);
		$weatherData = $response->response;
		$this->curlObject->close();
		
		return $this->getBasicWeatherForecast($weatherData);
	}

	public function displayOpenWeatherAPIKey() {
		echo $this->openWeatherAPIKey;
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