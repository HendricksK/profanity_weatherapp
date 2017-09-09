<?php

class openWeatherController {

	private $openWeatherAPIKey = null;

	function __construct() { 
		$config = include_once(DIRNAME(__FILE__) . '../../configuration/apiConfig.php');
		$this->openWeatherAPIKey = $config['openWeatherAPIKey'];
	}

	public function getWeatherDataByCity($cityName) {
		//api.openweathermap.org/data/2.5/weather?q={city name}
		
		return file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $cityName . '&appid=' . $this->openWeatherAPIKey);
	}

	public function displayOpenWeatherAPIKey() {
		echo $this->openWeatherAPIKey;
		return true;
	}
	
}