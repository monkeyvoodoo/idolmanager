<?php
$_noHtml = true;
header("Content-Type: application/json");

switch(@$_uri[1]) {
	case 'rate': $apiHandler = 'api/rate'; break;
	default: $apiHandler = '404'; // 404 on bad requests
}

require("./content/{$apiHandler}.php");
?>