<?php
include '../inc/dbconnection.php';

	// if (!(isset($_POST["kid"])&&isset($_POST["username"])&&isset($_POST["password"]))) {
	// 	echo "Some error occurred";
	// 	exit();
	// }
	$kid=$_REQUEST["kid"];
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];


	//TODO add include for db link
	$conn=$link;
	$admin_query = "SELECT * FROM khata WHERE email='$username' AND password='$password' AND role=2";//TODO query to verify admin user and password combination
	// echo $admin_query;
	$result=mysqli_query($conn,$admin_query);
	if(mysqli_num_rows($result) == 1){
		if($kid== -1){
			echo 'success';
		}
		else{
			$query ="SELECT * FROM pratispradha_mukhiya WHERE email=$username";//TODO query to find event associated with the admin
			$result = mysqli_query($conn,$query);
			if (mysqli_num_rows ( $result ) > 0) {
				$row=mysqli_fetch_assoc($result);
				$event_id=$row["pratispradha_id"];//TODO fetch event id from result of above query
				$query ="SELECT * FROM pratispradha_chunao WHERE kritarth_id=$kid AND event_id=$event_id";//TODO query to verify kid received against authorised event_id
				//ALSO TAKE CARE OF ENCRYPTING/DECRYPTING of kid(If required)
				$result = mysqli_query($conn,$query);
				if (mysqli_num_rows ( $result ) > 0) {
				$row=mysqli_fetch_assoc($result);
				if($row["status"]=="PRESENT")//TODO
					echo "QR already scanned";
				else{
					$query="UPDATE pratispradha_chunao SET status='PRESENT' WHERE kritarth_id=$kid AND event_id=$event_id";//TODO query to update the table event so that kid is marked present 
					mysqli_query($conn,$query);
					echo "success";
				}
			}
			else
				echo "Admin not authorized";
		}
	}
}
	else{
		echo 'fail';
	}
?>
