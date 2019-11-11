<?php
session_start();
include '../inc/dbconnection.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<style>
			.cards{
				width: 100%;
				padding: 20px;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  				transition: 0.3s;
			}

			.cards:hover{
				-webkit-filter: drop-shadow(16px 16px 10px rgba(0,0,0,0.9));
  				filter: drop-shadow(16px 16px 10px rgba(0,0,0,0.9));
			}

			.event_name {
  color: #2c87f0;
}
.event_name:visited {
  color: #636;
}
.event_name:hover, a:active, a:focus {
  color:#c33;
}
		</style>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title> EVENTS | Chimera</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
		<link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="../style/style1.css">
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
							<h2 class="entry-title">Events</h2>
							<div class="container">
								<div class="row">
									<?php 
									$query_fetch_all_event = "SELECT * FROM pratispradha";
									$res_fetch_all_event = mysqli_query($link, $query_fetch_all_event);
									while($row_fetch_all_event = mysqli_fetch_assoc($res_fetch_all_event)){
									 ?>
									 <a style="text-decoration: none" href="../Info/?ei=<?php echo $row_fetch_all_event['event_id'] ?>">
									<div class="col-lg-4">
										<div class="row">
											<img  class="cards" src="../images/<?php echo $row_fetch_all_event['event_image'] ?>">
										</div>
										<div class="row">
											<center> <h2 class = "event_name"><?php echo $row_fetch_all_event['event_name'] ?></h2> </center>
										</div>
									</div>
								</a>
								<?php } ?>
									

									
								
								</div>
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