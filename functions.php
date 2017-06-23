<?php
function message($message, $die = false, $return = false) {
	if(is_array($message)) $message = '<pre style="text-align:left">'.print_r($message,true).'</pre>';
	elseif(is_null($message)) $message = '<pre style="font-style:italic">NULL</pre>';
	elseif(is_bool($message)) $message = '<pre style="text-align:left">Boolean: '.($message == true ? 'true' : 'false').'</pre>';
	else $message = "<pre>{$message}</pre>";

	if($return) return($message);
	else {
		ob_clean();
		echo $message;
		if($die) exit;
	}
}

function redirect(string $uri, string $httpMessage = null) {
	if(is_null($httpMessage)) $httpMessage = 'HTTP/1.1 302 Found';
	header($httpMessage);
	header("Location: {$uri}");
	exit;
}
?>