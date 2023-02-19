<?php

if(isset($_POST['token'])){
	$token= $_POST['token'];

	$postVariables= array(
		"secret"=>"6LfA8_caAAAAAFndy1OlLPASjB6AQHYqkQLi-BiC",
		"response"=>$token,
		"remoteip"=>$_SERVER['REMOTE_ADDR']
	);

	$ch= curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postVariables);
	
	$result= curl_exec($ch);
	curl_close($ch);

	echo $result;
}
else{
	exit('Please set recaptcha variable!');
}

?>