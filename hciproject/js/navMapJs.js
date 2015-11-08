(function () {
    angular
            .module("mapApp", []) // create module
            .controller("MapController2", MapController2); // register controller



// 2nd controller for nav ( without click map functions)
    function MapController2($scope) {
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
        }
        /*
         Remember in the HTML file we will display the map in the HTML node <div id = map>
         We get the reference to this node using document.getElementById
         We use the following piece of code to display a map in the HTML at the node <div id = map>
         Ideally an instance of the map object is created and the reference of the HTML node is passed with mapOptions
         */
        $scope.map = new google.maps.Map(document.getElementById("map"), mapOptions);


        /*
         Now we will define the search function which has two locations input by the user as the parameters
         Upon clicking the search button the search button the following function is executed
         Inside the function we call another function codeAdess which will geocode the locations
         and display the markers in the map. 
         
         */
        var geocoder = new google.maps.Geocoder();
        $scope.markers = [];
        $scope.routes = []

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
        }

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
        

        var codeAddress = function (info) {

            geocoder.geocode({'address': info}, function (results, status)
            {

                /*
                 We will first check if the status is OK
                 OK means the geocoder was able to find location coordinates for the entered location
                 if it is true then we will store the result in a variable, which in this case is values
                 Then we will center the map to that location, i.e. focus to the location
                 For any other application, all the code will remain same
                 */

                if (status == google.maps.GeocoderStatus.OK)

                {
                    $scope.coordinate = results[0].geometry.location
                    $scope.map.setCenter(results[0].geometry.location)
                    console.log (results[0].geometry.location.lat())
                    console.log (results[0].geometry.location.lng())
//                    set coords array here

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
//                    marker.content = "latitude" + results[0].geometry.location.lat() + "	" + "longitude" + results[0].geometry.location.lng() + "    " + results[0].formatted_address;
                      marker.content = results[0].formatted_address;
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

                    /*
                     Now route (lat, lng) for each route is send to an array
                     which contains routes of all locations
                     */
                    $scope.routes.push(route)
                    
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
             

        }        
        /*
         Now we define the ShowLine() which is executed once the suer clicks to connect the markers
         This code actually takes all the elements in the routes array 
         and connect them using a line
         The routes is the most important thing for this function
         */

         
		// Beginning of ANTON's PART
        $scope.showLine = function (origin, destination) {
			findRoute(origin, destination);
			 
            // $scope.path1 = new google.maps.Polyline(
                    // {
                        // path: $scope.routes,
                        // strokeColor: "#FF0000",
                        // strokeOpacity: 1.0,
                        // strokeWeight: 2
                    // });

            // /*
             // This code is used to put the line on the map
             // which connects the two markers
             // */

            // $scope.path1.setMap($scope.map);
        }
		
		var directionsService = new google.maps.DirectionsService();
		$scope.directionsService = directionsService;
		var checkingRequestInterval = null;
		$scope.line = null;
		
		function findRoute(origin, destination)
		{       deleteMarker();
			var mode = google.maps.DirectionsTravelMode.DRIVING;
			var directionsDisplay = new google.maps.DirectionsRenderer();
                        $scope.map.setCenter(origin)
			directionsDisplay.setMap($scope.map);
			var request = {
				origin: origin,
				destination: destination,
				travelMode: mode,
				optimizeWaypoints: true,
				avoidHighways: false
			};
			$scope.paths = [];
			
			$scope.directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					var nPoints = response.routes[0].overview_path.length;
					for (var i = 0; i < nPoints; i++){
						$scope.paths.push({lat:response.routes[0].overview_path[i].lat(), lng:response.routes[0].overview_path[i].lng()});
						console.log(response.routes[0].overview_path[i].lat() + ',' + response.routes[0].overview_path[i].lng());
					}
					directionsDisplay.setDirections(response);
				}
			});
			document.getElementById("startRouteBtn").style.display = 'inline';
			document.getElementById("showRouteBtn").style.display = 'none';
		}
        
		$scope.startRoute = function()
		{
			document.getElementById("startRouteBtn").disabled = true;
			document.getElementById("startRouteBtn").style.display = 'none';
			document.getElementById("cancelRouteBtn").style.display = 'inline';
			var lineSymbol = {
				path: google.maps.SymbolPath.CIRCLE,
				scale: 8,
				strokeColor: '#393'
			};

		  // Create the polyline and add the symbol to it via the 'icons' property.
			if($scope.line != null){$scope.line.setMap(null);} // To remove the polyline
			$scope.line = new google.maps.Polyline({
				path: $scope.paths,
				icons: [{
				  icon: lineSymbol,
				  offset: '100%'
				}],
				map: $scope.map
			});
			
			animateCircle($scope.line, $scope.paths.length);
			riderRequestPopup();
		}
		function animateCircle(line, noPaths) {
			var count = 0;
			var count1 = 0;
			
			
			var interval = setInterval(function() {
				count = (count + 1) % (noPaths*40);
				var icons = line.get('icons');
				icons[0].offset = (count / (noPaths/40)) + '%';
				line.set('icons', icons);
				if(count == (noPaths*40)-1)

				{
					count1 = count1 + 1;
				}
				if(count1 >= 1)
				{
					clearInterval(interval);
					clearInterval(checkingRequestInterval);
					document.getElementById("startRouteBtn").disabled = false; 					
				}
				console.log("count = " + count + ", offset=" + icons[0].offset + ", count1=" + count1);
			}, 40);
		}
		function riderRequestPopup()
		{
			checkingRequestInterval = setInterval(function() {
				
				var xmlhttp = new XMLHttpRequest();
				var url = 'http://localhost:8080/hciproject/carRequestAPI.php';
				var myArr = [];
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						myArr = JSON.parse(xmlhttp.responseText);
						if(myArr.length > 0)
						{
							alert(xmlhttp.responseText);
						}
					}
				}
				xmlhttp.open("GET", url, true);
				xmlhttp.send();
				
			}, 5000);
		}
		
//End of ANTON's PART	

//JOSEY'S
		$scope.showPopup = function(){
			document.getElementById('popup-content').style.display='inline';
			document.getElementById('fade-out').style.display='inline'; 
		}
		
		$scope.hidePopup = function(){		
			document.getElementById('popup-content').style.display='none';
			document.getElementById('fade-out').style.display='none'; 
		}
		
		$scope.setCars = function (info, driverName, carPlate, destination) {

            geocoder.geocode({'address': info}, function (results, status)
            {
				if (status == google.maps.GeocoderStatus.OK)
                {
                    $scope.coordinate = results[0].geometry.location
                    $scope.map.setCenter(results[0].geometry.location)
                    console.log (results[0].geometry.location.lat())
                    console.log (results[0].geometry.location.lng())
					
					var contentStr = '<h5>Driver Information</h5>' +
								'<form id="request-form" method="post" action="process/sendrequest.php">' +
									'<table style=\"font-size: 10pt; width: 100%;\">'+
										'<tr>' +
										'<td><strong>Driver Name: &nbsp;</strong></td>' +
										'<td>' + driverName + '</td>' +
										'</tr>' +
										'<tr>' +
										'<td><strong>Car Plate: </strong></td>' +
										'<td><input style="border:0" name="carplate" value=' + carPlate + '></td>' +
										'</tr>' +
										'<tr>' +
										'<td><strong>Destination: </strong></td>' +
										'<td>' + destination + '</td>' +
										'</tr>' +
										'<tr>' +
										'<td><strong>Passengers: </strong></td>' +
										'<td></td>' +
										'</tr>' +
										'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>' +
										'<tr>' +
										'<td>Cost: </td>' +
										'<td><input required type="number" name="cost" class="form-control" style="width: 100%; display: inline;" value="0"/></td>' +
										'</tr>' +
									'</table>' +
								'<br/>' +
								'<button type="submit" class="btn btn-default btn-sm">Request</button></form>';
					
                    var infoWindow = new google.maps.InfoWindow({
						content: contentStr,
						maxWidth: 500,
						maxHeight: 300
					});
                    var marker = new google.maps.Marker(
                    {
                        map: $scope.map,
                        position: results[0].geometry.location,
						icon: 'img/glyphicon-car.png'
                    });
					
					marker.addListener('click', function() {
						$scope.map.setCenter(marker.getPosition());
						infoWindow.open($scope.map, marker);
					});                              
                }
            });
        }
	};
// end of 2nd controller



}());
