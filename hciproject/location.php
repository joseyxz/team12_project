    
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
					if (isset($_SESSION["role"])){
						echo $_SESSION["role"];
						echo '</h2>';
						if ($_SESSION["role"] == "driver"){
							echo '<h3 class="section-subheading text-muted">Select your starting location.</h3>';
						}
						else {
							echo '<h3 class="section-subheading text-muted">Select your pick up location.</h3>';
						}
					}
					?>
                </div>
            </div>
			<!-- Put your map here -->
                <div class="col-md-2">
				</div>
                <div class="col-md-8">
				<form id="location-form" method="post" action="process/setlocation.php">
				<input required type="text" class="form-control" name="location" id="search" value="<?php if (isset($_SESSION["start"])){echo $_SESSION["start"];echo '">';} else {echo '" placeholder="Search">';}?>
				<div class="row text-center">
				<br/><button type="button" class="btn btn-default btn-sm">Search</button>
				<button type="button" class="btn btn-default btn-sm">Get current location</button>
				<br/><br/>
				<a href="home.php" class="page-scroll btn btn-xl">Cancel</a> &nbsp;
				<button type="submit" class="page-scroll btn btn-xl">Continue</button>
				</div>
				</form>
				</div>
				<div class="col-md-2">
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
