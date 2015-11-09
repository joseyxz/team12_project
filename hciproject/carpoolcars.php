	<!-- Map Imports -->
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
		<div class="col-md-12">
		<?php
			if (isset($_SESSION['error'])){
				echo '<strong>Error: </strong>';
				echo $_SESSION['error'];
				echo '<br/><br/>';
			}
			?>
		</div>
			<div class="col-md-6">
			<h5>Pick up location</h5>
				<?php echo $_SESSION['start'];?>
				<br/><br/>
			</div>
			<div class="col-md-6">
				<h5>Destination</h5>
				<?php echo $_SESSION['destination'];?>
				<br/>
			</div><br/>
			<div class="row text-center">
				<!-- Put your map here -->
				<div class="col-md-12">
					<div ng-controller="MapController2">
						<div class="map-wrapper">
							<div id="map" style="height:60%; "></div>
                            <div id="repeat" ng-repeat="marker in markers"> </div>
                            <div type="submit" value="Search address" ng-init=" search('<?php echo $_SESSION["start"] ?>') "/> </div>
							<?php include 'process/getcars.php' ?>
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
    </section>

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
