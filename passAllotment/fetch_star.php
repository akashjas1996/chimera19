<?php
include '../inc/dbconnection.php';
if(isset($_POST['kid'])){
    $k_id = $_POST['kid'];
    $status = $_POST['status'];
    if($_POST['status']=='GIVEN'){
        $q1 = "UPDATE khata SET star_night=1 WHERE kritarth_id='$k_id'";
        //echo '<script> console.log("ABSENT PRESSED"); </script>';
    }
    // else if($_POST['status']=="PRESENT"){
    //     $q1 = "UPDATE pratispradha_chunao SET status='PRESENT' WHERE kritarth_id='$k_id' AND event_id='$event_id'";
    //     //echo '<script> console.log("PRESENT PRESSED"); </script>';
    // }
    $res1 = mysqli_query($link, $q1);
}
?>