<?php
session_start();
include("../inc/dbconnection.php");

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

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_d73f7f56f5629d084e4e8aeb22b",
                  "X-Auth-Token:test_2439f47e0e504d0f8b3be281e02"));

if(isset($_SESSION['k_id'])){
    $kid = $_SESSION['k_id'];
$query_getinfo = "SELECT * FROM `khata` WHERE kritarth_id = '$kid'";
$result_getinfo = mysqli_query($link, $query_getinfo);
$row_getInfo = mysqli_fetch_assoc($result_getinfo);
$mac = '4365551a42d547a08c698b341d835d53';
$salt = '4365551a42d547a08c698b341d835d53';
$id = $kid;
$name = $row_getInfo['name'];
$email = $row_getInfo['email'];
$phone = $row_getInfo['contact'];
$amt = $row_getInfo['amt'];
// if($amt!=200 || $amt!=250){
//     redirect("https://kritarth.org/payment/payment_problem.php");
// }
$payload = Array(
    'purpose' => 'Chimera19-'.$kid,
    'amount' => $amt,
    'phone' => $phone,
    'buyer_name' => $name,
    // 'redirect_url' => 'https://www.kritarth.org/payment/success.php',
    'redirect_url' => 'http://chimera.org.in/payment/success.php',
    'send_email' => true,
    'webhook' => 'http://chimera.org.in/payment/webhook.php',
    'send_sms' => true,
    'email' => $email,
    'allow_repeated_payments' => false,
);
echo $payload;
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$paymentArray = json_decode($response, true);
 print_r($paymentArray);
$long_url = $paymentArray['payment_request']['longurl'];
redirect($long_url);
//session_destroy();
}
?>