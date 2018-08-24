<?php
	require_once "config.php";

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\lib\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\lib\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	if (!$accessToken) {
		header('Location: index.php');
		exit();
	}

	$oAuth2Client = $fb->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

	$response = $fb->get("me?fields=name,albums{id,name,picture,count,photos{images}}", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	 
	//$jsonData = file_get_contents($userData);
	//echo "<pre>";
	
	//foreach($userData as $a)
	{
		//var_dump(count($userData));
	}
	
	$_SESSION['userData'] = $userData;
//	echo "<a href='https://rtdownloader.000webhostapp.com/albums.php'>goto albums</a>";
	//var_dump($userData);
	//$_SESSION['access_token'] = (string) $accessToken;
	header('Location:https://rtdownloader.000webhostapp.com/albums.php');
	//exit();
?>