// the back up of current search condition and result
var cityBK = "";
var stateBK = "";
var unitBK = "";
var summaryBK = "";
var temperatureBK = "";
var objBK;

window.fbAsyncInit = function() {
	FB.init({
		appId : '474389022745556',
		xfbml : true,
		version : 'v2.5'
	});
}; ( function(d, s, id) {
		var js,
		    fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {
			return;
		}
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

// This is called with the results from FB.getLoginStatus().
function statusChangeCallback(response) {
	if (response.status === 'connected') {
		// pop up the feed dialog
		facebookFeed();
	} else {
		FB.login(function(response) {
			if (response.authResponse) {
				facebookFeed();
			}
		});
	}
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	});
}

function facebookFeed() {
	FB.ui({
		method : 'feed',
		name : "Current Weather in " + cityBK + ", " + stateBK,
		link : 'http://forecast.io/',
		caption : "WEATHER INFORMATION FROM FORCAST.IO",
		picture : $("#weather-image").attr("src"),
		description : summaryBK + ", " + temperatureBK + unitBK,
	}, function(response) {
		if (response) {
			if (!response.error_message) {
				alert("Posted Successfully");
			} else {
				alert("Not Posted");
			}
		}
	});
}

// add the rule for select
$.validator.addMethod("valueNotEquals", function(value, element, arg) {
	return arg != value;
}, "Value must not equal arg.");

// configure validation
$("form").validate({
	rules : {
		streetaddress : "required",
		city : "required",
		state : {
			valueNotEquals : "Select your state..."
		}
	},
	messages : {
		streetaddress : "Please enter the street address",
		city : "Please enter the city",
		state : {
			valueNotEquals : "Please select a state"
		}
	},
	highlight : function(element) {
		$(element).parent().addClass('error');
	},
	unhighlight : function(element) {
		$(element).parent().removeClass('error');
	}
});

// execute the search function
$("#doSearch").on("click", function() {
	// validate the input data
	if (!$("form").valid()) {
		return;
	}

	// back up
	cityBK = $("#city").val();
	stateBK = $("#state").val();
	
	refresh();
	
	// ajax request
	$.ajax({
		url : "forecast.php",
		type : "GET",
		data : {
			streetAddress : $("#street-address").val(),
			city : $("#city").val(),
			state : $("#state").val(),
			degree : $("input:radio[name='degree']:checked").val()
		},
		success : function(response) {
			// display the result of "right now" tab
			displayRightNow(response);
		},
		error : function(response) {
			showError();
		}
	});

});

// display the result of "right now" tab
function displayRightNow(response) {

	// get json file object
	var obj = JSON.parse(response);
	if (!obj) {
		return;
	}

	// back up
	objBK = obj;

	// set value for tab "Right Now"
	setValueForRightNow(obj);

	// set value for tab "Next 24 Hours"
	setValueForNext24Hours(obj);

	// set value for tab "Next 7 Days"
	setValueForNext7Days(obj);
	
	if ($("#myTab").css("display") == "none") {
		$("#myTab").show();
	}
	
	if ($("#right-now-left-info").css("display") == "none") {
		$("#right-now-left-info").show();
	}
	
	// create weather map
	var lat = obj.latitude;
	var lng = obj.longitude;
	createWeatherMap(lng, lat);
}

function showError() {
	$('.nav-tabs a:first').tab('show');
	$("#myTab").hide();
	$("#right-now-left-info").hide();
	$("#result-map").empty();
	alert("Error happens. Please check your search conditions.");
}

// clear all the conditions value and search result
$("#doClear").on("click", function() {
	$("#street-address").val("");
	$("#city").val("");
	$("#state").val("Select your state...");
	$("#degree1").prop('checked', true);
	$("#degree2").prop('checked', false);
	$('.nav-tabs a:first').tab('show');
	$("#myTab").hide();
	$("#right-now-left-info").hide();
	$("#result-map").empty();
});

function refresh() {
	$('.nav-tabs a:first').tab('show');
	$("#right-now-left-info").hide();
	$("#result-map").empty();
}

function createWeatherMap(lng, lat) {
	$("#result-map").empty();

	var fromProjection = new OpenLayers.Projection("EPSG:4326");
	// Transform from WGS 1984
	var toProjection = new OpenLayers.Projection("EPSG:900913");
	// to Spherical Mercator Projection
	var position = new OpenLayers.LonLat(lng, lat).transform(fromProjection, toProjection);

	var map = new OpenLayers.Map("result-map");
	// Create OSM overlays
	var mapnik = new OpenLayers.Layer.OSM();

	var layer_cloud = new OpenLayers.Layer.XYZ(
		"clouds", 
		"http://${s}.tile.openweathermap.org/map/clouds/${z}/${x}/${y}.png", 
		{
			isBaseLayer : false,
			opacity : 0.5,
			sphericalMercator : true
		}
	);

	var layer_precipitation = new OpenLayers.Layer.XYZ(
		"precipitation", 
		"http://${s}.tile.openweathermap.org/map/precipitation/${z}/${x}/${y}.png", 
		{
			isBaseLayer : false,
			opacity : 0.5,
			sphericalMercator : true
		}
	);

	map.addLayers([mapnik, layer_precipitation, layer_cloud]);
	map.setCenter(position, 9);
}


$(".col-sm-1.next-7-days").on("click", function() {
	var elemDiv = $(this);
	var className = elemDiv.attr("class");
	var temp = className.split("d");
	var index = temp[temp.length - 1];
	var objDaily = objBK.daily.data[index];
	var imageUrlPrefix = "http://cs-server.usc.edu:45678/hw/hw8/images/";
	var iconName = getIconName(objDaily.icon);
	var tempTime = getSunriseAndSunsetTime(objDaily.sunriseTime, objDaily.sunsetTime, objBK.timezone).split(",");
	var sunriseTime = tempTime[0];
	var sunsetTime = tempTime[1];
	var elemTd = document.getElementsByClassName(className)[0].getElementsByTagName("td");
	var windSpeedUnit = "";
	var visibilityUnit = "";
	var pressureUnit = "";
	if (unitBK == "&#8457;") {
		windSpeedUnit = "mph";
		visibilityUnit = "mi";
		pressureUnit = "mb";
	} else {
		windSpeedUnit = "m/s";
		visibilityUnit = "km";
		pressureUnit = "hpa";
	}

	$("#myModalLabel").html("Weather in " + cityBK + " on " + elemTd[1].innerHTML);
	$("#modal-image").attr("src", imageUrlPrefix + iconName);
	$("#modal-week").html(elemTd[0].innerHTML + ":");
	$("#modal-summary").html(objBK.daily.summary);
	$("#modal-sunrise-time").html(sunriseTime);
	$("#modal-sunset-time").html(sunsetTime);
	$("#modal-humidity").html(objDaily.humidity * 100 + "%");
	$("#modal-wind-speed").html(objDaily.windSpeed + windSpeedUnit);
	$("#modal-visibility").html(objDaily.visibility == undefined ? "N/A" : (objDaily.visibility + visibilityUnit));
	$("#modal-pressure").html(objDaily.pressure + pressureUnit);
});

function getSunriseAndSunsetTime(sunrise, sunset, timezone) {
	var result;
	// ajax request
	$.ajax({
		url : "timezone.php",
		type : "GET",
		async : false,
		data : {
			sunrise : sunrise,
			sunset : sunset,
			timezone : timezone
		},
		success : function(response) {
			result = response;
		},
		error : function() {
			showError();
		}
	});
	return result;
}

function getIconName(icon) {
	var iconName = "";
	switch(icon) {
	case "clear-day":
		iconName = "clear.png";
		break;
	case "clear-night":
		iconName = "clear_night.png";
		break;
	case "rain":
		iconName = "rain.png";
		break;
	case "snow":
		iconName = "snow.png";
		break;
	case "sleet":
		iconName = "sleet.png";
		break;
	case "wind":
		iconName = "wind.png";
		break;
	case "fog":
		iconName = "fog.png";
		break;
	case "cloudy":
		iconName = "cloudy.png";
		break;
	case "partly-cloudy-day":
		iconName = "cloud_day.png";
		break;
	case "partly-cloudy-night":
		iconName = "cloud_night.png";
		break;
	}
	return iconName;
}

function getWordOfMonth(month) {
	var monthWord = new Array(11);
	monthWord[0] = "Jan";
	monthWord[1] = "Feb";
	monthWord[2] = "Mar";
	monthWord[3] = "Apr";
	monthWord[4] = "May";
	monthWord[5] = "Jun";
	monthWord[6] = "Jul";
	monthWord[7] = "Aug";
	monthWord[8] = "Sep";
	monthWord[9] = "Oct";
	monthWord[10] = "Nov";
	monthWord[11] = "Dec";
	return monthWord[month];
}

function getWordOfWeek(week) {
	var weekday = new Array(7);
	weekday[0] = "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";
	return weekday[week];
}

// set value for tab "Right Now"
function setValueForRightNow(obj) {
	var objCurrently = obj.currently;
	var objDaily = obj.daily;
	var objHourly = obj.hourly;
	var objMinutely = obj.minutely;
	var arrayDailyData = objDaily.data;
	var iconName = getIconName(objCurrently.icon);
	var imageUrlPrefix = "http://cs-server.usc.edu:45678/hw/hw8/images/";

	var temperatureUnit;
	var windSpeedUnit;
	var dewPointUnit;
	var visibilityUnit;
	var pressureUnit;
	if ($("input:radio[name='degree']:checked").val() == 1) {
		temperatureUnit = "&#8457;";
		windSpeedUnit = "mph";
		dewPointUnit = "&#8457;";
		visibilityUnit = "mi";
		pressureUnit = "mb";
	} else {
		temperatureUnit = "&#8451;";
		windSpeedUnit = "m/s";
		dewPointUnit = "&#8451;";
		visibilityUnit = "km";
		pressureUnit = "hpa";
	}
	// back up
	unitBK = temperatureUnit;
	summaryBK = objCurrently.summary;
	temperatureBK = Math.round(objCurrently.temperature);

	$("#weather-image").attr("src", imageUrlPrefix + iconName);
	$("#header-summary").html(objCurrently.summary + " in " + $("#city").val() + ", " + $("#state").val());
	$("#header-temperature").html(Math.round(objCurrently.temperature) + '<label id="header-unit"></label>');
	$("#header-unit").html(temperatureUnit);
	var objDailyData = arrayDailyData[0];
	$("#low-temperature").html("L:" + Math.round(objDailyData.temperatureMin) + "&#176;");
	$("#high-temperature").html("H:" + Math.round(objDailyData.temperatureMax) + "&#176;");
	switch(true) {
	case (objCurrently.precipIntensity >= 0 && objCurrently.precipIntensity < 0.002):
		$("#right-now-preciptation").html("None");
		break;
	case (objCurrently.precipIntensity >= 0.002 && objCurrently.precipIntensity < 0.017):
		$("#right-now-preciptation").html("Very Light");
		break;
	case (objCurrently.precipIntensity >= 0.017 && objCurrently.precipIntensity < 0.01):
		$("#right-now-preciptation").html("Light");
		break;
	case (objCurrently.precipIntensity >= 0.01 && objCurrently.precipIntensity < 0.4):
		$("#right-now-preciptation").html("Moderate");
		break;
	case (objCurrently.precipIntensity >= 0.4):
		$("#right-now-preciptation").html("Heavy");
		break;
	}
	$("#right-now-chance-of-rain").html(Math.round(objCurrently.precipProbability * 100) + "%");
	$("#right-now-wind-speed").html(objCurrently.windSpeed + windSpeedUnit);
	$("#right-now-dew-point").html(objCurrently.dewPoint + dewPointUnit);
	$("#right-now-humidity").html(Math.round(objCurrently.humidity * 100) + "%");
	$("#right-now-visibility").html(objCurrently.visibility + visibilityUnit);
	var arraySun = getSunriseAndSunsetTime(objDailyData.sunriseTime, objDailyData.sunsetTime, obj.timezone);
	var arraySunTemp = arraySun.split(",");
	$("#right-now-sunrise").html(arraySunTemp[0]);
	$("#right-now-sunset").html(arraySunTemp[1]);
}

// set value for tab "Next 24 Hours"
function setValueForNext24Hours(obj) {
	var objHourly = obj.hourly.data;
	var temperatureUnit;
	var windSpeedUnit;
	var dewPointUnit;
	var visibilityUnit;
	var pressureUnit;
	if ($("input:radio[name='degree']:checked").val() == 1) {
		temperatureUnit = "&#8457;";
		windSpeedUnit = "mph";
		visibilityUnit = "mi";
		pressureUnit = "mb";
	} else {
		temperatureUnit = "&#8451;";
		windSpeedUnit = "m/s";
		visibilityUnit = "km";
		pressureUnit = "hpa";
	}
	$("#next-24-hours-temp-unit").html(temperatureUnit);
	for (var i = 0; i < 24; i++) {
		var normalTd = document.getElementsByClassName("normal")[i].getElementsByTagName("td");
		var time = getSunriseAndSunsetTime(objHourly[i + 1].time, objHourly[i + 1].time, obj.timezone);
		var temp = time.split(",");
		var iconName = getIconName(objHourly[i + 1].icon);
		var imageUrlPrefix = "http://cs-server.usc.edu:45678/hw/hw8/images/";
		normalTd[0].innerHTML = temp[0];
		normalTd[1].getElementsByTagName("img")[0].setAttribute("src", imageUrlPrefix + iconName);
		normalTd[2].innerHTML = objHourly[i + 1].cloudCover + "%";
		normalTd[3].innerHTML = objHourly[i + 1].temperature;

		var abnormalTd = document.getElementsByClassName("table next-24-hours-detail")[i].getElementsByTagName("td");
		abnormalTd[0].innerHTML = objHourly[i + 1].windSpeed + windSpeedUnit;
		abnormalTd[1].innerHTML = objHourly[i + 1].humidity*100 + "%";
		abnormalTd[2].innerHTML = objHourly[i + 1].visibility + visibilityUnit;
		abnormalTd[3].innerHTML = objHourly[i + 1].pressure + pressureUnit;
	}

}

// set value for tab "Next 7 Days"
function setValueForNext7Days(obj) {
	var objDaily = obj.daily.data;
	for (var i = 0; i < 7; i++) {
		var elemTd = document.getElementsByClassName("table-next-7-days")[i].getElementsByTagName("td");
		var date = new Date();
		date.setTime(objDaily[i + 1].time * 1000);
		var month = getWordOfMonth(date.getMonth());
		var day = date.getDate();
		var weekday = getWordOfWeek(date.getDay());
		var iconName = getIconName(objDaily[i + 1].icon);
		var imageUrlPrefix = "http://cs-server.usc.edu:45678/hw/hw8/images/";
		elemTd[0].innerHTML = weekday;
		elemTd[1].innerHTML = month + " " + day;
		elemTd[2].getElementsByTagName("img")[0].setAttribute("src", imageUrlPrefix + iconName);
		elemTd[5].innerHTML = Math.round(objDaily[i + 1].temperatureMin) + "&#176";
		elemTd[8].innerHTML = Math.round(objDaily[i + 1].temperatureMax) + "&#176";
	}
}


$("#facebook-button").on("click", function() {
	checkLoginState();
});
