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
	
	<section id="galley-listWrap">
		<div class="section-padding">
			<div class="container">
				<div class="row">
				<div class="col-md-2 absolute"> 
				
					<input type="button" class="btn btn-info"  onclick="window.location = 'downloadall.php'"  value="Download All Albums">
						<br/>
						<br/>
					<input type="button" class="btn btn-info"  onclick="window.location = 'backupall.php'"  value="Backup All Albums">
      
			</div>
	<div class="col-md-8 text-left"> 
	  <?php
			@session_start();
			$token= $_SESSION['access_token'];
			$url= "https://graph.facebook.com/v3.1/me?fields=albums%7Bid%2Cname%2Cphotos%7Bimages%7D%7D&access_token=".$token;
			
	
			
        	
function getData($url)
{
	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=json_decode(curl_exec($ch),true);
	// Closing
	curl_close($ch);      
	return $result;
}
   
$link=array();	
$links='';        	
function getNextParser($url)
{
	$innerData = getData($url);
	foreach($innerData['data'] as $image)
	     {
		 $GLOBALS['links'].=$image['images'][0]['source']." ";
	     }
	if(isset($innerData['paging']['next'])){
		getNextParser($innerData['paging']['next']);
	}
}
// Main calling 
$result = getData($url);     		
foreach($result['albums']['data'] as $album)
{
	$GLOBALS['links'].=$album['name']."||";
	foreach($album['photos']['data'] as $image)
	{
		 $GLOBALS['links'].= ($image['images'][0]['source'])." ";
	}
	if(isset($album['photos']['paging']['next']))
	{
		getNextParser($album['photos']['paging']['next']);
	}	
	$GLOBALS['links'].=" , ";
}	
$allAlbums = explode(',', $links);
array_pop($allAlbums);




       
		
			
				$tmp = $_SESSION['userData'];
			echo "<h3><u> " . $tmp['name'] ."</u></h3>";
             $total = count( $tmp['albums'] );
			 ?>
			 
			 
			 <div id="root" class="row" > 
			 
			   </div>
		
			 
			 
			 
			 
			 <form action=# method="post">
			 
			 
			 <?php
			 $i=0;
			   foreach($allAlbums as $ab)
                {
                   $NameNLinks = explode('||', $ab);
                  
                   	$albumName = $NameNLinks[0];
                   	$urls = explode(' ', $NameNLinks[1]);
                   	$id = $albumName;
                   		$am =str_replace(" ","_",$albumName);
                   		 $str = implode(",", $urls);
                   		 
					
				?>
				  <div class="col-md-4 col-sm-4 col-xs-12">
						<div class="img1">
				       <?php   echo "<b>" . $NameNLinks[0]."</b>";?>
				    <input type="checkbox" name="images[]" value="<?php echo $id;?>">    
				
			<a href="#<?php echo $am; ?>" onclick="show('<?php echo $str; ?>','<?php echo $am; ?>','<?php echo $tmp['albums'][$i]['count']; ?>');" class="fancybox">
				 <img src="<?php echo $tmp['albums'][$i]['picture']['url']; ?>" class="img img-responsive">
				</a>
				
				<?php
			
				 echo "Total Photos:".$tmp['albums'][$i]['count'];
				 echo "</div></div>";
				 $i++;
 
			 }
			 ?>
			 
			 <br/>
			 <br/>
			 <div class="row"><div class="col-md-12 text-center"> 
	           <input type="submit" value="Download Selected Albums" class="btn btn-primary"/>
	           <br/>
	           
	           <input type="button" class="btn btn-primary"  onclick="window.location = 'backup.php'"  value="Backup Albums">

	          
			 </div>	 
			 
	 
			 			 	 </div>	
		
			 			 	
     <?php            
               $mainDirectory = "facebook_".$tmp['name']."_albums";
		$mainDirectory = str_replace(' ','',$mainDirectory);
		$path = $mainDirectory;

	
	
		if (!is_dir($mainDirectory)) {
			mkdir($mainDirectory,0777,true);
		}
		if(isset($_REQUEST['images']))
		{
			//for individual selected albums
			foreach($_POST['images'] as $sel)
			{
			//	$counter=0;
				
					  foreach($allAlbums as $ab)
                {
                   $NameNLinks = explode('||', $ab);
                   
                
                   	$albumName = $NameNLinks[0];
					$id =  $NameNLinks[0];
					$albumName = $id;
				
				
					$mainpath = $path;
						if($id == $sel)
					{
					
						$albumName = str_replace(' ','',$albumName);
						$albumPath = $mainpath."/".$albumName;
						// checks the directory is available or not if not the create 
						if (!is_dir($albumPath)) {
							mkdir($albumPath,0777,true);
						}	
						// image download
						$imagePath = $albumPath."/";
                   
                   $urls = explode(' ', $NameNLinks[1]);
                  
                   	$count=1;
						   foreach($urls as $url)
						if(!empty($url))
						{
						    
						
					
						//    echo "".$url;
						    
						file_put_contents($imagePath.$count.'.jpg', file_get_contents($url));
						
						$count++;
						}
					}
                	
                }
			}
          
          			
       $folderName = $path;
	   
	//for creating and downloading zip file
	function createZipFile($folderName)
	{
		//$folderName= "zipFolderDemo";
		$filepath =  $_SERVER['DOCUMENT_ROOT']."/".$folderName;
		$rootPath = realpath($filepath);

		// Initialize archive object
		$zip = new ZipArchive();
		$zipfilename = $folderName.'.zip';
		$zip->open('files/'.$zipfilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($rootPath),
			RecursiveIteratorIterator::LEAVES_ONLY
		);
	
		foreach ($files as $name => $file)
		{
			// Skip directories (they would be added automatically)
			if (!$file->isDir())
			{
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen($rootPath) + 1);

				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();
		//return $zipfilename;
		
	}
	
	
	function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
	
	createZipFile($path);
	deleteDir($path);
	
	$zipfilename = $path.'.zip';
	
	
	?>
	<br/>
	<p> Click <a href="<?php echo "files/".$zipfilename ?>">here </a> to download zip file.</p>
    <?php	
		
			}
			?>
			 
	 
			 </form>
			 
					
					
					
				</div>
				<div class="col-md-2 sidenav">
                    	<input type="button" class="btn btn-default"  onclick="window.location = 'logout.php'"  value="Log Out">
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
		<script type="text/javascript">
			$(document).ready(function() {			
				$('.fancybox').fancybox();
			});
		
			
	function show(albumimg,albumname,total){
		     albumimg = albumimg.split(",");
		     
		var totalimg = total;   
                var a = albumname;
                
                
             var root = document.getElementById('root');
               
             if(root.hasChildNodes())
             {
              root.removeChild(root.childNodes[0]);
            
             }
              
    		
      
		  var div0 = document.createElement('div');
                div0.className = 'row'; 
                div0.setAttribute('id',albumname);
                div0.setAttribute('style', 'width:1000px;display: none; padding:0px 20px;');
                root.appendChild(div0);
		             
            for(i=0;i<total;i++)
            {
            	
                
                 var div1 = document.createElement('div');
                div1.className = 'col-md-3 col-sm-3 col-xs-12'; 
                
                div0.appendChild(div1);
                
                var div2 = document.createElement('div');
                div2.className = 'image-box';
                div1.appendChild(div2);
                
                var link = document.createElement('a');
                link.href=albumimg[i];
                link.rel='example_group';
                div2.appendChild(link);
                
                var img = document.createElement('img');
                img.setAttribute('height', '200px');
                img.setAttribute('width', '200px');
                img.class ='img img-responsive';
                img.src = albumimg[i];
                 
               
                link.appendChild(img);
            
            }
		
			}
			
			
		</script>	
		
	</body>
</html>
