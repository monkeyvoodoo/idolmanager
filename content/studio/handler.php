<?php
$studioHandler = '404'; // we want to 404 if something ain't right
if(isset($_uri[2]) && strlen($_uri[2]) > 0) {
	// we got a request for an individual file, so we want to grab info about it,
	// rather than listing all items under a given studio
	$studioHandler = 'studio/serial';
	$studio = $_uri[1];
	$serial = $_uri[2];
} else {
	// this is a request for a listing of all items under a given studio
	$studioHandler = 'studio/studio';
	$studio = $_uri[1];
}

array_push($_pagePath, array('text' => $studio, 'uri' => "studio/{$studio}"));

require("./content/{$studioHandler}.php");
?>