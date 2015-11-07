    
	<!-- Navigation -->
	<?php include 'common/header.php' ?> 

    <!-- Header -->
    <header>
        <div class="container">
			<div class="intro-text">
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
					}
					?>
					<h3 class="section-subheading text-muted">Confirm the details of your car.</h3>
                </div>
            </div>
                <div class="col-md-2">
				</div>
                <div class="col-md-8">
				<form id="location-form" method="post" action="process/setrideinfo.php">
					<?php 
					if (isset($_SESSION['error'])){
						echo 'Error: ';
						echo $_SESSION['error'];
						}
					?>
					<table width="100%">
					<tr style="height: 3em">
					<td>Name: </td>
					<td>
					<?php 
					if (isset($_SESSION['fname'])){
						echo $_SESSION['fname'];
					}
					?>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Car Type:</td>
					<td>
					<?php 
					if (isset($_SESSION['cartype'])){
						echo $_SESSION['cartype'];
					}
					?>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Max Occupants:</td>
					<td>
					<?php 
					if (isset($_SESSION['occupants'])){
						echo $_SESSION['occupants'];
					}
					?>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Car Plate:</td>
					<td>
					<?php 
					if (isset($_SESSION['carplate'])){
						echo $_SESSION['carplate'];
					}
					?>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Starting Location:</td>
					<td>
					<?php 
					if (isset($_SESSION['start'])){
						echo $_SESSION['start'];
					}
					?>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Destination:</td>
					<td>
					<?php 
					if (isset($_SESSION['destination'])){
						echo $_SESSION['destination'];
					}
					?>
					</td>
					</tr>
					</table>
					<br/><br/>
					<div class="row text-center">
						<a href="rideinfo.php" class="page-scroll btn btn-xl">Back</a>
						<button type="submit" class="page-scroll btn btn-xl">Confirm</button>
					</div>
				</form>
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
