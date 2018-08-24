<?php
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
