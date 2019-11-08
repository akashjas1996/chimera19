<head>
	<style>

		

		
	</style>
</head>

<header class="site-header" style="background-color: #c89d46">
				<div class="container" style="background-color: #c89d46">
					<a href="../" id="branding" >
						<img width="120px" src="../images/chimera_white.png" alt="Site Title">
						<!-- <small class="site-description">Slogan goes here</small> -->
					</a> <!-- #branding -->
					
					<nav class="main-navigation">
						<button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<!-- current-menu-item -->
							<li class="menu-item"><a href="../">Home</a></li>
							<li class="menu-item"><a href="../Gallery">Gallery</a></li>
							<li class="menu-item"><a href="../Events">Events</a></li>
							<li class="menu-item"><a href="../Contact">Contact</a></li>
							<?php
							if(isset($_SESSION['k_id'])){
								$name = $_SESSION['name'];
								echo '<li class="menu-item"><a href="../participant">'.$name.'</a></li>';
							}
							else{
								echo '<li class="menu-item"><a href="../login">Login</a></li>';
							 
							}
							?>

								<?php
							if(isset($_SESSION['k_id'])){
								echo '<li class="menu-item"><a href="../logout">Logout</a></li>';
							}
							else{
								echo '<li class="menu-item"><a href="../Registration">Register</a></li>';
							 
							}
							?>
						</ul> <!-- .menu -->
					</nav> <!-- .main-navigation -->
					<div class="mobile-menu"></div>
				</div>
			</header> <!-- .site-header -->