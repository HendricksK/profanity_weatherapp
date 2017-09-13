<?php 

require_once(DIRNAME(__FILE__) . '../../controller/class.openWeatherController.php');
require_once(DIRNAME(__FILE__) . '../../controller/class.darkSkyController.php');

class weatherController {

	protected $openWeather;
	protected $darkSky;

	function __construct () {
		$this->openWeather = new openWeatherController();
		$this->darkSky = new darkSkyController();
	}

	public function returnResponseByLocation($location) {
		// $response = $openWeather->getWeatherDataByCity($location);
		$weatherResponse = array (
			'openWeatherResponse' => $this->openWeather->getWeatherDataByCity($location),
			'darkSkyResponse' => $this->darkSky->getWeatherDataByCity($location)
		);

    	return $weatherResponse['openWeatherResponse'];
	}
}