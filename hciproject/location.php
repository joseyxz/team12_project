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
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">
                    <?php
                    if (isset($_SESSION["role"])) {
                        echo $_SESSION["role"];
                        echo '</h2>';
                        if ($_SESSION["role"] == "driver") {
                            echo '<h3 class="section-subheading text-muted">Select your starting location.</h3>';
                        } else {
                            echo '<h3 class="section-subheading text-muted">Select your pick up location.</h3>';
                        }
                    }
                    ?>
            </div>
        </div>
        <!-- Put your map here -->
        <div ng-controller="MapController">
            <div id="map" style="height:60%; "></div>
            <div id="repeat" ng-repeat="marker in markers"> </div>
            <div class="row text-center">
                <div><br/>
                    <input style="left: 50%" type="text" class="form-control" ng-model="address1" value="<?php
                    if (isset($_SESSION["start"])) {
                        echo $_SESSION["start"];
                    }
                    ?>"/><br/>
                           <input type="submit" class="btn btn-default btn-sm" value="Search address" ng-click = "search(address1)"/>
                           <input type="submit" class="btn btn-default btn-sm" value="GPS" ng-click="search('10 Dover Drive, Singapore 138683')">
                </div>
                <form id="location-form" method="post" action="process/setlocation.php">
                    <input style="visibility: hidden" ng-model="address1"  type="text" class="form-control" name="location" id="search" value="<?php if (isset($_SESSION["start"])){echo $_SESSION["start"];echo '">';} else {echo '" placeholder="Search">';}?>
				<a href="home.php" class="page-scroll btn btn-xl">Cancel</a> &nbsp;
				<button type="submit" disabled="true" id="continueButton" class="page-scroll btn btn-xl">Continue</button>
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
