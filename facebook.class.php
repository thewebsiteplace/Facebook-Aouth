<?php
// Writen By Simon Bennett
class facebook {
	var $client_id = '';
	var $redirect_uri  = '';
		//var $auoth_token;
	var $client_secret = '';
	//Curl uses it Might as well :)
	var $user_agent='You App Name'; 
	
	function authorizeurl($scope){
		$url = 'https://graph.facebook.com/oauth/authorize';
		$args = '?client_id=' . $this->client_id . '&redirect_uri=' . $this->redirect_uri . '&scope=' . $scope;
		return $url . $args;
	}
	function access_token($code){
		$url = 'https://graph.facebook.com/oauth/access_token' . '?client_id=' . $this->client_id . '&redirect_uri=' . $this->redirect_uri .  '&client_secret=' . $this->client_secret . '&code=' . $code;
		return str_replace('access_token=','',$this->process($url));
	}
	function me($aouth_token){
		$url = 'https://graph.facebook.com/me' . '?access_token=' . $aouth_token;
		return json_decode($this->process($url));
	}
	function statusupdate($aouth_token,$message){
		$url = 'https://graph.facebook.com/me/feed' . '?access_token=' . $aouth_token  ;
		$args =  '&message=' . $message;
		return $this->process($url,$args);
	}
	
	function process($url,$postargs=false){ 
         
        $ch = curl_init($url); 

        if($postargs !== false){ 
            curl_setopt ($ch, CURLOPT_POST, true); 
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $postargs); 
        } 
         
        
        curl_setopt($ch, CURLOPT_VERBOSE, 1); 
        curl_setopt($ch, CURLOPT_NOBODY, 0); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
      

        $response = curl_exec($ch); 
         
        $this->responseInfo=curl_getinfo($ch); 
        curl_close($ch); 
         
      
         return $response;     
       
    } 
}
?>