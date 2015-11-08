<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
<script src="js/navMapJs.js" type="text/javascript"></script>
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
    <section id="location">
        <div class="container">
            <div class="row">
            </div>
			<?php include 'process/viewrequest.php';
			if ($myLocation == ""){
				/* Wait for driver's response */
				echo '<div class="row text-center">';
				echo '<h3>Waiting for driver\'s response</h3><br/><br/>';
				echo '<img src="img/loading.gif" style="padding-bottom: 80px;">';
				echo '<form id="location-form" method="post" action="process/cancelrequest.php">';
				echo '<button type="submit" class="page-scroll btn btn-xl" id="cancelBtn">Cancel Request</button></form>';
				echo '<br/>Your request will automatically be cancelled in ';
				echo '<span id="timer">2:00</span>.<br/><br/>';
				echo '</div>';
			}
			else {
				/* Put map here */
				echo '<div ng-controller="MapController2" >';
				echo '<div id="map" style="height:60%;" ng-init=" showOTW(\''.$driverLocation.'\',\''.$myLocation.'\')"></div>';
				echo '<div id="repeat" ng-repeat="marker in markers"> </div>';
				echo '<div class="row text-center"><br/>';
				echo '<form id="location-form" method="post" action="process/cancelrequest.php">';
				echo '<button type="submit" class="page-scroll btn btn-xl" id="cancelBtn">Cancel Request</button></form>';
				echo '</div></div>';
			}
			?>
    </section>
	
	<script>
	<!-- Countdown Timer -->
	var interval = setInterval(function() {
    var timer = $('#timer').html();
    timer = timer.split(':');
    var minutes = parseInt(timer[0], 10);
    var seconds = parseInt(timer[1], 10);
    seconds -= 1;
    if (minutes < 0) return clearInterval(interval);
    if (minutes < 10 && minutes.length != 2) minutes = minutes;
    if (seconds < 0 && minutes != 0) {
        minutes -= 1;
        seconds = 59;
    }
    else if (seconds < 10 && length.seconds != 2) seconds = '0' + seconds;
    $('span').html(minutes + ':' + seconds);
    
    if (minutes == 0 && seconds == 0)
		window.location.href = "process/cancelrequest.php"
	}, 1000);
	</script>

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

</body>

</html>
