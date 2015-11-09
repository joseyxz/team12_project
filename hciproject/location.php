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
<section id="location">
    <div class="container">
        <div class="row">
        </div>
        <!-- Put your map here -->
        <div ng-controller="MapController">
            <div id="map" style="height:60%; "></div>
            <div id="repeat" ng-repeat="marker in markers"> </div>
            <div class="row text-center">
                <div><br/>
					<input id="searchinput" type="text" class="form-control" ng-init="address1='<?php
								if (isset($_SESSION["start"])) {
								echo $_SESSION["start"];
								}?>';search(address1)" ng-model="address1"/>
					<input type="submit" class="btn btn-default btn-sm" value="Search" ng-click = "search(address1)"/>              
					<input type="submit" id="getid" class="btn btn-default btn-sm" value="GPS" ng-click = "getLocation()">
				</div>
                <form id="location-form" method="post" action="process/setlocation.php">
                    <input style="visibility: hidden" type="text" class="form-control" name="location" id="search">
					<input style="display: none" type="text" class="form-control" id="latitude" name="originLat"/>
					<input style="display: none" type="text" class="form-control" id="longitude" name="originLng"/>
                    <a href="home.php" class="page-scroll btn btn-xl">Cancel</a>
                    <button type="submit" id="continueButton" class="page-scroll btn btn-xl">Continue</button>
		</form>
            </div>           
        </div>
    </div>
    <div class="col-md-2">
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
