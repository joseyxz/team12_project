    
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
					<h4 class="section-subheading text-muted">&nbsp;</h4>
                </div>
            </div>
			<!-- Put your map here -->
                <div class="col-md-2">
				</div>
                <div class="col-md-8">
				<?php
				if (isset($_SESSION["start"]) && isset($_SESSION["destination"])){
					echo '<h4>Pick up location</h4>';
					echo $_SESSION["start"];
					echo '<br/><br/>';
					echo '<h4>Destination</h4>';
					echo $_SESSION["destination"];
					echo '<br/><br/><br/>';
					echo '<div class="row text-center">';
					echo '<a href="setdestination.php" class="page-scroll btn btn-xl">Back</a> &nbsp;';
					echo '<a href="carpoolcars.php" class="page-scroll btn btn-xl">Confirm</a>';
					echo '<div/>';
				}
				?>
				<div class="col-md-2">
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
