<?php
	if (!(isset($_POST["kid"])&&isset($_POST["username"])&&isset($_POST["password"]))) {
		echo "Some error occurred";
		exit();
	}
	$kid=$_POST["kid"];
	$user=$_POST["username"];
	$pass=$_POST["password"];

include '../inc/dbconnection.php';
$conn = $link;
	

	$admin_query = "SELECT * FROM khata WHERE email='$user' AND password='$pass' AND role=2";
	echo mysqli_error($conn);
	$result=mysqli_query($conn,$admin_query);
	if(mysqli_num_rows($result) == 1){
		if($kid == -1)
			echo 'success';
		else{
			$query ="SELECT * FROM pratispradha_mukhiya WHERE email='$user'";
			$result = mysqli_query($conn,$query);
			if (mysqli_num_rows ( $result ) > 0) {
				$row=mysqli_fetch_assoc($result);
				if($row["status"]==1)
					echo "QR already scanned";
				else{
					$query="UPDATE tbl_event SET status=1 WHERE entry_id=$kid";
					mysqli_query($conn,$query);
					echo "success";
				}
			}
			else
				echo "Participant does'nt exist";
		}
	}
	else{
		echo 'fail';
	}
//$kid="12345";
  // include('/lib/qrgenerator/qrlib.php');
// echo '<img src="getImage.php?kid='.$kid.'" />';
//echo "success"
?>