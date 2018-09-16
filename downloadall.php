<?php
	session_start();
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




         $tmp =$_SESSION['userData'];
        
 
$mainDirectory = "facebook_".$tmp['name']."_albums";
		$mainDirectory = str_replace(' ','',$mainDirectory);
		$path = $mainDirectory;

	
	
		if (!is_dir($mainDirectory)) {
			mkdir($mainDirectory,0777,true);
		}
	
                			//for all albums
                		  foreach($allAlbums as $ab)
                {
                   $NameNLinks = explode('||', $ab);
                   
                
                   	$albumName = $NameNLinks[0];
				
					$mainpath = $path;
					
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
	     
		
			
		
	   
	//for creating and downloading zip file
	function createZipFile($folderName)
	{
		//$folderName= "zipFolderDemo";
		$filepath =  $_SERVER['DOCUMENT_ROOT']."/".$folderName;
		$rootPath = realpath($filepath);

		// Initialize archive object
		$zip = new ZipArchive();
		$zipfilename = $folderName.'.zip';
		$zip->open("files/".$zipfilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

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
	<br/>
	<h5><a href="albums.php"> Go back to your Albums</a></h5>
