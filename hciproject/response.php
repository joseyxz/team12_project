	<!-- Map Imports -->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
	<script src="mapJs.js" type="text/javascript"></script>
    <link href="css/cars.css" rel="stylesheet" type="text/css">
	
	<!-- Navigation -->
	<?php include 'common/header.php' ?> 

    <!-- Header -->
    <header>
        <div class="container">
			<div class="intro">
			</div>
        </div>
    </header>

    <!-- Content -->
	
	<!-- Check if driver has accepted request -->
	
	<!-- Put AJAX loading codes -->
    <section id="location">
        <div class="container">
			<div class="col-md-6">
			<div class="row text-center">
				<!-- Put your map here -->
				<div class="col-md-12">
					<div ng-controller="MapController">
						<div class="map-wrapper">
							<div id="map" style="height:60%;"></div>
							<a id="callPopup">
								<div class="car-icon carone"></div>
							</a>
							<a id="callPopup">
							<div class="car-icon cartwo"></div>
							</a>
							<a id="callPopup">
							<div class="car-icon carthree"></div>
							</a>
							<a id="callPopup">
							<div class="car-icon carfour"></div>
							</a>
						</div>
					</div>					
				</div>
				</div>
					<br/>
				<!-- Add confirm cancellation -->
				
				<div class="row text-center">
					<a href="home.php" class="page-scroll btn btn-xl">Cancel</a>
				</div>
			</div>
        </div>
    </section>
	
	<!-- Footer -->
	<?php include 'common/footer.php' ?> 

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

	<script type="text/javascript">	
	<!-- Display Map Routing *Example -->
	function initMap() {
		var chicago = {lat: 41.85, lng: -87.65};
		var indianapolis = {lat: 39.79, lng: -86.14};

		var map = new google.maps.Map(document.getElementById('map'), {
			center: chicago,
			scrollwheel: false,
			zoom: 7
		});

		var directionsDisplay = new google.maps.DirectionsRenderer({
			map: map
		});

		// Set destination, origin and travel mode.
		var request = {
			destination: indianapolis,
			origin: chicago,
			travelMode: google.maps.TravelMode.DRIVING
		};

		  // Pass the directions request to the directions service.
		var directionsService = new google.maps.DirectionsService();
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
			  // Display the route on the map.
			  directionsDisplay.setDirections(response);
			}
		});
	}
	</script>
	
	<!-- API For Map Routing -->
	<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_SH1Em4KOMH0SK4B3OHsoiD79RKR3Hb0&callback=initMap">
    </script>
</body>

</html>
