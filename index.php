
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Rtdownloader</title>
		
		<link rel="shortcut icon" href="images/favicon.png" />
		
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- fancybox css File -->
		<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css" media="screen" />
		<!-- Main css File -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Mobile Responsive CSS -->
		<link rel="stylesheet" type="text/css" href="css/responsive.css">
	
		
	</head>
	<body>
	
	<!-- Header Logo & Menu Strat -->	
	
	<section id="header" class="header-color">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="logo text-center">
						<h2><a href="index.php">Rtdownloader</a></h2>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Header Logo & Menu End -->	

	<section id="galley-listWrap" class="home-back">
		<div class="section-padding">
			<div class="container">
			    
				<div class="row"  style="background:transparent url('img/profile.png') no-repeat center center /cover">
				    
				  
				    
				    <div class="col-lg-12">
					<?php



   require_once "config.php" ;
   
   $redirecturl = "https://rtdownloader.000webhostapp.com/fbcallback.php";
   $permissions = ['user_photos'];
   $loginurl = $helper->getLoginUrl($redirecturl, $permissions);
   

?>
    
    <div class="container-fluid">
        <div  class="bg">
             <div class="col-md-6 col-md-offset-3">	
             
        <center>
            
            
            <h2><b><u>Welcome to RTdownloader</u></b></h2>
            <br/>
            <p><i>Downloading your Facebook Albums Made Simple...</i></p>
           <form>
		   
		   <br/>
		   <br/>
		   <input type ="button" class="btn btn-primary btn-md" value="Login with Facebook" onclick="window.location = '<?php echo $loginurl ?>';" class="form-control">
		   
		   </form>
            </div>
            </div>
			
				</div>
			</div>
			</div>
		</div>
	</section>
	


	<!-- Footer Section Strat -->	

	<section id="footer" class="footer-color">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="copyright">
						<p>2018 &copy; Manish Mangyani.(7405301432)</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer section end -->

	
		<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
		<!-- Bootstrap JS -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="source/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="source/jquery.mousewheel.pack.js"></script>
		<!-- Custom Script -->
		<script type="text/javascript" src="js/scripts.js"></script>
		
	</body>
</html>