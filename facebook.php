<?php
   // database  
	include "includes/database.php";
// Include FB config file && User class
	require_once 'fbConfig.php';

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
	
	// Redirect the user back to the same page if url has "code" parameter in query string
	if(isset($_GET['code'])){
		 header('Location: ./');
	}
	
	// Getting user facebook profile info
	try {
		$profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();
	} catch(FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// Redirect user back to app login page
		header("Location: ./");
		exit;
	} catch(FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	$checkUser = $mysqli->query("SELECT * FROM `users` WHERE auth_id='".$fbUserProfile['id']."' AND login_method='facebook'");
	$existUser = $checkUser->num_rows;
	
	if($existUser > 0){
		
	 $mysqli->query("UPDATE `users` SET `name`='".$fbUserProfile['first_name'].$fbUserProfile['last_name']."',`gender`='".$fbUserProfile['gender']."',`mail`='".$fbUserProfile['email']."',avatar`='".$fbUserProfile['picture']['url']."',`updated_on`=NOW() WHERE auth_id='".$fbUserProfile['id']."'");
	
	$query = $mysqli->query("SELECT * FROM `users` WHERE auth_id='".$fbUserProfile['id']."' AND login_method='facebook'");

	if($query->num_rows > 0){
		$user_data = $query->fetch_assoc();
		$_SESSION['user'] = $user_data;
	}
		
	}else{
		
	 $query = "INSERT INTO `users`(`name`, `gender`, `mail`, `avatar`, `auth_id`, `login_method`) VALUES ('".$fbUserProfile['first_name'].$fbUserProfile['last_name']."','".$fbUserProfile['gender']."','".$fbUserProfile['email']."','".$fbUserProfile['picture']['url']."','".$fbUserProfile['id']."','facebook')";
		
	if($mysqli->query($query)){
		
		$user_id = $mysqli->insert_id;
		$query = $mysqli->query("SELECT * FROM `users` WHERE id=".$user_id." AND login_method='facebook'");

		if($query->num_rows > 0){
			$user_data = $query->fetch_assoc();
			$_SESSION['user'] = $user_data;
		}	
		
	}	
	
	}
	
	 // $logoutURL = $helper->getLogoutUrl($accessToken, $redirectURL.'logout.php'); // for future purpose
	
}
	header("Location: ./");
?>