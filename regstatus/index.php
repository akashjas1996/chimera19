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



 ?>


<html lang="en">
	<head>

		<style>


						table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}


			table.blueTable {
  border: 1px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 100%;
  text-align: left;
  border-collapse: collapse;
}
table.blueTable td, table.blueTable th {
  border: 1px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 13px;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  border-left: 2px solid #D0E4F5;
}
table.blueTable thead th:first-child {
  border-left: none;
}

table.blueTable tfoot {
  font-size: 14px;
  font-weight: bold;
  color: #FFFFFF;
  background: #D0E4F5;
  background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
  border-top: 2px solid #444444;
}
table.blueTable tfoot td {
  font-size: 14px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}
		</style>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<title> Registrations| Kritarth.org</title>
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
			<?php include '../inc/header.php'; $sl_no=0; ?>
			
			<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
						<center> <h2 class="page-title">
							<?php $kid =  $_SESSION['k_id'];
							 $query_get_verify = "SELECT * FROM khata WHERE kritarth_id = '$kid'";
							 $res_get_verify = mysqli_query($link, $query_get_verify);
							 $row_get_verify = mysqli_fetch_assoc($res_get_verify);
							 $role = $row_get_verify['role'];
							 // echo $role;
							 if($role!=2){
								redirect('../login/index.php?url=regstatus');
							 }
							// echo $row_get_email['name']." !";
						  ?></h2> 
						<div class="row">
							<h1>Total Registrations</h1>
							<?php
							$count_all = "SELECT * FROM khata;";
							$res_all = mysqli_query($link, $count_all);
							$row_all = mysqli_num_rows($res_all);
							 ?>
							<h3><?php echo $row_all; ?></h3>
							<h1>Paid Registrations</h1>
							<?php
							$count_paid = "SELECT * FROM khata WHERE payment_status=1;";
							$res_paid = mysqli_query($link, $count_paid);
							$row_paid = mysqli_num_rows($res_paid);
							?>
							</h3><?php echo $row_paid; ?></div>


							<h1>Pass Alloted till now</h1>
							<?php
							$count_pass = "SELECT * FROM khata WHERE pass=1;";
							$res_pass = mysqli_query($link, $count_pass);
							$row_pass = mysqli_num_rows($res_pass);
							?>
							</h3><?php echo $row_pass; ?></div>

							<br><br>
							<center>
							<h1>KIITINS</h1>
							<?php
							$count_kiitians = "SELECT * FROM khata WHERE institute='KIIT'";
							$res_kiitians = mysqli_query($link, $count_kiitians);
							$row_kittians = mysqli_num_rows($res_kiitians);
							?>
							</h3><?php echo $row_kittians; ?></div>
							</center>


							<center>
							<h1>NON - KIITINS</h1>
							<?php
							$count_others = "SELECT * FROM khata WHERE institute='Others';";
							$res_others = mysqli_query($link, $count_others);
							$row_others = mysqli_num_rows($res_others);
							?>
							</h3><?php echo $row_others; ?></div>
						</center>


							<?php 

							$query_mail_progress = "SELECT * FROM khata WHERE mail_1=0 && payment_status=0";
							$res_mail_progress = mysqli_query($link, $query_mail_progress);
							$row_mail_progress = mysqli_fetch_assoc($res_mail_progress);

							$result = mysqli_num_rows($res_mail_progress);

							if($result>0){
								echo "Mail in Progress.";
							}
							else{
								echo "All mails sent.";
							}


							 ?></div>
						</div>
						</center>
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
		<script type="text/javascript">
			// function mark_attendance(a,b){
			// 	console.log(a);
			// 	console.log(b);
			// }

			function mark_attendance(kid,eventid,ob) {
               // alert(status);
                //alert(empid)
                console.log(kid);
                console.log(eventid);
                console.log(ob.value);
                $.ajax({
                    url: "fetch_att.php",
                    method: "POST",
                    data: {
                        kid: kid,
                        eventid: eventid,
                        status:ob.value,
                    },
                    success: function(data) {
                      //  $('#result').html(data);
                    }
                });
            }


		</script>
	</body>
</html>