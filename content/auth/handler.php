<?php
$authAction = isset($_uri[1]) ? $_uri[1] : 'none';
switch($_uri[1]) {
	case 'login': $actionHandler = 'auth/login'; break;
	case 'logout': $actionHandler = 'auth/logout'; break;
	default: $actionHandler = '404';
}
$actionHandler = "./content/{$actionHandler}.php";
if(!file_exists($actionHandler)) $actionHandler = $_fourOhFourHandler;

require($actionHandler);
?>