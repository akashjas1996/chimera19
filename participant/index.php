<?php
session_start(); ?>

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

if(isset($_POST['remove_mobile'])){
	$mb_kid = $_POST['mob_rem'];
	$zero=0;
	$stmt_mbl_rem = $link->prepare("UPDATE khata SET contact=?, mob_verified=? WHERE kritarth_id=?");
	$stmt_mbl_rem->bind_param('ssi',$zero, $zero, $mb_kid);
	$stmt_mbl_rem->execute();


	echo '<script type="text/javascript">';
  		echo 'setTimeout(function () { swal("Removed!","Mobile Number Deleted.","success\");';
  		echo '}, 1000);
  		</script>';
}

if(isset($_POST['mobile_verify'])){
	$kid = $_POST['kid_otp'];
	$enteredOtp = $_POST['otp_no'];
	$query_vr = "SELECT * FROM khata where kritarth_id='$kid'";
	$res_vr = mysqli_query($link, $query_vr);
	$row_vr = mysqli_fetch_assoc($res_vr);
	if($row_vr['mob_otp']==$enteredOtp){
		
		$one = 1;
		$dflt = 1947;

		$stmt_mark = $link->prepare("UPDATE khata SET mob_verified=?, mob_otp=? WHERE kritarth_id=?");
		$stmt_mark->bind_param("ssi", $one, $dflt, $kid);
		$stmt_mark->execute();
		echo '<script type="text/javascript">';
  		echo 'setTimeout(function () { swal("Thanks!","Mobile Number Verified.","success");';
  		echo '}, 1000);
  		</script>';
	}
	else{
		echo '<script type="text/javascript">';
  		echo 'setTimeout(function () { swal("Sorry!","The OTP did not match.","warning");';
  		echo '}, 1000);
  		</script>';
	}
}

if(isset($_POST['otp_sent'])){

	$kid = $_SESSION['k_id'];
	$digits = 4;
	$otp =  rand(pow(10, $digits-1), pow(10, $digits)-1);
	$query_set_hash = "UPDATE khata SET mob_otp='$otp' WHERE kritarth_id='$kid'";
	$res_set_hash = mysqli_query($link, $query_set_hash);
	$mbl = $_POST['mobile_no'];

$curl = curl_init();

// curl_setopt_array($curl, array(
//    CURLOPT_URL => "https://api.msg91.com/api/sendhttp.php?mobiles=".$mbl."&authkey=296366AFcEP9oki5d8fad56&route=4&sender=KRTRTH&message=".$otp." is your verification Code.",



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://control.msg91.com/api/sendotp.php?template=hello&otp=".$otp."&otp_length=4&otp_expiry=10&sender=KRTRTH&message=".$otp." is the mobile Verification code for KRITARTH 5.0.&mobile=".$mbl."&authkey=296366AFcEP9oki5d8fad56",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $response;
}



}



if(isset($_POST['phone_save'])){
	$kid = $_POST['kid'];
	$phone_no = $_POST['cont_no'];


	$stmt_update_phone = $link->prepare("UPDATE khata SET contact=? WHERE kritarth_id=?");
	$stmt_update_phone->bind_param("si",$phone_no,$kid);
	$stmt_update_phone->execute();

	// $query_update_phone = "UPDATE khata SET contact='$phone_no' WHERE kritarth_id='$kid'";
	// $res_update_phone = mysqli_query($link, $query_update_phone);
	// echo mysqli_error($link);
}

if(isset($_POST['roll_save'])){
	$kid = $_POST['kid_roll'];
	$roll_no = $_POST['rollNo'];

	$stmt_update_roll = $link->prepare("UPDATE khata SET kiit_roll=? WHERE kritarth_id=?");
	$stmt_update_roll->bind_param("si",$roll_no,$kid);
	$stmt_update_roll->execute();
}



if(isset($_POST['participation_pressed'])){
	$evnt =  $_POST['req_event'];
	$kid =  $_POST['k_id'];
	if($kid!=$_SESSION['k_id']){
		redirect('https://kritarth.org/error.php');
	}
	$event_query = "SELECT * FROM pratispradha_chunao WHERE event_id='$evnt' AND kritarth_id = '$kid'";
	$res_event = mysqli_query($link, $event_query);
	if(mysqli_num_rows($res_event)>0){
			echo '<script type="text/javascript">';
  		echo 'setTimeout(function () { swal("Oops!","Already participating.","warning");';
  		echo '}, 1000);
  		</script>';
		}
		else{

			$query_event_insert = "INSERT INTO pratispradha_chunao(event_id, kritarth_id) VALUES('$evnt','$kid')";
			$res_event_insert = mysqli_query($link, $query_event_insert);
			echo mysqli_error($link);
			echo '<script type="text/javascript">';
  		echo 'setTimeout(function () { swal("Wow!","Added to participating events.","success");';
  		echo '}, 1000);
  		</script>';
		}
}

if(isset($_POST['participation_removal_pressed'])){
	$del_event = $_POST['del_event_id'];
	$del_id = $_SESSION['k_id'];
	$query_del = "DELETE FROM pratispradha_chunao WHERE event_id = '$del_event' AND kritarth_id='$del_id'";
	// echo $query_del;
	$res_del = mysqli_query($link, $query_del);
	// echo 
}

 ?>


<html lang="en">
	<head>
		<style>
			.payment_btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.payment_btn:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}

.payment_disabled_btn {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
}

.payment_disabled_btn:hover {
  cursor: default;
  text-decoration: none;
  border: none;
}
			.short_description_text:hover{
				text-shadow: 1px 1px #000000;
			}
			.card_lg{
				/*background:rgba(255,255,255,0.1);*/
				/*height: 200px;*/
				background-color: transparent;
				padding:20px
				border-radius: 30px;
				margin: 10px;
			}
			.event_img_card{
				margin-top: 20px;
				margin-bottom: : 20px;
				/*margin-bottom: 10px; */
				background-color: white;
				height: 250px;
				background-repeat: no-repeat;
				background-size: cover;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  				transition: 0.3s;
				/*background-size: auto;*/
				/*background-size:100% 100%;*/
			}
			.btn_style1{
				background-color: #D06A54;
				/*bordersssass: none;*/
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  				transition: 0.3s;
			}
			.btn_style1:hover{
				box-shadow: 0 8px 6px 0 rgba(0,0,0,0.4);
  				transition: 0.2s;
			}
			.btn_style2{
				background-color: #448CB8;
				/*border: none;*/
				box-shadow: 0 4px 4px 0 rgba(0,0,0,0.5);
  				transition: 0.3s;
			}
			.btn_style2:hover{
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  				transition: 0.3s;
			}
			.btn-success:focus {
    			outline: 0;
    			box-shadow: none!important;
    			cursor: default;
			}

			.btn-success{
				background-color: green;
				border-color: transparent;
				text-decoration: none;
				color: white;
				cursor: default;
				margin-top: 10px;
				margin-top: 20px;
				border-radius: 5px;
			}

			.btn-waiting:focus {
    			outline: 0;
    			box-shadow: none!important;
    			cursor: default;
			}

			.btn-waiting{
				background-color: orange;
				border-color: transparent;
				text-decoration: none;
				color: white;
				cursor: default;
				margin-top: 20px;
				border-radius: 5px;
			}
			.warning-block{
				background-color: #77aaff;
				/*border: 1px solid black;*/
				 padding: 10px;

				  -webkit-box-shadow: 3px 3px 5px 6px #ccc;  /* Safari 3-4, iOS 4.0.2 - 4.2, Android 2.3+ */
  -moz-box-shadow:    3px 3px 5px 6px #ccc;  /* Firefox 3.5 - 3.6 */
  box-shadow:         3px 3px 5px 6px #ccc;  /* Ope*/
   
			}

			.phone_save{
				/*background-color: green;*/
			}

.closebtn {
  /*margin-left: 15px;*/
  margin-right: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
	

		</style>

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title> Participant| Kritarth.org</title>
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
						<center> <h2 class="page-title">
							

							<?php
							if(isset($_SESSION['k_id'])){
								//echo $_SESSION['k_id'];
								echo "Welcome ";
								echo $_SESSION['name'].' ! ';
							}
							else{
							echo "Welcome Guest"; 
						}
							?>


						</h2>
						<p> Your Chimera ID is : <?php echo $_SESSION['k_id'] ?> </p>
						<?php 
						$kid = $_SESSION['k_id'];
						$query_mobile_change = "SELECT contact FROM khata WHERE kritarth_id='$kid'";
						$res_mobile_change = mysqli_query($link, $query_mobile_change);
						$row_mobile_change = mysqli_fetch_assoc($res_mobile_change);
						$mob = $row_mobile_change['contact'];
						if($mob>0){
							echo '<form action="" method="POST">
						 	Your mobile no. is: '.$mob.'
						 	<input type="hidden" value="'.$kid.'" name="mob_rem">
						 	<input style="display: inline" type="submit" value="Change" name="remove_mobile">
						 </form>';
						}
						 ?>
						<!-- <p> Note that FIRST YEAR B.TECH students won't be allowed for the event and star night. </p> -->
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<?php
										$kritarth_id = $_SESSION['k_id'];
										$query_contact_check = "SELECT * FROM khata WHERE kritarth_id='$kritarth_id'";
										$res_contact_check =  mysqli_query($link, $query_contact_check);
										$row = mysqli_fetch_assoc($res_contact_check);
										if($row['contact']>0){
											if($row['payment_status']==1){
												echo '<img style="width:90px" src="../images/paid.png">';
											}
											else{
											// 	echo '
											// <a href="../payment/request.php">
											// <button class="payment_btn">Pay Now</button>
											// </a>
											// ';

												echo '<img style="width:10%" src="../images/soldout.png">';
											}
											
										}
										else{ 
											?> <br>
						<div class="container warning-block">
							<div class="row">
								<div class="closebtn">x</div>
								<form method="POST" action="">
									<input name="kid" type="hidden" value ="<?php echo $kritarth_id ?>"  >
									<label style="color: black" for="info">Enter Mobile Number : </label>
									<input id="info" name="cont_no" style="width:40%; margin-left:20px; margin-right: 20px" type="text">
									<input class="phone_save" type="submit" name ="phone_save">
								</form>
							</div>
						</div>
						<br>
										<?php }
									 ?>
									 <br>
						<?php

						if($row['institute']=='KIIT' && $row['kiit_roll']==0){
							?>

							<div class="container warning-block">
							<div class="row">
								<div class="closebtn">x</div>
								<form method="POST" action="">
									<input name="kid_roll" type="hidden" value ="<?php echo $kritarth_id ?>"  >
									<label style="color: black" for="info">Enter KIIT Roll No. : </label>
									<input id="info" name="rollNo" style="width:40%; margin-left:20px; margin-right: 20px" type="text">
									<input class="phone_save" type="submit" name ="roll_save">
								</form>
							</div>
						</div>


					<?php	}

						 ?>

						 <?php
						 if($row['contact']>0 && $row['mob_verified']==0){
						 	echo '<br><strong>YOUR Mobile number has not been verified.</strong>';

						  ?>

						  <form action="" method="POST">
						  	<input type="hidden" name="mobile_no" value="<?php echo  $row['contact'] ?>">
						  	<input type="submit" name="otp_sent" value="SEND OTP">
						  </form>

						 <br>
						<div class="container warning-block">
							<div class="row">
								<div class="closebtn">x</div>
								<form method="POST" action="">
									<input name="kid_otp" type="hidden" value ="<?php echo $kritarth_id ?>"  >
									<label style="color: black" for="otp"> Enter OTP : </label>
									<input id="otp" name="otp_no" style="width:40%; margin-left:20px; margin-right: 20px" type="text">
									<input class="phone_save" type="submit" name ="mobile_verify">
								</form>
							</div>
						</div>
						<br>

						  <?php } ?>			
								</div>
							</div>
						</div>
						
						<hr>
						<h1 style="color: #448CB8"> Participating Events </h1>
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-sm-12 card_lg">
									
										<?php
										if(isset($_SESSION['k_id'])){
											$k_id = $_SESSION['k_id'];
										}

										$q2 = "SELECT * FROM pratispradha_chunao WHERE kritarth_id=$k_id";
										$res2 = mysqli_query($link, $q2);
										while($row2 = mysqli_fetch_assoc($res2)){
											$current_event_id = $row2['event_id'];
											$q3 = "SELECT * FROM pratispradha WHERE event_id='$current_event_id'";
											$res3 = mysqli_query($link, $q3);
											$row3 = mysqli_fetch_assoc($res3);
										 ?>
										 <br><br>
										 <div style="background-color: #E5E5E5" class="row">
										 	<div class="row">
										 		<?php 

										 		$status_query = "SELECT * FROM pratispradha_chunao WHERE event_id='$current_event_id' AND kritarth_id='$k_id'";
										 		$res_status = mysqli_query($link, $status_query);
										 		$row_status = mysqli_fetch_assoc($res_status);

										 		if($row_status['status']=="SELECT"){
										 			echo "NOT ATTENDED YET";
										 		}
										 		else if($row_status['status']=="ABSENT"){
										 			echo '<img style="width: 15%" src="../images/missed_badge.png">';
										 		}
										 		else if($row_status['jeet_haar']=="FIRST"){
										 			echo '<img style="width: 15%" src="../images/first_badge.png">';
										 		}
										 		else if($row_status['jeet_haar']=="SECOND"){

										 			echo '<img style="width: 10%" src="../images/second_badge.png">';

										 		}

										 		else if($row_status['jeet_haar']=="THIRD"){

										 			echo '<img style="width: 15%" src="../images/third_badge.png">';

										 		}

										 		else{

										 			echo '<img style="width: 15%" src="../images/participation_badge.png">';

										 		}

										 		?>
										 		
										 	</div>
										<div class="col-lg-4">
											
											<div class="event_img_card" style='background-image: url("../images/<?php echo $row3['event_image'] ?>")'>
												<div class="row">
														<h2> <?php echo $row3['event_name'] ?> </h2>
												</div>
											</div>
											<form action="" method="POST">
												<input type="hidden" name="del_event_id" value = "<?php echo $row3['event_id'] ?>">
											<div class="row">
												<button name="participation_removal_pressed" type="submit" class="btn_style1" style="width: 93%; color: black"> Remove </button>
											</div>
										</form>
										</div>
										
										<div class="col-lg-7" style=" margin: 10px;">

											<div class="br row">
												<div class="col-lg-8">
													<h4 align="left"> Venue :  <?php echo $row3['venue'] ?> </h4>
												</div>
												<div class="col-lg-4">
													<?php
													if($row2['status']=="PRESENT"){
														echo '<button type="button" class="btn btn-success">Attended</button>';
													 
													}
													else{
														$now = time(); // or your date as well
														$your_date = strtotime("2019-10-19");

														$datediff = $your_date - $now;
														$diff_rounded = round($datediff / (60 * 60 * 24));
														echo '<button type="button" class="btn btn-waiting">'.$diff_rounded.' Days Left</button>';
												}
												?>


												<!-- <form action="../Team" METHOD="POST">
												<input type="hidden" name="kid_team" value="<?php echo $_SESSION['k_id']?>">
												<input type="hidden" name="eventwa" value="<?php echo $row3['event_id']?>">
												<button type="submit" class="btn btn-waiting">TEAM MEMBERS</button>
												</form> -->


												</div>
											</div>
											
											

											<h4 align="left"> Date :  <?php echo $row3['d_date'] ?> </h4>
											<h4 align="left"> Time :  <?php echo $row3['t_time'] ?> </h4>
											<div>

											</div>
											<div style="cursor: pointer;" class="short_description_text">
											<p onclick="show_long_description(<?php echo $row3['event_id'] ?>)" align="left"> <b> About : </b> <?php echo nl2br2($row3['short_description'] .' Read more...') ?>  </p>
											</div>

											<div>
											<h4 style="line-height: 0" align="left"> First Prize :  <?php echo $row3['first_prize']?> </h4>
											<h4 style="line-height: 0" align="left"> Second Prize :  <?php echo $row3['second_prize']?> </h4>
											<h4 style="line-height: 0" align="left">  <?php

											if($row3['third_prize']>0)
											 	echo 'Third Prize : '.$row3['third_prize']
											 ?> </h4>
											</div>

											<div>
											<p style="display:none;" id="long_description_box<?php echo $row3['event_id'] ?>" align="left"> <b> Rules and Regulations : </b> <?php echo nl2br($row3['long_description']) ?>  </p>
											</div>


										</div>
										</div>
									<?php } ?>

									<?php
										$kid = $_SESSION['k_id'];
										$q4 = "SELECT * FROM pratispradha_chunao WHERE kritarth_id = '$kid'" ;
										$r4 = mysqli_query($link, $q4);
										if(mysqli_num_rows($r4)==0){
											echo "<center> <h2> No events choosen. </h2> </center>";
										}


									 ?>


									
							</div>
							</div>
						</div>
						<br><hr><br>
						<h1 style="color: #D06A54"> All Events </h1>

						<br> <br>
						<center><p>Events to be uploaded soon.</p></center>
						<!-- <div class="container">
							<div class="row">
								<div class="col-lg-12 col-sm-12 card_lg">
									<div class="row">
										<?php
										$q1 = "SELECT * FROM pratispradha";
										$res1 = mysqli_query($link, $q1);
										while($row1 = mysqli_fetch_assoc($res1)){

										 ?>
										<div class="col-lg-4">
											<?php $event_id = $row1['event_id']; ?>
											<div onclick="check(<?php echo $event_id ?>,<?php echo $k_id; ?>)" class="event_img_card" style='background-image: url("../images/<?php echo $row1['event_image'] ?>")'>
												<h2> <?php echo $row1['event_name'] ?> </h2>
											</div>
											<br>
											
											<form action="" method="POST">
											<div class="row">
												<input type="hidden" name="req_event" value="<?php echo $event_id; ?>">
												<input type="hidden" name="k_id" value="<?php echo $k_id; ?>">
												<button name="participation_pressed" type="submit" class="btn_style2" style="width: 93%"> Participate </button>
											</div>
										</form>
										 <div class="row">
										 	<a href="../Info/?ei=<?php echo $event_id ?>">
												<button class="btn_style1" style="width: 93%;"> Details </button>
											</a>
											</div>
										</div>

									<?php } ?>
									</div>
							</div>
						</div>


					</center>
				</div> -->
			</div>
				
			</main> <!-- .main-content -->

			<?php include '../inc/footer.php' ?>

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
		<script>
			function activate_details_box(a){
				a = 'details_box'+a;
				console.log(a);
				document.getElementById(a).style.display="block";
			}
		</script>
		<script type="text/javascript">
			function show_long_description(a){
				a = "long_description_box"+a;

				if(document.getElementById(a).style.display==='block')
					document.getElementById(a).style.display="none";
				else{
					document.getElementById(a).style.display="block";
				}
				console.log(a);
			}
		</script>
	</body>

</html>