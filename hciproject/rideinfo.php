    
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
					<h3 class="section-subheading text-muted">Enter the details of your car.</h3>
                </div>
            </div>
                <div class="col-md-2">
				</div>
                <div class="col-md-8">
				<form id="location-form" method="post" action="process/setrideinfo.php">
					<table width="100%">
					
					<tr style="height: 3em">
					<td>Car Type:</td>
					<td>
					<select class="form-control" name="cartype" id="cartype">
						<option value="volvo">Volvo</option>
						<option value="saab">Saab</option>
						<option value="mercedes">Mercedes</option>
						<option value="audi">Audi</option>
					</select>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Max Occupants:</td>
					<td>
					<input id="movie" class="form-control" type="number" name="occupants" id="occupants" value="<?php if (isset($_SESSION["occupants"])){echo $_SESSION["occupants"];}else{echo '0';}?>"/>
					</td>
					</tr>
					<tr style="height: 3em">
					<td>Car Plate:</td>
					<td>
					<input required type="text" class="form-control" name="carplate" id="carplate" value="<?php if (isset($_SESSION["carplate"])){echo $_SESSION["carplate"];}?>">
					</td>
					</tr>
					</table>
					<br/><br/>
					<div class="row text-center">
						<a href="confirmlocation.php" class="page-scroll btn btn-xl">Back</a> &nbsp;
						<button type="submit" class="page-scroll btn btn-xl">Continue</button>
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
