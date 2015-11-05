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
                    <h2 class="section-heading">Driver Navigation</h2>
                </div>
            </div>
			<!--Put map here-->
                        <div ng-controller="MapController" >
                            <div id="map" style="width:75%;height:60%;left: 12.5%"></div>
                            <div id="repeat" ng-repeat="marker in markers"> </div>                       
                            <div type="submit" value="Search address" ng-init = " search('<?php echo $_SESSION["start"] ?>','<?php echo $_SESSION["destination"] ?>') "/> </div>
                            <input type="submit" value="Show route" ng-click="showLine()"/> 
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
