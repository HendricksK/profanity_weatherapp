<?php 

require_once(DIRNAME(__FILE__) . '../../controller/class.openWeather.php');

class weatherController {
	function __construct () {

	}

	public function returnResponseByLocation($location) {
		$openWeather = new openWeatherController();
		// $response = $openWeather->getWeatherDataByCity($location);
		
		$weatherResponse = array (
			'openWeatherResponse' => $openWeather->getWeatherDataByCity($location)
		);

    	return $weatherResponse['openWeatherResponse'];
	}
}