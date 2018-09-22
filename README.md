[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/badges/build.png?b=master)](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Code Coverage](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/manishnm/Facebook_Challenge/?branch=master)
# Facebook_Challenge
# Rtdownloader

(https://rtdownloader.000webhostapp.com)

rtdownloader is web application which lets you download facebook albums instantly.

  - Responsive
  - can backup to drive
  

### New Features!

  - fancy box for photos of albums
  - download albums in zip formats
  -direct view added on Albums


You can also:
  - backup your albums on google drive

### Code example
for facebook authentication
```

require_once "lib/Facebook/autoload.php";
  $fb= new \Facebook\Facebook([
			 
			'app_id' => '',
			'app_secret' => '',
			'default_graph_version' => ''
				]);
		
		$helper = $fb->getRedirectLoginHelper();
		
		if (isset($_GET['state']))
		{ 
		    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
		    
		}
```

for google authentication

```
$client = new Google_Client();
$client->setClientId('');
$client->setClientSecret('');
$client->setRedirectUri('');
$client->setScopes(array('https://www.googleapis.com/auth/drive'));
if (isset($_GET['code'])) {
    $_SESSION['accessToken1'] = $client->authenticate($_GET['code']);
    //header('location:'.$url);exit;
} elseif (!isset($_SESSION['accessToken1'])) {
    $client->authenticate();
}
 
```


### Tech

* [php7]
* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* [jQuery] - duh

And of course rtdownloader itself is open source with a [public repository][dill]
 on GitHub.

### Installation
install xammp,wamp or any apache server running application

### Todos
 get api id and api key from the facebook for developer site.
 
 login to facebook allow permissions to it 
 
download as per your choice
or 
back up to google drive using google sign in.
   
 ### Test users
name: Betty Albhagghdbgje Yangescu	
userid: 100028177842705	
email: tmyycxyccc_1535130468@tfbnw.net
### Licensing
This project is licensed under Unlicense license. This license does not require you to take the license with you to your project.


