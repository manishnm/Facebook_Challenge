<?php
 if(!session_id() && !headers_sent()) 
    { 
        session_start(); 
    }

 require_once "lib/Facebook/autoload.php";
  $fb= new \Facebook\Facebook([
			 
			'app_id' => '',// your app id
			'app_secret' => '', //your app secret
			'default_graph_version' => '' //  app version
				]);
		
		$helper = $fb->getRedirectLoginHelper();
		
		if (isset($_GET['state']))
		{ 
		    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
		    
		}


?>
