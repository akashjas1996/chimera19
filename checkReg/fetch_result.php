<?php
include '../inc/dbconnection.php';
if(isset($_POST['kid'])){
    $k_id = $_POST['kid'];
    $event_id = $_POST['eventid'];
    $result = $_POST['result'];

        $q1 = "UPDATE pratispradha_chunao SET jeet_haar='$result' WHERE kritarth_id='$k_id' AND event_id='$event_id'";
    $res1 = mysqli_query($link, $q1);

}
?>