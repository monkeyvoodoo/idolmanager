<?php
$_uri = $_SERVER['REQUEST_URI'];
if(false !== ($p = strpos($_uri, '?'))) $_uri = substr($_uri, 0, $p);
$_uri = trim($_uri, '/');

if(false !== ($pos = strpos($_uri, '?'))) $_uri = substr($_uri, 0, $pos);
$_uri = $_uri == '' ? array('home') : explode("/", $_uri);

switch(strtolower($_uri[0])) {
	case 'api': $_page = 'api/handler'; break;
	case 'auth': $_page = 'auth/handler'; break;
	case 'home': $_page = 'home'; break;
	case 'studio': $_page = 'studio/handler'; break;
	case 'tag': $_page = 'tag/handler'; break;
	default: $_page = '404';
}
$_pageHandler = "./content/{$_page}.php";

$_fourOhFourHandler = './content/404.php';
if(!file_exists($_pageHandler)) $_pageHandler = $_fourOhFourHandler;
?>