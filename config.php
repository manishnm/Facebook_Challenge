<?php
 if(!session_id() && !headers_sent()) 
    { 
        session_start(); 
    }

 require_once "Facebook/autoload.php";
  $fb= new \Facebook\Facebook([
			 
			'app_id' => '237783946875812',
			'app_secret' => '26f9b0ab47ac785a4f9cfa641cca07b8',
			'default_graph_version' => 'v3.1'
				]);
		
		$helper = $fb->getRedirectLoginHelper();
		
		if (isset($_GET['state']))
		{ 
		    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
		    
		}


?>
