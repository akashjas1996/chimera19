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


if(isset($_POST['edit_event_info_button'])){
	$ename =  $_POST['e_name'];
	$edate =  $_POST['e_date'];
	$etime =  $_POST['e_time_set'];
	$evenue =  $_POST['e_venue'];
	$efprize =  $_POST['f_prize'];
	$esprize =  $_POST['s_prize'];
	$etprize =  $_POST['t_prize'];


	// $efprize =  0;
	// $esprize =  0;
	// $etprize =  0;


	$eabout =  $_POST['e_about'];
	$erules =  $_POST['e_rules'];
	$eeid =  $_POST['get_event_id'];
	$_POST['edit_event_id']=$eeid;

	// echo $ename;
	// echo $edate ;
	// echo $etime;
	// echo $evenue;
	// echo $efprize;
	// echo $esprize;
	// echo $etprize;
	// echo $eabout;
	// echo $erules;
	// echo $eeid;

	$qr = "UPDATE pratispradha SET event_name='$ename', d_date='$edate', t_time='$etime', venue='$evenue', first_prize='$efprize', second_prize='$esprize', third_prize='$etprize', short_description='$eabout', long_description='$erules' WHERE event_id='$eeid'";
	 // echo $qr;

	$res_qr = mysqli_query($link, $qr);
	echo mysqli_error($link);
	// redirect('../admin/');



	// $stmt_update_event = $link->prepare("UPDATE pratispradha SET event_name=? d_date=? t_time=? venue=? first_prize=? second_prize=? third_prize=? short_description=? long_description=? WHERE event_id=?");
	// $stmt_update_event->bind_param("sssssssssi", $ename, $edate, $etime, $evenue, $efprize, $esprize, $etprize, $eabout, $erules, $eeid);
	//  echo mysqli_error($link);
	// $stmt_update_event->execute();
}
?>



<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title> chimera.org.in</title>
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
			<?php include '../inc/header.php';
			if(isset($_POST['edit_event_id'])){
				$edit_event = $_POST['edit_event_id'];
			}
			else{
				echo "EVENT TO BE EDITED IS BLANK";
			}
			?>
			<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
						<div class="row">
							<div class="col-lg-9">
								<?php

								$query_get_event_info = "SELECT * FROM pratispradha WHERE event_id = '$edit_event'";
								$res_get_event_info = mysqli_query($link, $query_get_event_info);
								$row_get_event_info = mysqli_fetch_assoc($res_get_event_info);
								 ?>
								
								 <form action="" METHOD="POST">
								 	<input name="e_name" style="font-size: 50px" type="text" value="<?php echo $row_get_event_info['event_name'] ?>">
								<h1>  </h1>
								<br>
								<h2>Venue and Schedule</h2>
								Venue :  &nbsp; <input name="e_venue" type="text" value="<?php echo $row_get_event_info['venue']?>"> <br>
								<br>
								Date : &nbsp; &nbsp; &nbsp; <input name="e_date" type="date" value = "<?php $dt = $row_get_event_info['d_date']; echo $dt ?>"> <br>
								Time :&nbsp; &nbsp; &nbsp; <input name="e_time_set" type="time" value="<?php $tm=$row_get_event_info['t_time'];
								 echo $tm; ?>">
							</div>
							<div class="col-lg-3">
								<img style="margin-top: 25px; width: 200px" src="../../images/<?php echo $row_get_event_info['event_image']?>">
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<h2>Prize Money</h2>
								<br>&nbsp;&nbsp; <input name="f_prize" style="width: 80px" type="number" max="99999"  value="<?php echo $row_get_event_info['first_prize'] ?>"> <br>
								 <input style="display: none; width: 80px" name="s_prize" type="number" max="99999"  value="<?php echo $row_get_event_info['second_prize'] ?>"> <br>
								&nbsp; <input style="display: none; width: 80px" name="t_prize" type="number" max="99999"  value="<?php echo $row_get_event_info['third_prize'] ?>"> <br>
								
								<h2>About</h2>
								<textarea name="e_about"  style="width: 100%;height: 100px"> <?php echo $row_get_event_info['short_description'];?> </textarea>
								<h2>Rules and Regulations </h2>
								<textarea name="e_rules" style="width: 100%; height: 20em"><?php echo $row_get_event_info['long_description']; ?></textarea> <br><br>
								<input name="get_event_id" value="<?php echo $edit_event ?>" type="hidden">
								<input type="submit" name="edit_event_info_button" value="UPDATE">
							</form>

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
		
	</body>

</html>