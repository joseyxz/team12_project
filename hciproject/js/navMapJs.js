(function () {
    angular
            .module("mapApp", []) // create module
            .controller("MapController2", MapController2); // register controller



// 2nd controller for nav ( without click map functions)
    function MapController2($scope,$compile) {
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
            deleteAllMarkers();
            codeAddress(address1);
            codeAddress(address2);
        }

        /*
         The following piece of code including if and else statement will remain the same for all geocoding applications
         First we will call the GOOGLE Api's geocode function.
         For any other application only the name of the parameter will change in the code, everything else remains same
         The function will return a status and the result
         */

        function deleteAllMarkers(){
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
		var directionsService = new google.maps.DirectionsService();
		$scope.directionsService = directionsService;
		$scope.directionsDisplay = null;
		var checkingRequestInterval = null;
		var animationInterval = null;
		$scope.line = null;
		var currentCount = 0;
		var animationStop = true;
		var requestInterrupt = false;
		var currentJourneys = [];
		
        $scope.showLine = function (origin, destination) {
			var driverJourney = {
				origin: origin,
				currentLocation:origin,
				destination: destination,
				currentFetchingpid:-1,
				currentOTWpid:-1
			};
			currentJourneys.push(driverJourney);
			findRoute(origin, destination);
        }
		
		function findRoute(origin, destination)
		{
			deleteAllMarkers();
			var mode = google.maps.DirectionsTravelMode.DRIVING;
			$scope.directionsDisplay = new google.maps.DirectionsRenderer();
            $scope.map.setCenter(origin)
			$scope.directionsDisplay.setMap($scope.map);
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
						//console.log(response.routes[0].overview_path[i].lat() + ',' + response.routes[0].overview_path[i].lng());
					}
					$scope.directionsDisplay.setDirections(response);
					if(requestInterrupt)
					{
						requestInterrupt = false;
						$scope.startRoute();
					}
				}
			});
			document.getElementById("startRouteBtn").style.display = 'inline';
			document.getElementById("showRouteBtn").style.display = 'none';
		}
        
		$scope.startRoute = function()
		{
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
			currentCount = 0;
			animationStop = false;
			animationInterval = setInterval(function() {
				currentCount = (currentCount + 1) % (noPaths*10);				
				var icons = line.get('icons');
				icons[0].offset = (currentCount / (noPaths/10)) + '%';
				line.set('icons', icons);
				
				// Updating driver current location
				var index = Math.round(currentCount/10);
				if($scope.paths[index] != undefined)
					currentJourneys[0].currentLocation = $scope.paths[index].lat+','+$scope.paths[index].lng;
				if(currentJourneys.length > 1)
				{
					if(currentJourneys[0].currentFetchingpid < 0) // not otw fetching any passenger
					{
						console.log("no fetching");
						for(var i = 1; i< currentJourneys.length; i++)
						{
							if(currentJourneys[i].reqStatus == 'Approved')
							{
								console.log("fetching");
								currentJourneys[0].currentFetchingpid = parseInt(currentJourneys[i].pid);
								clearInterval(animationInterval);
								clearInterval(checkingRequestInterval);
								$scope.line.setMap(null);
								$scope.directionsDisplay.setMap(null);
								animationStop = true;
								requestInterrupt = true;
								findRoute(currentJourneys[0].currentLocation, currentJourneys[i].pickupLat +','+ currentJourneys[i].pickupLong);
								return;
							}
						}
					}
					else if(currentJourneys[0].currentOTWpid < 0)
					{
						console.log("no otw");
						for(var i = 1; i< currentJourneys.length; i++)
						{
							if(currentJourneys[i].reqStatus == 'OTW')
							{
								console.log("otwing");
								currentJourneys[0].currentOTWpid = parseInt(currentJourneys[i].pid);
								clearInterval(animationInterval);
								clearInterval(checkingRequestInterval);
								$scope.line.setMap(null);
								$scope.directionsDisplay.setMap(null);
								animationStop = true;
								requestInterrupt = true;
								findRoute(currentJourneys[0].currentLocation, currentJourneys[i].destLat +','+ currentJourneys[i].destLong);
								return;
							}
						}
					}
				}
				if(currentCount == (noPaths*10)-1) //finish animate
				{
					clearInterval(animationInterval);
					clearInterval(checkingRequestInterval);
					animationStop = true;				
					if(currentJourneys.length > 1)
					{
						if(currentJourneys[0].currentFetchingpid > 0) // if was otw fetching any passenger, then changed the reqStatus to OTW
						{
							console.log("finish fetching");
							for(var i = 1; i< currentJourneys.length; i++)
							{
								// console.log(currentJourneys[i].pid + " otw1 " + currentJourneys[0].currentFetchingpid);
								if(parseInt(currentJourneys[i].pid) == currentJourneys[0].currentFetchingpid)
								{
									currentJourneys[i].reqStatus = 'OTW';
									currentJourneys[0].currentFetchingpid = -1;
									console.log(currentJourneys[0].currentFetchingpid);
									currentJourneys[0].currentOTWpid = parseInt(currentJourneys[1].pid);
									$scope.line.setMap(null);
									$scope.directionsDisplay.setMap(null);
									animationStop = true;
									requestInterrupt = true;
									findRoute(currentJourneys[0].currentLocation, currentJourneys[1].destLat +','+ currentJourneys[1].destLong);
									return;
								}
							}
						}
						else if(currentJourneys[0].currentOTWpid > 0)
						{
							console.log("finish otwing");
							for(var i = 1; i< currentJourneys.length; i++)
							{
								if(parseInt(currentJourneys[i].pid) == currentJourneys[0].currentOTWpid)
								{
									currentJourneys[0].currentOTWpid = -1;
									$scope.line.setMap(null);
									$scope.directionsDisplay.setMap(null);
									animationStop = true;
									requestInterrupt = true;
									currentJourneys.splice(1,1);
									findRoute(currentJourneys[0].currentLocation, currentJourneys[0].destination);
									return;
								}
							}
						}						
					}	
					console.log(currentJourneys[1]);
				}
				//console.log("count = " + currentCount + ", offset=" + icons[0].offset + ", count1=" + count1);
			}, 20);
		}
		function riderRequestPopup()
		{
			checkingRequestInterval = setInterval(function() {
				
				var xmlhttp = new XMLHttpRequest();
				var url = 'carRequestAPI.php';
				var myArr = [];
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						myArr = JSON.parse(xmlhttp.responseText);
						if(myArr.length > 0)
						{
							console.log(currentJourneys.length);
							$scope.setRiderRequestWindow(myArr[0].pid, myArr[0].carplate, myArr[0].pickupLoc, myArr[0].destination, myArr[0].riderName, myArr[0].cost);
							clearInterval(checkingRequestInterval);
						}
					}
				}
				xmlhttp.open("GET", url, true);
				xmlhttp.send();
				
			}, 5000);
		}
		
//End of ANTON's PART	

// Huat sin's 
		$scope.setRiderRequestWindow = function (pid, carplate, pickupLoc, destination, riderName, cost) {
            geocoder.geocode({'address': pickupLoc}, function (results, status)
            {
				if (status == google.maps.GeocoderStatus.OK)
                {
                    $scope.coordinate = results[0].geometry.location
                    $scope.map.setCenter(results[0].geometry.location)
                    console.log (results[0].geometry.location.lat())
                    console.log (results[0].geometry.location.lng())
					
					var contentStr = '<div><h5>Rider Request</h5>' +
										'<table style=\"font-size: 10pt; width: 100%;\">'+
											'<tr>' +
											'<td><strong>Rider Name: &nbsp;</strong></td>' +
											'<td> ' + riderName + '</td>' +
											'</tr>' +
											'<tr>' +
											'<td><strong>Pick-up location: </strong></td>' +
											'<td> ' + pickupLoc + '</td>' +
											'</tr>' +
											'<tr>' +
											'<td><strong>Destination: </strong></td>' +
											'<td> ' + destination + '</td>' +
											'</tr>' +
											'<tr>' +
											'<td><strong>Cost: </strong></td>' +
											'<td> '+ cost + '</td>' +
											'</tr>' +
											'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>' +
										'</table>' +
										'<br/>' +
										'<button type="submit" class="btn btn-success btn-sm" ng-click="acceptRequest('+ pid + ',\'' + carplate + '\')">Accept</button>' +
										'<button type="submit" class="btn btn-danger btn-sm" ng-click="rejectRequest('+ pid + ',\'' + carplate + '\')">Reject</button></div>';
					contentStr = $compile(contentStr)($scope);
                    var infoWindow = new google.maps.InfoWindow({
						content: contentStr[0],
						maxWidth: 500,
						maxHeight: 300
					});
					
                    var marker = new google.maps.Marker(
                    {
                        map: $scope.map,
                        position: results[0].geometry.location,
						icon: 'img/glyphicons-7-user-add.png'
                    }); 
					marker.addListener('click', function() {
						$scope.map.setCenter(marker.getPosition());
						infoWindow.open($scope.map, marker);
					});
					$scope.markers.push(marker);					
                }
            });
        }
		
		$scope.acceptRequest = function (pid, carplate)
		{
			var xmlhttp = new XMLHttpRequest();
			var url = 'carRequestAcceptAPI.php?pid=' + pid + '&carplate=' + carplate;
			var myArr = [];
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					myArr = JSON.parse(xmlhttp.responseText);
					if(myArr.length > 0)
					{
						if(myArr[0].error <= 0)
						{
							console.log("Successfully accepted");
							currentJourneys.push(myArr[0]);
							console.log(currentJourneys.length);
						}
						else
							console.log("request cancelled");
					}
				}
			}
			xmlhttp.open("GET", url, true);
			xmlhttp.send();
			
			deleteAllMarkers();
			if(!animationStop)
				riderRequestPopup();
			else
				return;
			
			
		}
		$scope.rejectRequest = function (pid, carplate)
		{
			var xmlhttp = new XMLHttpRequest();
			var url = 'carRequestRejectAPI.php?pid=' + pid + '&carplate=' + carplate;
			var myArr = [];
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					myArr = JSON.parse(xmlhttp.responseText);
					if(myArr.length > 0)
					{
						if(myArr[0].error <= 0)
							console.log("Successfully rejected");
						else
							console.log("request cancelled");
					}
				}
			}
			xmlhttp.open("GET", url, true);
			xmlhttp.send();
			
			deleteAllMarkers();
			if(!animationStop)
				riderRequestPopup();
			else
				return;
		}
// End

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
		
		$scope.showOTW = function (address1, address2) {
            deleteAllMarkers();
			findRoute(address1, address2);
        }
		
	};
// end of 2nd controller



}());
