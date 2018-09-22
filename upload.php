<?php
session_start();
$filename = $_GET['filename'];
$url = "https://abhishekrt.xyz/upload.php";
require_once 'src/Google_Client.php';

require_once 'src/contrib/Google_DriveService.php';

$client = new Google_Client();
$client->setClientId('319634055646-tn6825rj1v8dk8a97ut6bllnnvechu8o.apps.googleusercontent.com');
$client->setClientSecret('N_gZcVph2JD7iCcyDLKm_L-5');
$client->setRedirectUri($url);
$client->setScopes(array(
	'https://www.googleapis.com/auth/drive'
));

if (isset($_GET['code']))
	{
	$_SESSION['accessToken'] = $client->authenticate($_GET['code']);
	header('location:' . $url);
	exit;
	}
elseif (!isset($_SESSION['accessToken']))
	{
	$client->authenticate();
	}

$files = array();
$dir = dir('files');

while ($file = $dir->read())
	{
	if ($file != '.' && $file != '..')
		{
		$files[] = $file;
		}
	}

$dir->close();
$client->setAccessToken($_SESSION['accessToken']);
$service = new Google_DriveService($client);
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$file = new Google_DriveFile();

foreach($files as $file_name)
	{
	$file_path = 'files/' . $file_name;
	$mime_type = finfo_file($finfo, $file_path);
	$file->setTitle($file_name);
	$file->setDescription('This is a ' . $mime_type . ' document');
	$file->setMimeType($mime_type);
	$service->files->insert($file, array(
		'data' => file_get_contents($file_path) ,
		'mimeType' => $mime_type
	));
	}

finfo_close($finfo);
unlink($filename);
echo "<script>window.location.href='uploadsuccess.php'</script>";
?>
