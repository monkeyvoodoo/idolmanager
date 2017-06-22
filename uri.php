<?php
$uri = ltrim($_SERVER['REQUEST_URI'], '/');

if(false !== ($pos = strpos($uri, '?'))) $uri = substr($uri, 0, $pos);
$uri = $uri == '' ? array('home') : explode("/", $uri);

switch(strtolower($uri[0])) {
	case 'home': $_page = 'home'; break;
	case 'studio': $_page = 'studio'; break;
	default: $_page = '404';
}
?>