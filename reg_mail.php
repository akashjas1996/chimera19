<?php
session_start();
include 'inc/dbconnection.php';
 ob_start();
// session_start();
// require'inc/dbconnection.php';
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
 require_once 'vendor/autoload.php';
 
 if(isset($_REQUEST['email']))
 {
     $email=$_REQUEST['email'];
     $hash = md5(rand(0,1000) );
     $query=mysqli_query($link,"UPDATE khata SET hash='$hash' WHERE email='$email';");
     $selQuery="select * from khata where email='$email';" ;
     $res=@mysqli_query($link,$selQuery);
     $row=  mysqli_fetch_assoc($res);
     $mail = new PHPMailer();
     $mail->setFrom("info@kritarth.org","KRITARTH 5.0");
     $mail->addAddress($email,$row['email']);
     $mail->isHTML(TRUE);
     $mail->Subject = "WELCOME TO KRITARTH 5.0";
      $mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.hostinger.in";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "info@kritarth.org";                 
$mail->Password = "RF4k!a0h";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port =587;

echo "Reaching";
     $mail->Body  = <<<EOF
                <!DOCTYPE html>
<html>

<head>
    <style>
        .br{
            /*border:0px solid black;*/
        }
    </style>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>

    <style type="text/css">
      /*.br{
        border:1px solid black;
      }*/
      .button {
  background-color: #a23938; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-decoration: none;
  display: inline-block;
  border-radius: 20px;
  font-size: 16px;
}
    </style>
    <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]-->
    <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
</head>

<body>
    <div class="es-wrapper-color">
        <table class="br es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table class="es-content" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe">
                                        <table class="br es-content-body" style="border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p40b es-p40r es-p40l" esd-custom-block-id="8537" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0" class="br">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" align="left" width="518">
                                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                                            <tbody>
                                                                              
                                                                                <tr>
                                                                                    <td class="br esd-block-text es-m-txt-c">
                                                                                        <h2>Hey $row[name]!, Greetings from Team Kritarth!<br></h2>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="br esd-block-text es-m-txt-c es-p15t">
                                                                                        <p>Now that you have registered successfully, allow us to welcome you on-board on our entralling journey. To book the tickets to the finale and confirming your participation, please stay tuned. <br> <br> We are thrilled to have you on-board and looking forward to your participation in this enticing fiesta. <br><br> Best wishes, <br> Team Kritarth</p>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="esd-block-button es-p20t es-p15b es-p10r es-p10l" align="center">
                                                                                        <span class="es-button-border"> <a href="https://kiit.me/verify.php?email=$email&hash=$hash" class="es-button" target="_blank">
                                                                                    
                                                                                      </a> </span> </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="position: absolute; left: -9999px; top: -9999px; margin: 0px;"></div>
</body>

</html>
EOF;
     if($mail->send())
      {
          
           redirect("http://chimera.org.in/login");
           exit;
      }
      else
      {
           
           redirect("http://chimera.org.in/login");
      }
 }
 else 
 {   
    
     redirect("http://chimera.org.in/login");
 }
ob_end_flush();
?>