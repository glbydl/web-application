<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Forecast Search</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- customized CSS -->
        <link href="css/mystyle.css" rel="stylesheet">

        <script type="text/javascript"></script>
    </head>

    <body>
        <h1>Forecast Search</h1>
        <div class="container-fluid">
            <div class="row main-area">
                <!-- search form -->
                <form action="forecast.php" method="get">
                    <div class="col-sm-3 streetaddress">
                        <label class="condition-label" for="street-address">Street Address:</label>
                        <label class="required" for="street-address">*</label>
                        <input id="street-address" type="text" name="streetaddress" class="form-control" placeholder="Enter street address" />
                    </div>
                    <div class="col-sm-2 city">
                        <label class="condition-label" for="city">City:</label>
                        <label class="required" for="city">*</label>
                        <input id="city" type="text" name="city" class="form-control" placeholder="Enter the city name" />
                    </div>
                    <div class="col-sm-2 state">
                        <label class="condition-label" for="state">State:</label>
                        <label class="required" for="state">*</label>
                        <select id="state" class="form-control" name="state">
                            <?php
							$stateArray = array("Select your state...", "AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
							foreach ($stateArray as $s) {
								if ($s == $state) {
									echo "<option selected='true'>" . $s . "</option>";
								} else {
									echo "<option>" . $s . "</option>";
								}
							}
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 degree">
                        <label class="condition-label" for="degree1">Degree:</label>
                        <label class="required" for="degree1">*</label>
                        <div>
                            <span class="radio-inline">
                                <input type="radio" name="degree" id="degree1" value="1" checked="" />
                                <label class="condition-label" for="degree1">Fahrenheit</label> </span>
                            <span class="radio-inline">
                                <input type="radio" name="degree" id="degree2" value="2" />
                                <label class="condition-label" for="degree2">Celsius</label> </span>
                        </div>
                    </div>
                    <div class="col-sm-2 search-clear">
                        <button id="doSearch" type="button" class="btn btn-primary">
                            <span class="glyphicon glyphicon-search" aria-hidden="true">Search</span>
                        </button>
                        <button id="doClear" type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true">Clear</span>
                        </button>
                        <br />
                        <div class="form-inline disclaimer">
                            <label class="condition-label" for="forecast-io">Powered by:</label>
                            <a href="http://forecast.io"> <img id="forecast-io" src="http://cs-server.usc.edu:45678/hw/hw8/images/forecast_logo.png" width="80px" height="50px" /> </a>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="separate-line" />
            <div class="result-area">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#right-now" data-toggle="tab">Right Now</a>
                    </li>
                    <li>
                        <a href="#next-24-hours" data-toggle="tab">Next 24 Hours</a>
                    </li>
                    <li>
                        <a href="#next-7-days" data-toggle="tab">Next 7 Days</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <!-- tab1 -->
                    <div id="right-now" class="tab-pane fade in active">
                        <div class="row">
                            <div id="right-now-left-info" class="col-sm-6">
                                <div class="row header-now">
                                    <div id="result-data" class="col-sm-12 result-data">
                                        <div class="col-sm-4 weather-image">
                                            <img id="weather-image" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="120px" height="120px">
                                        </div>
                                        <div class="col-sm-8 weather-header">
                                            <span id="header-summary">Mostly Cloudy in Los Angeles, CA</span>
                                            <br />
                                            <label id="header-temperature">10<label id="header-unit">&#8457;</label></label>
                                            <br />
                                            <div id="low-high">
                                                <span id="low-temperature">L:70&#176;</span>
                                                <span> | </span>
                                                <span id="high-temperature">H:90&#176;</span>
                                                <span>
                                                    <button id="facebook-button">
                                                        <img src="http://cs-server.usc.edu:45678/hw/hw8/images/fb_icon.png" width="30px" height="30px">
                                                    </button> </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table">
                                        <table id="data-now">
                                            <tr class="odd-line">
                                                <td class="title"> Precipitation </td>
                                                <td id="right-now-preciptation"> 123 </td>
                                            </tr>
                                            <tr class="even-line">
                                                <td class="title"> Chance of Rain </td>
                                                <td id="right-now-chance-of-rain"> 123 </td>
                                            </tr>
                                            <tr class="odd-line">
                                                <td class="title"> Wind Speed </td>
                                                <td id="right-now-wind-speed"> 123 </td>
                                            </tr>
                                            <tr class="even-line">
                                                <td class="title"> Dew Point </td>
                                                <td id="right-now-dew-point"> 123 </td>
                                            </tr>
                                            <tr class="odd-line">
                                                <td class="title"> Humidity </td>
                                                <td id="right-now-humidity"> 123 </td>
                                            </tr>
                                            <tr class="even-line">
                                                <td class="title"> Visibility </td>
                                                <td id="right-now-visibility"> 123 </td>
                                            </tr>
                                            <tr class="odd-line">
                                                <td class="title"> Sunrise </td>
                                                <td id="right-now-sunrise"> 123 </td>
                                            </tr>
                                            <tr class="even-line">
                                                <td class="title"> Sunset </td>
                                                <td id="right-now-sunset"> 123 </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="result-map">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab2 -->
                    <div class="tab-pane fade" id="next-24-hours">
                        <table class="table next-24-hours">
                            <tr class="next-24-hours-title">
                                <th>Time</th>
                                <th>Summary</th>
                                <th>Cloud Cover</th>
                                <th>Temp(<span id="next-24-hours-temp-unit">&#8457;</span>)</th>
                                <th>View Details</th>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail1" aria-expanded="false" aria-controls="collapseDetail1">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail1">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail2" aria-expanded="false" aria-controls="collapseDetail2">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail2">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail3" aria-expanded="false" aria-controls="collapseDetail3">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail3">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail4" aria-expanded="false" aria-controls="collapseDetail4">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail4">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail5" aria-expanded="false" aria-controls="collapseDetail5">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail5">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail6" aria-expanded="false" aria-controls="collapseDetail6">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail6">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail7" aria-expanded="false" aria-controls="collapseDetail7">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail7">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail8" aria-expanded="false" aria-controls="collapseDetail8">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail8">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail9" aria-expanded="false" aria-controls="collapseDetail9">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail9">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail10" aria-expanded="false" aria-controls="collapseDetail10">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail10">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail11" aria-expanded="false" aria-controls="collapseDetail11">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail11">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail12" aria-expanded="false" aria-controls="collapseDetail12">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail12">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail13" aria-expanded="false" aria-controls="collapseDetail13">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail13">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail14" aria-expanded="false" aria-controls="collapseDetail14">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail14">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail15" aria-expanded="false" aria-controls="collapseDetail15">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail15">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail16" aria-expanded="false" aria-controls="collapseDetail16">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail16">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail17" aria-expanded="false" aria-controls="collapseDetail17">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail17">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail18" aria-expanded="false" aria-controls="collapseDetail18">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail18">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail19" aria-expanded="false" aria-controls="collapseDetail19">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail19">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail20" aria-expanded="false" aria-controls="collapseDetail20">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail20">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail21" aria-expanded="false" aria-controls="collapseDetail21">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail21">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail22" aria-expanded="false" aria-controls="collapseDetail22">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail22">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail23" aria-expanded="false" aria-controls="collapseDetail23">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail23">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                            <tr class="normal">
                                <td>10:00PM</td>
                                <td><img src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="50px" height="50px"></td>
                                <td>0%</td>
                                <td>70.28</td>
                                <td><a data-toggle="collapse" href="#collapseDetail24" aria-expanded="false" aria-controls="collapseDetail24">+</a></td>
                            </tr>
                            <tr class="abnormal collapse" id="collapseDetail24">
                                <td colspan="5">
                                <table class="table next-24-hours-detail">
                                    <tr>
                                        <th>Wind</th>
                                        <th>Humidity</th>
                                        <th>Visibility</th>
                                        <th>Pressure</th>
                                    </tr>
                                    <tr>
                                        <td>4mph</td>
                                        <td>83%</td>
                                        <td>8.37mi</td>
                                        <td>1012.6mb</td>
                                    </tr>
                                </table></td>
                            </tr>
                        </table>
                    </div>
                    <!-- tab3 -->
                    <div class="tab-pane fade" id="next-7-days">
                        <div class="next-7-days-frame">
                            <div class="row">
                                <div class="col-sm-1 next-7-days extra">

                                </div>
                                <div class="col-sm-1 next-7-days d1" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d2" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d3" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d4" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d5" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d6" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-1 next-7-days d7" data-toggle="modal" data-target="#myModal">
                                    <table class="table-next-7-days">
                                        <tr>
                                            <td class="next-7-days white bold">Friday</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold">Oct 16</td>
                                        </tr>
                                        <tr>
                                            <td><img class="image-next-7-days" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png"></td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Min</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">67&#176;</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Max</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white">Temp</td>
                                        </tr>
                                        <tr>
                                            <td class="next-7-days white bold large">81&#176;</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Weather in Los Angeles on Oct 16</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <img id="modal-image" src="http://cs-server.usc.edu:45678/hw/hw8/images/clear.png" width="150px" height="150px">
                        <div>
                        	<br />
	                        <span id="modal-week">Friday:</span>
	                        <span id="modal-summary">Mostly cloudy throughout the day.</span>
                        </div>
                        <br />
                        <div class="row">
                        	<div class="col-sm-4">
                        		<p class="modal-title">Sunrise Time</p>
                        		<p id="modal-sunrise-time">07:00 AM</p>
                        	</div>
                        	<div class="col-sm-4">
                        		<p class="modal-title">Sunset Time</p>
                        		<p id="modal-sunset-time">06:19 PM</p>
                        	</div>
                        	<div class="col-sm-4">
                        		<p class="modal-title">Humidity</p>
                        		<p id="modal-humidity">80%</p>
                        	</div>
                        </div>
                        <div class="row">
                        	<div class="col-sm-4">
                        		<p class="modal-title">Wind Speed</p>
                        		<p id="modal-wind-speed">3.98mph</p>
                        	</div>
                        	<div class="col-sm-4">
                        		<p class="modal-title">Visibility</p>
                        		<p id="modal-visibility">7.22mi</p>
                        	</div>
                        	<div class="col-sm-4">
                        		<p class="modal-title">Pressure</p>
                        		<p id="modal-pressure">1012.08mb</p>
                        	</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/additional-methods.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/myjavascript.js"></script>
        <script src="http://openlayers.org/api/OpenLayers.js"></script>
    </body>
</html>
