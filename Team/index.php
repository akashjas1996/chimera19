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


} ?>


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
			
			<main style="height: 300px">
			<?php 

			if(!isset($_POST['kid_team'])){
				 redirect("https://kritarth.org/participant");
			}
			else{
				$kid = $_SESSION['k_id'];
				$eventwa = $_POST['eventwa'];
				// echo $eventwa;
			}
			$query_team = "SELECT * FROM team_tbl WHERE kritarth_id='$kid'";
			$res_team = mysqli_query($link, $query_team);
			$row_team = mysqli_fetch_assoc($res_team);
			if(mysqli_num_rows($res_team)==0){
				echo "<center><h1>TEAM NOT CREATED</h1></center>";
				?>

					<form action="" method="POST">
						<input type="hidden" name="kid_team" value="<?php echo $_POST['kid_team']?>">
						<input type="hidden" name="eventwa" value="<?php echo $_POST['eventwa']?>">
						<center><button name = "create_mem">CREATE TEAM</button></center>;
					</form>

				<?php
				echo '<br>';
				echo '<center><button onclick="show_form()">ADD MEMBER</button></center>';
				?>
				<br><br>
				<div id="addition" style="display: none">
				<center>
					<form method="POST" action="">
						<lable for="kiiid"> KRITARTH ID - </lable>
						<input type="hidden" name="kid_team" value="<?php echo $_POST['kid_team']?>">
						<input type="hidden" name="eventwa" value="<?php echo $_POST['eventwa']?>">
						<input name="kiiid" id="kiiid" type="text" name="Kritarth_id">
						<input name="add_button" type="submit">
					</form>
				</center>
			</div>
				<?php
			}
			else{
				$team_id = $row_team['team_id'];
				echo "<center><h1> Team ID - ".$row_team['team_id']."</h1></center>";
				echo "<center><h1> Team Name - ".$row_team['t_name']."</h1></center>";
				echo '<center><table><tr>
				<th>KR ID</th>
				<th> NAME </th>
				</tr>';
				$query_team_member = "SELECT * FROM team_tbl WHERE team_id='$team_id'";
				$res_team_member = mysqli_query($link, $query_team_member);
				while($row_team_id = mysqli_fetch_assoc($res_team_member)){
					echo '<tr>';
					echo '<td>';
					echo $row_team_id['kritarth_id'];
					echo '</td>';
					echo '<td>';
					echo $row_team_id['t_name'];
					echo '</td>';
					echo '</tr>';
				}
			}

			echo '<center>';
		if(isset($_POST['add_button'])){
    	$id = $_POST['kiiid'];
    	$event_id = $_POST['eventwa'];
    	$query_check = "SELECT * FROM pratispradha_chunao WHERE kritarth_id='$id' AND event_id='$event_id'";
    	$res_check = mysqli_query($link, $query_check);
    	$row_check = mysqli_fetch_assoc($res_check);
    	if(mysqli_num_rows($res_check)==0){
    		echo "Check Kritarth ID";
    	}
    	else{
    		// $stmt_add = link->prepare("INSERT INTO team_tbl('kritarth_id') VALUES(?,?,?) ");
    		// $stmt_add->bind_param('',);
    	}
    }

    if(isset($_POST['create_mem'])){
    	$kidd = $_SESSION['k_id'];
    	$
    	$query_check = "INSERT INTO pratispradha_chunao('','') VALUES(?,?)";
    	$res_check = mysqli_query($link, $query_check);
    }
    echo '<center>';


			?>
		</table>
	</center>
			<div>
			</div>
		</main>
		<br><br>
		<br><br>
			<?php include '../inc/footer.php' ?>
			</div>
		</div> <!-- #site-content -->

		<script src="../js/jquery-1.11.1.min.js"></script>	
		<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>	
		<script src="../js/plugins.js"></script>
		<script src="../js/app.js"></script>
		<script>
			function show_form(){
				document.getElementById("addition").style.display="block";	
			}
		</script>

		
	</body>

</html>