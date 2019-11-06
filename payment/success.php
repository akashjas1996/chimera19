<?php
include '../inc/dbconnection.php';

// echo "Payment Successful";
$ch = curl_init();
$vars=$_GET['payment_request_id'];
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$vars.'/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_d73f7f56f5629d084e4e8aeb22b",
                  "X-Auth-Token:test_2439f47e0e504d0f8b3be281e02"));
$response = curl_exec($ch);

$phpvar = json_decode($response);
//$ch_id = $response['payment_request']['purpose'];
	//echo $response;
	$pid = $_GET['payment_id'];
		$query_trs = "SELECT * FROM `khata` WHERE `transaction_id` = '$pid'";
$result_trs = mysqli_query($link, $query_trs);
            $row_trs = $result_trs->fetch_assoc();
			$ch_id = $row_trs['kritarth_id'];
			$client_name = $row_trs['name'];
curl_close($ch); 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment Successful</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<style type="text/css">
	html { 
		  background: url(background.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
</style>
</head>
<body>
<div class="container" style="background: white;">
	<div class="col s12 m2 z-depth-5 center-align" style="margin-top: 15%;padding: 10px; ">
	<p><b><h4>Hey, <?php echo $client_name.' ' ?> You have successfully completed your payment!</h4></b></p>
	<p><h5><b>Chimera ID:</b> <?php echo $ch_id;?></h5></p>
	<p><h5><b>Payment ID:</b> <?php echo $_GET['payment_id'];?></h5></p>
	</div>
</div>

<div class="container">
	<center>
		<div class="row">
			<a href="http://chimera.org.in/participant"> Click Here </a>
		</div>
	</center>
</div>
</body>
</html>