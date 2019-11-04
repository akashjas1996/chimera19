<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Contact Us| Kritarth 5.0</title>
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
		<link href="../fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="../style/style.css">

    <link rel="shortcut icon" href="../images/favicon.png">
		<style>
        .parallax {
  /* The image used */
  /*background-image: url("../images/black.jpg");*/

  /* Set a specific height */
  min-height: 500px; 

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
        </style>
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>

	<body>
		
		<div id="site-content">
			<?php include '../inc/header.php' ?>
			
			<main class="main-content">
				<div class="fullwidth-block inner-content">
					<div class="container">
					
						<div class="row parallax">
                            <div class="col-md-6 ">
                            	<h2 class="page-title">Contact Us</h2>  
                                <hr>
                            	<h2><!-- <i class="fa fa-2x fa-phone"></i>&nbsp;&nbsp; -->
                              

                              <!--  <span>8787585831,8249242194</span>  -->
                               <div class="row">
                               	<div  class="col-lg-6">
                               		<h3 style="line-height: 0">Pradipta Som</h3>
                               		<a href="https://api.whatsapp.com/send?phone=918787585831&text=Hello, Got your number from kritarth Webpage wanted your help in ....." > <img style="width: 35px; margin-top: 2px " src="whatsapp.png"> </a>
                               			&nbsp;
                               		<a style="line-height: 0; color: grey; text-decoration: none" href="tel:+918787585831">
                               			<i class="fa fa-phone"></i> +91 - 8787585831

                               		</a>

                               	</div>


                               </div>
                               <br>
                               <div class="row">
                               	<div  class="col-lg-6">
                               		<h3 style="line-height: 0">Navneet Pandey</h3>
                               		<a style="line-height: 0; color: grey; text-decoration: none" href="tel:+918249242194">

                               			<a href="https://api.whatsapp.com/send?phone=917064687832&text=Hello, Got your number from kritarth Webpage, wanted your help in....." > <img style="width: 35px; margin-top:2px; " src="whatsapp.png"> </a>
                               			&nbsp;
                               			<i class="fa fa-phone"></i> +91 - 8249242194
                               			<br>
                               			 
                               		</a>
                               	</div>
                               </div>


                                </h2>
                                <br>
                                <h2><i class="fa fa-2x fa-envelope"></i>&nbsp;&nbsp;<span>info.kritarth@gmail.com</span></h2><br>
                                <h2><i class="fa fa-2x fa-map-marker"></i>&nbsp;&nbsp;&nbsp;<span>KIIT Student Activity Centre</span>
                                &nbsp;&nbsp;&nbsp;<p>Campus 13, Bhubaneshwar, Odisha, India</p>
                                </h2>
							</div>
                            <br><br>
							<div class="col-md-6"
                                 style="padding-bottom:56.25%; position:relative; display:block;">
                                 <iframe id="ViostreamIframe"
  width="100%" height="70%"
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3740.6368424592497!2d85.81673931492145!3d20.356615886366313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a19093cc3e1974b%3A0x85a345e1f4fcce86!2sKIIT%20Student%20Activity%20Center-KSAC!5e0!3m2!1sen!2sin!4v1568831067736!5m2!1sen!2sin"
  frameborder="0" allowfullscreen=""
  style="position:absolute; top:0; left: 0"></iframe>
								
							</div>
							
						</div>
					</div>
				</div> <!-- .testimonial-section -->

				
			</main> <!-- .main-content -->

			<?php include '../inc/footer.php' ?>
		</div> <!-- #site-content -->

		<script src="../js/jquery-1.11.1.min.js"></script>	
		<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>	
		<script src="../js/plugins.js"></script>
		<script src="../js/app.js"></script>
		
	</body>

</html>
