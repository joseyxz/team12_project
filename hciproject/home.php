	<!-- Navigation -->
	<?php include 'common/header.php' ?> 

    <!-- Header -->
    <header>
        <div class="container">
			<div class="intro-text">
				<?php
				if (!isset($_SESSION['login'])){
					echo '<div class="intro-lead-in">Welcome!</div>';
					echo '<div class="intro-heading">It\'s time to carpool</div>';
					echo '<div class="col-md-4">';
					echo '</div>';
					echo '<div class="col-md-4">';
					echo '<form id="login-form" method="post" action="process/login.php">';
					echo '<input type="text" class="form-control" name="username" id="username" placeholder="Username"/>';
					echo '<br/><input type="password" class="form-control" name="password" id="password" placeholder="Password"/>';
					echo '<br/><br/><button type="submit" class="page-scroll btn btn-xl">Log In</button>';
					echo '</form>';
					echo '</div>';
					echo '<div class="col-md-4">';
					echo '</div>';
				}
				else if ($_SESSION['login'] == "1"){
					if (isset($_SESSION['start'])){
						unset($_SESSION['start']);
					}
					if (isset($_SESSION['destination'])){
						unset($_SESSION['destination']);
					}
					echo '<div class="intro-lead-in">Let\'s start carpooling!</div>';
					echo '<div class="col-md-2"><br/></div>';
					echo '<div class="col-md-3">';
					echo '<a href="process/role.php?role=driver" class="page-scroll btn btn-xl">I\'m a driver</a>';
					echo '</div>';
					echo '<div class="col-md-2"><br/></div>';
					echo '<div class="col-md-3">';
					echo '<a href="process/role.php?role=rider" class="page-scroll btn btn-xl">Request a ride</a>';
					echo '</div>';
					echo '<div class="col-md-2"><br/></div>';
				}
				?>
			</div>
        </div>
    </header>
	
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
