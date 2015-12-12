<?php
	// get parameter from index.php
	$streetAddress = $_GET["streetAddress"];
	$city = $_GET["city"];
	$state = $_GET["state"];
	$degree = $_GET["degree"] == "1" ? "us" : "si";
	
	// create google map request url
	$xmlUrl = "";
	$xmlUrl = $xmlUrl . "https://maps.google.com/maps/api/geocode/xml?address=";
	$xmlUrl = $xmlUrl . $streetAddress . ",";
	$xmlUrl = $xmlUrl . $city . ",";
	$xmlUrl = $xmlUrl . $state ."&";
	$xmlUrl = $xmlUrl . "key=AIzaSyBmwgxzI2-T97WARLzC_o-jSQVxYoz0_jU";
	
	// get xml file from url
	$xmlDoc = simplexml_load_file($xmlUrl);
	if(!$xmlDoc){
		$response = "error";
		echo $response;
		exit;
	}
	
	// get latitude and longitude from geocode xml
	$latitude = $xmlDoc->result->geometry->location->lat;
	$longitude = $xmlDoc->result->geometry->location->lng;
	
	// create forecast.io request url
	$jsonUrl = "";
	$jsonUrl = $jsonUrl . "https://api.forecast.io/forecast/";
	$jsonUrl = $jsonUrl . "4a655a5f5b0b795dff2e2e9a46c3790c/";
	$jsonUrl = $jsonUrl . $latitude . ",";
	$jsonUrl = $jsonUrl . $longitude . "?";
	$jsonUrl = $jsonUrl . "units=" . $degree . "&";
	$jsonUrl = $jsonUrl . "exclude=flags";
	
	// get json file from url
	$jsonContent = file_get_contents($jsonUrl);
	if (!$jsonContent) {
		$response = "error";
		echo $response;
		exit;
	}
	$jsonDoc = json_decode($jsonContent);
	/*
	// get table value
	$timezone = $jsonDoc->timezone;
	$summary = $jsonDoc->currently->summary;
	$temperature = $jsonDoc->currently->temperature;
	$icon = $jsonDoc->currently->icon;
	$precipIntensity = $jsonDoc->currently->precipIntensity;
	$precipProbability = $jsonDoc->currently->precipProbability;
	$windSpeed = $jsonDoc->currently->windSpeed;
	$dewPoint = $jsonDoc->currently->dewPoint;
	$humidity = $jsonDoc->currently->humidity;
	$visibility = $jsonDoc->currently->visibility;
	$sunriseTime = $jsonDoc->daily->data[0]->sunriseTime;
	$sunsetTime = $jsonDoc->daily->data[0]->sunsetTime;
	$temperatureMax = $jsonDoc->daily->data[0]->temperatureMax;
	$temperatureMin = $jsonDoc->daily->data[0]->temperatureMin;
	
	// set icon image array
	$iconImg = array("clear-day" => "clear.png",
						"clear-night" => "clear_night.png",
						"rain" => "rain.png",
						"snow" => "snow.png",
						"sleet" => "sleet.png",
						"wind" => "wind.png",
						"fog" => "fog.png",
						"cloudy" => "cloudy.png",
						"partly-cloudy-day" => "cloud_day.png",
						"partly-cloudy-night" => "cloud_night.png");
	
	// set precipitation array
	$precipitationWord = "";					
	switch ($precipIntensity) {
		case $precipIntensity >= 0 && $precipIntensity < 0.002:
			$precipitationWord = "None";
			break;
		case $precipIntensity >= 0.002 && $precipIntensity < 0.017:
			$precipitationWord = "Very Light";
			break;
		case $precipIntensity >= 0.017 && $precipIntensity < 0.1:
			$precipitationWord = "Light";
			break;
		case $precipIntensity >= 0.1 && $precipIntensity < 0.4:
			$precipitationWord = "Moderate";
			break;
		case $precipIntensity >= 0.4:
			$precipitationWord = "Heavy";
			break;
		default:
			$precipitationWord = "Data Error";
			break;
	}
 */
    $response = $latitude . "," . $longitude;
	echo $jsonContent;
?>