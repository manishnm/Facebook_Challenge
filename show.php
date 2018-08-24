
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Gallery-Rtdownloader</title>
		
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
						<h2><a href="index.html">Rtdownloader</a></h2>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Header Logo & Menu End -->	



    
    
	
	<section id="galley-listWrap">
		<div class="section-padding">
			<div class="container">
				<div class="row">
				
				
				
				<?php
 @session_start();
  // maximum execution time in seconds
    // set_time_limit (24 * 60 * 60);

$aid = $_GET['aid'];
$albums=array();
            
$tmp = $_SESSION['userData'];

			

             $total = count( $tmp ['albums'] );
			 for($i=0;$i<$total;$i++)
			 { 
              if($tmp['albums'][$i]['id']== $aid)
			  {
						  $count=$tmp['albums'][$i]['count'];
					 
							echo"<h4><u>".$tmp['albums'][$i]['name']."<u></h4></br>";
					
						 foreach(  $tmp['albums'][$i]['photos'] as $item )                    //loop for showing photos of albums
							  {   
						?>      
							<div class="col-md-3 col-sm-3 col-xs-12">
								<div class="image-box">
									<a rel="example_group"  href="<?php echo $item['images'][0]['source'];	 ?>"> <img src="<?php echo $item['images'][0]['source'];	 ?>" width='500' height='500' class="img img-responsive"></a>
								</div>
							</div>
							
							 <?php				
							
			  
			  
 			  }
			  
			 }}
			 
       

?>

					
					
					
					
					
					
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
						<p>2018  Made by Manish Mangyani &copy; . (7405301432)</p>
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