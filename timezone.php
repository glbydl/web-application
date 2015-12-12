<?php
	$sunrise = $_GET["sunrise"];
	$sunset = $_GET["sunset"];
	$timezone = $_GET["timezone"];
	// set default timezone
	date_default_timezone_set($timezone);
	// return sunrise + sunset
	echo date("h:i A" ,$sunrise) . "," . date("h:i A" ,$sunset);
?>