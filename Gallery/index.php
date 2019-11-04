<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title> Gallery | Kritarth 5.0</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
		<link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="../style/style.css">
		<link rel="shortcut icon" href="../images/favicon.png">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>

	<body>
		
		<div id="site-content">
			<?php include '../inc/header.php' ?>
			
			<main class="main-content">
				<div class="fullwidth-block gallery">
					<div class="container">
						<div class="content fullwidth">
							<h2 class="entry-title">Gallery</h2>
							<!-- <div class="filter-links filterable-nav">
								<select class="mobile-filter">
									<option value="*">Show all</option>
									<option value=".concert">Concert</option>
									<option value=".band">Band</option>
									<option value=".stuff">Stuff</option>
								</select>
								<a href="#" class="current" data-filter="*">Show all</a>
								<a href="#" data-filter=".concert">Concert</a>
								<a href="#" data-filter=".band">Band</a>
								<a href="#" data-filter=".stuff">Stuff</a>
							</div> -->
							<div class="filterable-items">


								<div class="filterable-item concert">
									<a href="../images/p1.jpg"><figure><img src="../images/p1.jpg" alt="gallery 1"></figure></a>
								</div>

								<div class="filterable-item concert">
									<a href="../images/p2.jpg"><figure><img src="../images/p2.jpg" alt="gallery 1"></figure></a>
								</div>


							</div>
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->

			<?php include '../inc/footer.php' ?>

		</div> <!-- #site-content -->

		<script src="../js/jquery-1.11.1.min.js"></script>		
		<script src="../js/plugins.js"></script>
		<script src="../js/app.js"></script>
		
	</body>

</html>