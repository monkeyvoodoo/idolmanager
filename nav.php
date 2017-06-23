<?php
$_nav = array(
	'home' => array(
		'text'   => 'home',
		'uri'    => '/'
	),
	'auth' => array(
		'text'   => 'log in',
		'uri'    => '/auth/'
	)
);
if(isset($_SESSION['profile']) && count($_SESSION['profile']) > 0) {
	$_nav['auth']['text'] = 'log out';
	$_nav['auth']['uri'] .= 'logout';
} else {
	$_nav['auth']['text'] = 'log in';
	$_nav['auth']['uri'] .= 'login';
}
?>