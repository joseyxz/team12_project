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
	<?php include 'process/viewrequest.php'?>
    <section id="location">
        <div class="container">
            <div class="row">
            </div>
			<!--Put map here-->
            <div ng-controller="MapController2" >
				<div id="map" style="height:60%;"></div>
                <div id="repeat" ng-repeat="marker in markers"> </div>                       
                <div type="submit" value="Search address" ng-init=" search('<?php echo $driverLocation ?>','<?php echo $myLocation ?>') "/> </div>
				<div class="row text-center">
				<br/>
					<form id="location-form" method="post" action="process/cancelrequest.php">
						<button type="submit" class="page-scroll btn btn-xl" id="cancelRouteBtn">Cancel Request</button> 
					</form>
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
