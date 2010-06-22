<?php 
	include 'facebook.class.php';
	$to = new facebook();
	$to->client_id = '158591243904';
	$to->client_secret = '1ee6d393d047061ba0cea90e404f2817';
	$to->redirect_uri = 'http://beta.allwebchat.com/simonsfuckabout/classes/example.php';

	if(empty($_REQUEST['code'])){ 
	
		echo '<a href="' . $to->authorizeurl('offline_access,read_stream,publish_stream') . '"> Authorize </a>';
	
	} else { 
		$oauth_token = $to->access_token($_REQUEST['code']);
		$me = $to->me($oauth_token); // That token can we saved in the database
		echo '<img src="http://graph.facebook.com/' . $me->id . '/picture?type=large" />';
		echo $me->name;
		// $to->statusupdate($oauth_token','Just Testing The Web Site Place's Code :)');
	
	}
?>

