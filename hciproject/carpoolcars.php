    <!-- For pop ups -->
<!--	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.3/angular.min.js"></script>
        <script src="http://maps.googleapis.com/maps/api/js?sensor=false&language=en"></script>
        <script src="mapJs.js" type="text/javascript"></script>

	
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
	<!-- Put AJAX loading codes -->
    <section id="location">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">
					Start carpooling!
					</h2>
					<h3 class="section-subheading text-muted">Select a driver.</h3>
                </div>
            </div>
            <div class="col-md-6">
			<h4>Pick up location</h4>
			<?php echo $_SESSION["start"];?>
			<br/><br/>
			</div>
			<div class="col-md-6">
			<h4>Destination</h4>
			<?php echo $_SESSION["destination"];?>
			<br/>
			</div><br/>
			<!-- Put your map here -->
                        <div ng-controller="MapController">
                            <div id="map" style="width:75%;height:60%;left: 12.5%; "></div>
                            <div id="repeat" ng-repeat="marker in markers"> </div>                              
                            </div>           
                        </div>
                        
			<div class="col-md-12">
			<div data-role="main" class="ui-content">
			<div data-role="popup" id="myPopup">
				<p>Pop up of driver details</p>
				<br/><br/>
				<button type="button" class="page-scroll btn btn-xl">Request</button>
			</div>
			</div>
			<div class="row text-center">
			<!-- Add confirm cancellation -->
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

</body>

</html>
