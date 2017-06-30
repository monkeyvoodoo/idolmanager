<?php
// look for a valid action in the URI. e.g. /tag/add  or /tag/edit
switch(@$_uri[3]) {
	case 'add': $tagAction = 'add'; break;
	default: $tagAction = null;
}
$tagHandler = '404'; // we want to 404 if something ain't right
if(
	loggedIn() &&
	!is_null($tagAction) &&
	isset($_uri[3]) &&
	strlen($_uri[3]) > 0
) {
	// make sure we got both a studio and a serial, otherwise just 404
	$studio = $_uri[1];
	$serial = $_uri[2];

	$tagHandler = "tag/{$tagAction}";
}

array_push($_pagePath, array('text' => $studio, 'uri' => "studio/{$studio}"));
array_push($_pagePath, array('text' => $serial, 'uri' => "{$serial}"));
array_push($_pagePath, array('text' => 'Tag',   'uri' => ''));

require("./content/{$tagHandler}.php");
?>