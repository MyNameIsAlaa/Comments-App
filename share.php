<?php
if(!session_id()){
    session_start();
}

require_once __DIR__ . '/facebook-php-sdk/autoload.php';


require("config.php");
require("comments.class.php");
try{
$dbcon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
}catch(PDOexception $e){
    echo "Connection failed: " . $e->getMessage();
}


use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuration and setup Facebook SDK
 */
$appId         = '540846596295908'; //Facebook App ID
$appSecret     = '11bd12d48c486aa2c6fb23ed3a2cbdde'; //Facebook App Secret
$redirectURL   = 'http://demo.test/share.php?id='.$_REQUEST['id']; //Callback URL
$fbPermissions = array('publish_actions'); //Facebook permission

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }else{
        $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) {
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}



if(isset($accessToken)){
    if(isset($_SESSION['facebook_access_token'])){
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{
        // Put short-lived access token in session
        $_SESSION['facebook_access_token'] = (string) $accessToken;
        
        // OAuth 2.0 client handler helps to manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();
        
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        
        // Set default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }
    
    $comment = new comments($dbcon);
    $post = $comment->GetOne($_REQUEST['id']);

    $attachment = array(
       'message' => $post->message
    );
    
    try{
        //Post to Facebook
        $fb->post('/me/feed', $attachment, $accessToken);
        
        //Display post submission status
        echo 'The post was submitted successfully to Facebook timeline.';
    }catch(FacebookResponseException $e){
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    }catch(FacebookSDKException $e){
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}else{
    //Get FB login URL
    $fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
    
    //Redirect to FB login
    header("Location:".$fbLoginURL);
}




?>