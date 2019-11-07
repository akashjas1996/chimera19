<?php
include '../inc/dbconnection.php';
$data = $_POST;
$mac_provided = $data['mac'];  
echo $mac_provided;
// Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
//salt= 29ac91de833b49f9ab7a0bde653ac337;
$mac_calculated = hash_hmac("sha1", implode("|", $data), "4365551a42d547a08c698b341d835d53");
if(isset($_POST['buyer'])){
    echo $_POST['buyer'];
    echo $_POST['payment_id'];
    echo $_POST['status'];
}
else{
    echo "Not got";
}

if($mac_provided == $mac_calculated){
    // Do something here
    if($data['status'] == "Credit"){
       //echo "The payment was successful.";
        $buyer = $_POST['buyer'];
        $payment_id = $_POST['payment_id'];
        $date_time = date('Y-m-d h:i:sa');
        $query_update_payment_status = "UPDATE khata SET payment_status=1, transaction_id='$payment_id', payment_date_time='$date_time' WHERE email='$buyer'";
        $res_update_payment_status = mysqli_query($link, $query_update_payment_status);
    }
    else{
        // Payment was unsuccessful, mark it as failed in your database
        echo "The payment was unsuccessful";
        $buyer = $_POST['buyer'];
        $payment_id = $_POST['payment_id'];
        $query_update_payment_status = "UPDATE khata SET payment_status=9, transaction_id='$payment_id'  WHERE email='$buyer'";
        $res_update_payment_status($link, $res_update_payment_status);
    }
}
else{
    echo "Invalid MAC passed";
    echo $mac_provided;
    echo $mac_calculated;
}
?>