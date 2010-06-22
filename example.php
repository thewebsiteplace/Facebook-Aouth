<?php 
	include 'facebook.class.php';
	$to = new facebook();
	$to->client_id = '';
	$to->client_secret = '';
	$to->redirect_uri = '';

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

