<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) { //user logging in
        require 'login.php';
    } elseif (isset($_POST['register'])) { //user registering
        require 'register.php';
    }
}


// Check if user is logged in using the session variable
if ($_SESSION['logged_in'] != 1) {
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("location: map.php");
} else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
    $admin = $_SESSION['admin'];
    ?>
    <!DOCTYPE HTML>
    <html>
        <style>
            /* Always set the map height explicitly to define the size of the div
                 * element that contains the map. */
            #map
            {
                width:100%;
                height:600px;
                border:thin solid black;

            }
            /* Optional: Makes the sample page fill the window. */

            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }


            #origin-input,
            #destination-input {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 200px;
            }

            #origin-input:focus,
            #destination-input:focus {
                border-color: #4d90fe;
            }

            #mode-selector {
                color: #fff;
                background-color: #4d90fe;
                margin-left: 12px;
                padding: 5px 11px 0px 11px;
            }

            #mode-selector label {
                font-family: Roboto;
                font-size: 13px;
                font-weight: 300;
            }

            #dkit_content img

            {

                clear:both;

                float:left;

                width: 150px;

                border-radius:100px;

                margin: 20px;

                margin-top:0px;

                border:thin solid #CCC;
                

            }
            .name_lastname
        {
            float: right;
            padding: 10px;
        }
        .button2
        {
            background-color: rgb(104, 152, 204);
        }
        </style>
        <head>
            <meta charset="utf-8">
            <title>Map Information</title>
            <link rel="icon" href="logo.jpg">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="Html5TemplatesDreamweaver.com">

            <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="scripts/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <!-- Icons -->
            <link href="scripts/icons/general/stylesheets/general_foundicons.css" media="screen" rel="stylesheet" type="text/css" />  
            <link href="scripts/icons/social/stylesheets/social_foundicons.css" media="screen" rel="stylesheet" type="text/css" />
            <!--[if lt IE 8]>
                <link href="scripts/icons/general/stylesheets/general_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
                <link href="scripts/icons/social/stylesheets/social_foundicons_ie7.css" media="screen" rel="stylesheet" type="text/css" />
            <![endif]-->
            <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome.min.css">
            <!--[if IE 7]>
                <link rel="stylesheet" href="scripts/fontawesome/css/font-awesome-ie7.min.css">
            <![endif]-->

            <link href="scripts/carousel/style.css" rel="stylesheet" type="text/css" /><link href="scripts/camera/css/camera.css" rel="stylesheet" type="text/css" />
            <link href="scripts/wookmark/css/style.css" rel="stylesheet" type="text/css" />	<link href="scripts/yoxview/yoxview.css" rel="stylesheet" type="text/css" />

            <link href="http://fonts.googleapis.com/css?family=Syncopate" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
            <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

            <link href="styles/custom.css" rel="stylesheet" type="text/css" />	
<script>
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            var map;
            var infowindow;




            function initMap() {

                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(success, error);
                } else {
                    alert('location not supported');
                }

//callbacks
                function error(msg) {
                    alert('error in geolocation');
                }

                function success(position) {
                    var lats = position.coords.latitude;
                    var lngs = position.coords.longitude;

                    document.getElementById("myField").value = lats + ", " + lngs;

                }
                ;

                var pyrmont = {lat: 53.98485693, lng: -6.39410164};

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15,
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]

                });

                directionsDisplay.setMap(map);

                var onChangeHandler = function () {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                };
                document.getElementById('start').addEventListener('change', onChangeHandler);
                document.getElementById('end').addEventListener('change', onChangeHandler);


                new AutocompleteDirectionsHandler(map);

            }

            var dkit_contentString;

            var CONTENT = 0;

            var LATITUDE = 1;

            var LONGITUDE = 2;

            var locations = [];



            var location_marker;




            function ajaxLoadMapDetails()

            {

                var fileName = "getMapDetails.php";  /* name of file to send request to */

                var method = "POST";                     /* use POST method */

                var urlParameterStringToSend = "";           /* Construct a url parameter string to POST to fileName */


                var http_request;

                if (window.XMLHttpRequest)

                {

                    // code for IE7+, Firefox, Chrome, Opera, Safari

                    http_request = new XMLHttpRequest();

                } else

                {

                    // code for IE6, IE5

                    http_request = new ActiveXObject("Microsoft.XMLHTTP");

                }


                http_request.onreadystatechange = function ()

                {

                    if ((http_request.readyState === 4) && (http_request.status === 200))

                    {

                        read_http_request_data(http_request.responseText);

                    }

                };

                http_request.open(method, fileName, true);

                http_request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                http_request.send(urlParameterStringToSend);


                function read_http_request_data(responseText)

                {

                    var jsonData = JSON.parse(responseText);



                    for (var i = 0; i < jsonData.length; i++)

                    {

                        locations.push(['<div id="dkit_content"><h1>' + jsonData[i].title + '</h1><div id="content"><img src = "'+jsonData[i].image+'"><p>' + jsonData[i].content + '</p></div></div>', parseFloat(jsonData[i].latitude), parseFloat(jsonData[i].longitude)]);



                    }







                    map = new google.maps.Map(document.getElementById('map'),
                            {zoom: 7,
                                styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ],
                                center: new google.maps.LatLng(53.98485693, -6.39410164),
                                mapTypeId: google.maps.MapTypeId.ROADMAP});


                    location_marker;

                    infowindow = new google.maps.InfoWindow();


                    for (var i = 0; i < locations.length; i++)

                    {

                        location_marker = new google.maps.Marker({position: new google.maps.LatLng(locations[i][LATITUDE], locations[i][LONGITUDE]),
                            map: map});


                        google.maps.event.addListener(location_marker, 'click', (function (location_marker, i)

                        {

                            return function ()

                            {

                                infowindow.setContent(locations[i][CONTENT]);

                                infowindow.open(map, location_marker);

                            }

                        })(location_marker, i));

                    }

                }

            }

            function hotels() {
                var pyrmont = {lat: 53.98485693, lng: -6.39410164};

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15,
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]
                });
                
                


                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: pyrmont,
                    radius: 1000,
                    name: ["hotel"]
                }, callback);
            }

            function hospitals() {
                var pyrmont = {lat: 53.98485693, lng: -6.39410164};

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15,
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]
                });
                
                

                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: pyrmont,
                    radius: 1000,
                    name: ["hospital"]
                }, callback);
            }
            
            function parkings() {
                var pyrmont = {lat: 53.98485693, lng: -6.39410164};

                map = new google.maps.Map(document.getElementById('map'), {
                    center: pyrmont,
                    zoom: 15,
                    styles: [
                        {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                        {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
                        {
                            featureType: 'administrative.locality',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'geometry',
                            stylers: [{color: '#263c3f'}]
                        },
                        {
                            featureType: 'poi.park',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#6b9a76'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry',
                            stylers: [{color: '#38414e'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#212a37'}]
                        },
                        {
                            featureType: 'road',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#9ca5b3'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry',
                            stylers: [{color: '#746855'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'geometry.stroke',
                            stylers: [{color: '#1f2835'}]
                        },
                        {
                            featureType: 'road.highway',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#f3d19c'}]
                        },
                        {
                            featureType: 'transit',
                            elementType: 'geometry',
                            stylers: [{color: '#2f3948'}]
                        },
                        {
                            featureType: 'transit.station',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#d59563'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'geometry',
                            stylers: [{color: '#17263c'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.fill',
                            stylers: [{color: '#515c6d'}]
                        },
                        {
                            featureType: 'water',
                            elementType: 'labels.text.stroke',
                            stylers: [{color: '#17263c'}]
                        }
                    ]
                });
                
                

                infowindow = new google.maps.InfoWindow();
                var service = new google.maps.places.PlacesService(map);
                service.nearbySearch({
                    location: pyrmont,
                    radius: 1000,
                    name: ["parking"]
                }, callback);
            }


            function callback(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    for (var i = 0; i < results.length; i++) {
                        createMarker(results[i]);
                    }
                }
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });

                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.setContent(place.name);
                    infowindow.open(map, this);
                });
            }

            function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                directionsService.route({
                    origin: document.getElementById('start').value,
                    destination: document.getElementById('end').value,
                    travelMode: 'DRIVING'
                }, function (response, status) {
                    if (status === 'OK') {
                        directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }
            function AutocompleteDirectionsHandler(map) {
                this.map = map;
                this.originPlaceId = null;
                this.destinationPlaceId = null;
                this.travelMode = 'WALKING';
                var originInput = document.getElementById('origin-input');
                var destinationInput = document.getElementById('destination-input');
                var modeSelector = document.getElementById('mode-selector');
                this.directionsService = new google.maps.DirectionsService;
                this.directionsDisplay = new google.maps.DirectionsRenderer;
                this.directionsDisplay.setMap(map);

                var originAutocomplete = new google.maps.places.Autocomplete(
                        originInput, {placeIdOnly: true});
                var destinationAutocomplete = new google.maps.places.Autocomplete(
                        destinationInput, {placeIdOnly: true});

                this.setupClickListener('changemode-walking', 'WALKING');
                this.setupClickListener('changemode-transit', 'TRANSIT');
                this.setupClickListener('changemode-driving', 'DRIVING');

                this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
                this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

                this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
                this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
                this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
            }
// Sets a listener on a radio button to change the filter type on Places
            // Autocomplete.
            AutocompleteDirectionsHandler.prototype.setupClickListener = function (id, mode) {
                var radioButton = document.getElementById(id);
                var me = this;
                radioButton.addEventListener('click', function () {
                    me.travelMode = mode;
                    me.route();
                });
            };

            AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function (autocomplete, mode) {
                var me = this;
                autocomplete.bindTo('bounds', this.map);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    if (!place.place_id) {
                        window.alert("Please select an option from the dropdown list.");
                        return;
                    }
                    if (mode === 'ORIG') {
                        me.originPlaceId = place.place_id;
                    } else {
                        me.destinationPlaceId = place.place_id;
                    }
                    me.route();
                });

            };

            AutocompleteDirectionsHandler.prototype.route = function () {
                if (!this.originPlaceId || !this.destinationPlaceId) {
                    return;
                }
                var me = this;

                this.directionsService.route({
                    origin: {'placeId': this.originPlaceId},
                    destination: {'placeId': this.destinationPlaceId},
                    travelMode: this.travelMode
                }, function (response, status) {
                    if (status === 'OK') {
                        me.directionsDisplay.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            };
        </script>
        </head>
        <body id="pageBody">

            <div id="divBoxed" class="container">

    <?php if ($active) { ?>

                    <div class="name_lastname">
        <?php echo $first_name . " " . $last_name . " || " . $email . " || "; ?>
                        <a href="logout.php"><button class="button2" name="logout"/>Log Out</button></a>

                    </div>

                <?php }
                ?>

                <div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

                <div class="divPanel notop nobottom">
                    <div class="row-fluid">
                        <div class="span12">					

                            <!--Edit Site Name and Slogan here-->
                            <div id="divLogo">
                                <a href="index.php" id="divSiteTitle">Tourism In Ireland</a><br />
                                <a href="index.php" id="divTagLine">Marketing the island of Ireland overseas</a>
                            </div>

                        </div>
                    </div> 

                    <div class="row-fluid">
                        <div class="span12">				
                            <div class="centered_menu">                      
                                <!--Edit Navigation Menu here-->
                                <div class="navbar">
                                    <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                                        NAVIGATION <span class="icon-chevron-down icon-white"></span>
                                    </button>
                                    <div class="nav-collapse collapse">
                                        <ul class="nav nav-pills ddmenu">
                                            <li class="dropdown">
                                                <a href="index.php" class="dropdown-toggle">Home </a>

                                            </li>								
                                            <li class="dropdown active">
                                                <a href="map.php" class="dropdown-toggle">Map </a>

                                            </li>
                                            
    <?php
    // Keep reminding the user this account is not active, until they activate
    if (!$active) {
        ?>
                                                <li class="dropdown-toggle"><a href="contact.php">Profile</a></li>
    <?php
    } else {
        ?>
                                                <li class="dropdown-toggle"><a href="profile.php">Profile</a></li>
                                            <?php }
                                            ?>
                                            <?php if ($admin) { ?>
                                                <li class="dropdown-toggle"><a href="admin.php">Admin Panel</a></li>
                                            <?php }
                                            ?>
                                        </ul>
                                    </div>
                                </div>                     
                            </div>
                        </div>
                    </div>










<div id="map"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1wgHloa0S9XcJ0sCPPsh2r7_3PpZce08&libraries=places&callback=initMap" async defer></script>
                    

                    <!--        <select id="places">
                                <option value="hospital">Hospital</option>
                                <option value="hotel">Hotel</option>
                                <option value="airport">Airport</option>
                                <option value="atm">ATM</option>
                                <option value="cafe">Cafe</option>
                                <option value="police">Police</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="parking">Parking</option>
                                <option value="park">Park</option>
                                <option value="museum">Museum</option>
                            </select>
                            <button onclick='createMarker(place)'>Submit</button>-->

                    <!--        <input id="places" type="text">-->
                    <button onclick='initMap()'>Reset Map</button>
                    <hr>
                    <p>Show nearest: 
                    <button onclick='hotels()'>Hotels</button>
                    <button onclick='hospitals()'>Hospitals</button>
                    <button onclick='parkings()'>Parking Areas</button></p>
                    <hr>
                    <p>Most popular places in Ireland
                    <button onclick='ajaxLoadMapDetails()'>Popular places</button></p>
                    <hr>

                    
                    <div id="floating-panel">
                        <b>From: </b>
                        <select id="start">
                            <option id="myField" value="">My location</option>
                            <option value="dundalk">Dundalk</option>
                            <option value="dublin">Dublin</option>
                        </select>
                        <b>To: </b>
                        <input id="end" type="text">
<hr><hr>

                    </div>
                    <input id="origin-input" class="controls" type="text"
                           placeholder="Enter an origin location">

                    <input id="destination-input" class="controls" type="text"
                           placeholder="Enter a destination location">
                    <div id="mode-selector" class="controls2">
                        <input type="radio" name="type" id="changemode-walking" checked="checked">
                        <label for="changemode-walking">Walking</label>

                        <input type="radio" name="type" id="changemode-transit">
                        <label for="changemode-transit">Transit</label>

                        <input type="radio" name="type" id="changemode-driving">
                        <label for="changemode-driving">Driving</label>
                    </div>












                    <!--Edit Footer here-->
                    <div id="footerInnerSeparator"></div>
                </div>
            </div>

            <div id="footerOuterSeparator"></div>

            <div id="divFooter" class="footerArea shadow">

                <div class="divPanel">

                    <div class="row-fluid">
                        <div class="span3" id="footerArea1">

                            <h3>About Company</h3>

                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.</p>

                            <p> 
                                <a href="#" title="Terms of Use">Terms of Use</a><br />
                                <a href="#" title="Privacy Policy">Privacy Policy</a><br />
                                <a href="#" title="FAQ">FAQ</a><br />
                                <a href="#" title="Sitemap">Sitemap</a>
                            </p>

                        </div>
                        <div class="span3" id="footerArea2">

                            <h3>Recent Blog Posts</h3> 
                            <p>
                                <a href="#" title="">Lorem Ipsum is simply dummy text</a><br />
                                <span style="text-transform:none;">2 hours ago</span>
                            </p>
                            <p>
                                <a href="#" title="">Duis mollis, est non commodo luctus</a><br />
                                <span style="text-transform:none;">5 hours ago</span>
                            </p>
                            <p>
                                <a href="#" title="">Maecenas sed diam eget risus varius</a><br />
                                <span style="text-transform:none;">19 hours ago</span>
                            </p>
                            <p>
                                <a href="#" title="">VIEW ALL POSTS</a>
                            </p>

                        </div>
                        <div class="span3" id="footerArea3">

                            <h3>Sample Content</h3> 
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s. 
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s.
                            </p>

                        </div>
                        <div class="span3" id="footerArea4">

                            <h3>Get in Touch</h3>  

                            <ul id="contact-info">
                                <li>                                    
                                    <i class="general foundicon-phone icon"></i>
                                    <span class="field">Phone:</span>
                                    <br />
                                    (123) 456 7890 / 456 7891                                                                      
                                </li>
                                <li>
                                    <i class="general foundicon-mail icon"></i>
                                    <span class="field">Email:</span>
                                    <br />
                                    <a href="mailto:info@yourdomain.com" title="Email">info@yourdomain.com</a>
                                </li>
                                <li>
                                    <i class="general foundicon-home icon" style="margin-bottom:50px"></i>
                                    <span class="field">Address:</span>
                                    <br />
                                    123 Street<br />
                                    12345 City, State<br />
                                    Country
                                </li>
                            </ul>

                        </div>
                    </div>

                    <br /><br />
                    <div class="row-fluid">
                        <div class="span12">
                            <p class="copyright"> 
                                Copyright © 2014 Your Company. All Rights Reserved.
                            </p>

                            <div class="social_bookmarks">                    
                                <a href="#"><div class="icon_twitter"></div></a>
                                <a href="#"><div class="icon_facebook"></div></a>
                                <a href="#"><div class="icon_google"></div></a>
                                <a href="#"><div class="icon_pinterest"></div></a>                   
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br /><br /><br />

        <script src="scripts/jquery.min.js" type="text/javascript"></script> 
        <script src="scripts/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/default.js" type="text/javascript"></script>

        <script src="scripts/carousel/jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script><script type="text/javascript">$('#list_photos').carouFredSel({responsive: true, width: '100%', scroll: 2, items: {width: 320, visible: {min: 2, max: 6}}});</script><script src="scripts/camera/scripts/camera.min.js" type="text/javascript"></script>
        <script src="scripts/easing/jquery.easing.1.3.js" type="text/javascript"></script>
        <script type="text/javascript">function startCamera() {
                $('#camera_wrap').camera({fx: 'simpleFade, mosaicSpiralReverse', time: 2000, loader: 'none', playPause: false, navigation: true, height: '38%', pagination: true});
            }
            $(function () {
                startCamera()
            });</script>

        <script src="scripts/wookmark/js/jquery.wookmark.js" type="text/javascript"></script>
        <script type="text/javascript">$(window).load(function () {
                var options = {autoResize: true, container: $('#gridArea'), offset: 10};
                var handler = $('#tiles li');
                handler.wookmark(options);
                $('#tiles li').each(function () {
                    var imgm = 0;
                    if ($(this).find('img').length > 0)
                        imgm = parseInt($(this).find('img').not('p img').css('margin-bottom'));
                    var newHeight = $(this).find('img').height() + imgm + $(this).find('div').height() + $(this).find('h4').height() + $(this).find('p').not('blockquote p').height() + $(this).find('iframe').height() + $(this).find('blockquote').height() + 5;
                    if ($(this).find('iframe').height())
                        newHeight = newHeight + 15;
                    $(this).css('height', newHeight + 'px');
                });
                handler.wookmark(options);
                handler.wookmark(options);
            });</script>
        <script src="scripts/yoxview/yox.js" type="text/javascript"></script>
        <script src="scripts/yoxview/jquery.yoxview-2.21.js" type="text/javascript"></script>
        <script type="text/javascript">$(document).ready(function () {
                $('.yoxview').yoxview({autoHideInfo: false, renderInfoPin: false, backgroundColor: '#ffffff', backgroundOpacity: 0.8, infoBackColor: '#000000', infoBackOpacity: 1});$('.yoxview a img').hover(function () {
                    $(this).animate({opacity: 0.7}, 300)}, function () {
                    $(this).animate({opacity: 1}, 300)
                });
            });</script>

    </body>
    </html>
    <?php
}
?>

