/*
 
 */


(function () {
    angular
            .module("mapApp", []) // create module
            .controller("MapController", MapController); // register controller


    /* Now we have do define the controller function to do something (some work) and pass the scope
     Scope is a parameter for the function. It is denoted using $scope. 
     Scope is basically a glue between the HTML file and Script.js, a way to send data to HTML for display
     */

    function MapController($scope) {
        $scope.message = "Displaying a Google Map";
        /*
         In order to display a map, we have to first declare a variable mapOptions.
         mapOptions will help us define many parameters related to the map
         There are two required options for every map: center and zoom.
         Here we set the zoom of the map
         Center is at Singapore, i.e. the map will be zoomed at Singapore.
         Type of map is initiated using mapTypeID, in this case we display a road map
         You can check for more options in this link 
         https://developers.google.com/maps/documentation/javascript/examples/control-options
         */
		 
        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(1.3, 103.8),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            events: {
            "click": function (event, a, b) {
              console.log(event.LatLng);
            }
            }
        };
        /*
         Remember in the HTML file we will display the map in the HTML node <div id = map>
         We get the reference to this node using document.getElementById
         We use the following piece of code to display a map in the HTML at the node <div id = map>
         Ideally an instance of the map object is created and the reference of the HTML node is passed with mapOptions
         */
        $scope.map = new google.maps.Map(document.getElementById("map"), mapOptions);


        $scope.map.addListener('click', function (event) {
            addMarker(event.latLng);
//            console.log(event.latLng);
            console.log(event.latLng.lat());
            console.log(event.latLng.lng());
        });
        /*
         Now we will define the search function which has two locations input by the user as the parameters
         Upon clicking the search button the search button the following function is executed
         Inside the function we call another function codeAdess which will geocode the locations
         and display the markers in the map. 
         
         */
        var geocoder = new google.maps.Geocoder();
        $scope.markers = [];
        $scope.routes = [];

        /*
         Now we will define the search function which has two locations input by the user as the parameters
         */
        $scope.search = function (address1, address2) {

            /*
             Ideally we need to geocode two locations. There is no point writing the same piece of code twice
             So we write a function and call it twice to geocode the locations
             But we pass different parameters to the function in each call
             */
            deleteMarker();
            codeAddress(address1);
            codeAddress(address2);

        };

        /*
         The following piece of code including if and else statement will remain the same for all geocoding applications
         First we will call the GOOGLE Api's geocode function.
         For any other application only the name of the parameter will change in the code, everything else remains same
         The function will return a status and the result
         */

    function deleteMarker(){
            for (var i = 0; i < $scope.markers.length; i++) {
            $scope.markers[i].setMap(null);
            }
        }
        
    function addMarker(location) {
//            var marker = new google.maps.Marker({
//                position: location,
//                map: $scope.map
//            });
            deleteMarker();
//            marker.content = location.formatted_address;
            var infoWindow = new google.maps.InfoWindow();
            
            geocodeLatLng(geocoder, $scope.map, infoWindow, location);
            
//            infoWindow.setContent(marker.content);
//            infoWindow.open($scope.map, marker);
//            $scope.markers.push(marker);
           
            var route = new google.maps.LatLng(
                    location.lat(),
                    location.lng()
                    );
            $scope.routes.push(route)

            $scope.path1 = new google.maps.Polyline(
                    {
                        path: $scope.routes,
                        strokeColor: "#FF0000",
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });

//            $scope.markers.push(marker);
        }
        
    function geocodeLatLng(geocoder, map, infowindow, locations) {
                    deleteMarker();
                    var input = locations;   
                        geocoder.geocode({'location': locations}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            var marker = new google.maps.Marker(
                                    {
                                    map: $scope.map,
                                    position: results[0].geometry.location                             
                                });
                                marker.content = results[0].formatted_address;
                                document.getElementById("search").value = results[0].formatted_address;
                                document.getElementById("searchinput").value = results[0].formatted_address;
                                infowindow.setContent(marker.content);
                                infowindow.open($scope.map, marker);
                                
                             var route = new google.maps.LatLng(
                            results[0].geometry.location.lat(),
                            results[0].geometry.location.lng()
                            );
					
					document.getElementById("latitude").value = results[0].geometry.location.lat();
                    document.getElementById("longitude").value = results[0].geometry.location.lng();

                    $scope.routes.push(route)                   
                    $scope.markers.push(marker);
                        } else {
                        window.alert('No results found');
                        }
                        } else {
                        window.alert('Geocoder failed due to: ' + status);
                        }
                        });
                    }

    var codeAddress = function (info) {

            geocoder.geocode({'address': info}, function (results, status)
            {
                if (status === google.maps.GeocoderStatus.OK)
                {
                    $scope.coordinate = results[0].geometry.location;
                    $scope.map.setCenter(results[0].geometry.location);
                    console.log (results[0].geometry.location.lat());
                    console.log (results[0].geometry.location.lng());
//                    set coords array here
                    var infoWindow = new google.maps.InfoWindow();
                    var marker = new google.maps.Marker(
                            {
                                map: $scope.map,
                                position: results[0].geometry.location
                            });
//                    marker.content = "latitude" + results[0].geometry.location.lat() + "	" + "longitude" + results[0].geometry.location.lng() + "    " + results[0].formatted_address;
                     marker.content = results[0].formatted_address;
                    infoWindow.setContent(marker.content);
                    infoWindow.open($scope.map, marker);

                    var route = new google.maps.LatLng(
                            results[0].geometry.location.lat(),
                            results[0].geometry.location.lng()
                            );
							
                    document.getElementById("search").value = results[0].formatted_address;
					document.getElementById("latitude").value = results[0].geometry.location.lat();
                    document.getElementById("longitude").value = results[0].geometry.location.lng();

                    $scope.routes.push(route);                   
                    $scope.markers.push(marker);
                }
            });
        };        

    // from main               
    $scope.codeLocalAddress = function (latlng) {

            //check the location latlng to match for format address
            geocoder.geocode({'location': latlng}, function (results, status)
            {
                if (status === google.maps.GeocoderStatus.OK)

                {
                    $scope.coordinate = results[0].geometry.location;
                    $scope.map.setCenter(results[0].geometry.location);
                    console.log (results[0].formatted_address);

                    /*
                     Once we have recieved the geocodes, we have to display a marker at that position
                     We do so by creating a marker, with two parameters
                     map: i.e. where the marker will be displayed
                     position: the geocordinates on the map where the marker should be displayed
                     */
                    var infoWindow = new google.maps.InfoWindow();
                    var marker = new google.maps.Marker(
                            {
                                map: $scope.map,
                                position: results[0].geometry.location

                            });
                    marker.content = results[0].formatted_address;
                    document.getElementById("search").value = results[0].formatted_address;
                    document.getElementById("searchinput").value = results[0].formatted_address;
                    infoWindow.setContent(marker.content);
                    infoWindow.open($scope.map, marker);

                    /*
                     We need to know the latitude and longitude of each marker
                     because we need to draw a line between them
                     We do so using the following code
                     */
                    var route = new google.maps.LatLng(
                            results[0].geometry.location.lat(),
                            results[0].geometry.location.lng()
                            );
							
                    document.getElementById("latitude").value = results[0].geometry.location.lat();
                    document.getElementById("longitude").value = results[0].geometry.location.lng();

                    /*
                     Now route (lat, lng) for each route is send to an array
                     which contains routes of all locations
                     */
					 
                    $scope.routes.push(route);
                    
                            $scope.path1 = new google.maps.Polyline(
                            {
                                path: $scope.routes,
                                strokeColor: "#FF0000",
                                strokeOpacity: 1.0,
                                strokeWeight: 2
                            });

                            /*
                             This code is used to put the line on the map
                             which connects the two markers
                             */
                            
                            $scope.markers.push(marker);

                } 
            });
        }; 
    
    $scope.getLocation = function() {
            var x = document.getElementById("getid");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(viewPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        };

    function viewPosition(position) {   
            var myLat1ng= new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
            var currentmap = {
                zoom: 18,
                center: myLat1ng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };  
            $scope.map = new google.maps.Map(document.getElementById("map"), currentmap);
            $scope.codeLocalAddress(myLat1ng);
        }; 
    }; // end of controller function
}());