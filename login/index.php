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



if(isset($_POST['login'])){
	$email =  $_POST['email'];
	//echo $email;
	if(isset($_POST['password'])){
		$password = $_POST['password'];
		//echo $password;
		$query_verify = "SELECT * FROM khata WHERE email = '$email' AND password = '$password'";
		$res = mysqli_query($link, $query_verify);
		if(mysqli_num_rows($res)>0){
			$row = mysqli_fetch_assoc($res);
			$_SESSION['k_id'] = $row['kritarth_id'];
			$_SESSION['name'] = $row['name'];

			if(isset($_GET['url'])){
				if($_GET['url']=='admin'){
				redirect('../admin');
				}
				if($_GET['url']=='regstatus'){
					redirect('../regstatus');
				}
				if($_GET['url']=='calltopay'){
					redirect('../calltopay');
				}
				if($_GET['url']=='passAllotment'){
					redirect('../passAllotment');
				}

			}
			else{
				redirect('../participant/');
			}

		}
		else{
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Oops","Email and password do not match.","warning");';
  echo '}, 1000);</script>';

		}
	}
	else{
		echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal("Oops","Password and confirm password do not match.","warning");';
  echo '}, 1000);</script>';
}

 
}

 ?>


<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title> Login| Chimera</title>
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
		<script>

		</script>
	</head>

	<body>
		
		<div id="site-content">
			<?php include '../inc/header.php' ?>
			
			<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
						<center> <h2 class="page-title">Login</h2> </center>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<form action="" class="contact-form" method="POST">
									<input name="email" type="text" placeholder="Email Address">
									<input required="" name="password" type="password" placeholder="Password"..>
									<input style="background-color: #880691" name="login" type="submit" value="Submit">
								</form>
							</div>

							<div class="col-md-3"></div>
							<!-- <div class="col-md-6">
								<div class="map-wrapper">
									<div class="map"></div>
									<address>
										<div class="row">
											<div class="col-sm-6">
												<strong>Company Name INC.</strong>
												<span>40 Sibley St, Detroit</span>
											</div>
											<div class="col-sm-6">
												<a href="mailto:office@companyname.com">office@companyname.com</a> <br>
												<a href="tel:532930098891">(532) 930 098 891</a>
											</div>
										</div>
									</address>
								</div>
							</div> -->
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