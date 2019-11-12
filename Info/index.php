<?php session_start(); ?>

<!DOCTYPE html>


<?php
include '../inc/dbconnection.php';
function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function nl2br2($string) {
$string = str_replace(array("\r\n", "\r", "\n"), "</li><li>", $string);
$string = substr($string,0,strlen($string)-2);
return $string;
}
?>


<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title> EVENT | CHIMERA</title>
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
		<script>

		</script>
	</head>

	<body>
		
		<div id="site-content">
			<?php include '../inc/header.php';
			if(isset($_GET['ei'])){
				$event = $_GET['ei'];
			}
			else{
				$event = 1;
			}
			$query_abt_event = "SELECT * FROM pratispradha WHERE event_id = '$event'";
			$res_abt_event = mysqli_query($link, $query_abt_event);
			$row_abt_event = mysqli_fetch_assoc($res_abt_event);
			?>
			
			<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
						<div class="row">
							
							<div class="col-lg-9">
								<h1> <?php echo $row_abt_event['event_name'] ?> </h1>
								<br>
								<h2>Venue and Schedule</h2>
								<?php echo $row_abt_event['venue'] ?> <br>
								<?php echo $row_abt_event['d_date'] ?> &nbsp; <?php echo $row_abt_event['t_time'] ?>
							</div>
							<div class="col-lg-3">
								<img style="margin-top: 25px; width: 200px" src="../../images/<?php echo $row_abt_event['event_image']?>">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<h2>Prizes Worth</h2>
								<?php echo $row_abt_event['first_prize'] ?> <br>
								
								<h2>About</h2>
								<?php echo $row_abt_event['short_description'] ?>
								<h2>Rules and Regulations </h2>
								<?php 

								echo nl2br2('<li>'.$row_abt_event['long_description']); ?>
							</div>
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->

			<?php include '../inc/footer1.php' ?>

		</div> <!-- #site-content -->

		<script src="../js/jquery-1.11.1.min.js"></script>	
		<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>	
		<script src="../js/plugins.js"></script>
		<script src="../js/app.js"></script>

		<script>
			function college_chosen(a){
				document.getElementById('fee').style.display="block";
				if(a.value==='KIIT' || a.value==='KISS' || a.value==='KIMS' || a.value==='KSOM' || a.value==='KSOL' || a.value==='Kiit International School' ){
				document.getElementById('fee').value="150";
				document.getElementById('fee_store').value="150";}
				else{
				document.getElementById('fee').value="200";
				document.getElementById('fee_store').value="150";}
			}
		</script>
		
	</body>

</html>