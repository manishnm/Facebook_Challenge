<?php
 ob_start();
	@session_start();
			
			$tmp = $_SESSION['userData'];


$mainDirectory = "facebook_".$tmp['name']."_albums";
		$mainDirectory = str_replace(' ','',$mainDirectory);
		$path = $mainDirectory;

	
	
		if (!is_dir($mainDirectory)) {
			mkdir($mainDirectory,0777,true);
		}
	
			//for all albums
		
	     
			
				$counter=0;
				foreach($tmp['albums'] as $album)
				{
				    
					//$id = $tmp['albums'][$counter]['id'];
					$albumName = $tmp['albums'][$counter]['name'];
					$mainpath = $path;

						$albumName = str_replace(' ','',$albumName);
						$albumPath = $mainpath."/".$albumName;
						// checks the directory is available or not if not the create 
						if (!is_dir($albumPath)) {
							mkdir($albumPath,0777,true);
						}	
						// image download
						$imagePath = $albumPath."/";
						foreach($album['photos'] as $item)
						{
							file_put_contents($imagePath.$item['id'].'.jpg', file_get_contents($item['images'][0]['source']));
						
						}
				        $counter++;
					}
				
				
       //$folderName = $path;
	   
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
	   
	   
	   //deleting created directory
	
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
	
	createZipFile($path); //func calls
	deleteDir($path);		//func calls
	$zipname="files/".$path.".zip";
	?>
	
	<br/>
	<h5><a href="albums.php"> Go back to your Albums</a></h5>
	<?php
	  //backup code starts from here
	  
	  
require_once 'lib/src/Google_Client.php';
require_once 'lib/src/contrib/Google_DriveService.php';
$client = new Google_Client();
$client->setClientId(''); 		//client id
$client->setClientSecret('');   //client secret

$client->setRedirectUri('https://rtdownloader.000webhostapp.com/backup.php');
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
if (isset($_GET['code'])) {
    $_SESSION['accessToken1'] = $client->authenticate($_GET['code']);
    //header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken1'])) {
    $client->authenticate();
}
 
 
 
 $files= array();
$dir = dir('files');
while ($file = $dir->read()) {
    if ($file != '.' && $file != '..') {
        $files[] = $file;
    }
}
$dir->close();
if (!empty($_POST)) {
    $client->setAccessToken($_SESSION['accessToken1']);
    $service = new Google_DriveService($client);
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file = new Google_DriveFile();
    foreach ($files as $file_name) {
        $file_path = 'files/'.$file_name;
        $mime_type = finfo_file($finfo, $file_path);
        $file->setTitle($file_name);
        $file->setDescription('This is a '.$mime_type.' document');
        $file->setMimeType($mime_type);
        $service->files->insert(
            $file,
            array(
                'data' => file_get_contents($file_path),
                'mimeType' => $mime_type
            )
        );
    }
    finfo_close($finfo);
	
	
	//bacup code end
	
    unlink($zipname);
    header('location:uploadsuccess.php');exit;


	
	?>
			 
