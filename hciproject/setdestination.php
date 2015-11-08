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
<!--        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">
                    <?php
                    if (isset($_SESSION["role"])) {
                        echo $_SESSION["role"];
                        echo '</h2>';
                        echo '<h3 class="section-subheading text-muted">Select your destination.</h3>';
                    }
                    ?>
            </div>
        </div>-->
        <!-- Put your map here -->
        <div ng-controller="MapController">
            <div id="map" style="height:70%;"></div>
            <div id="repeat" ng-repeat="marker in markers"> </div>
            <div class="row text-center nav navbar-fixed-bottom">
                <div>
                    <input style="margin-left: 15px; margin-right: 15px;" id="searchinput" type="text" class="tab-content" placeholder="Set address"  ng-model="address2" value="<?php
                    if (isset($_SESSION["destination"])) {
                        echo $_SESSION["destination"]; 
                    }?>"/>
                <input type="submit" class="btn btn-default btn-sm" value="Search address" ng-click = "search(address2)">
                </div>
                <form id="location-form" method="post" action="process/setlocation.php">
                    <input style="display: none" type="text" class="form-control" name="location" id="search">
                    <input style="display: none" type="text" class="form-control" id="latitude" name="destLat"/>
                    <input style="display: none" type="text" class="form-control" id="longitude" name="destLng"/>
                    <button style="float: left; margin: 2px; margin-left: 20px;" class="page-scroll btn btn-lg btn-danger"><a href="location.php" >Back</a></button>
                    <button style="float:right; margin: 2px; margin-right: 20px;" type="submit" id="continueButton" class="btn-lg btn-success "><a>Next</a></button>
		</form>
            </div>           
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
