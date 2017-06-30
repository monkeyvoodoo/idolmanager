<?php
if(isset($_uri[3]) && strlen($_uri[3]) > 0) {
	// we got a request for an individual file, so we want to grab info about it,
	// rather than listing all items under a given studio
	$studioHandler = 'studio/serial';
	$studio = $_uri[2];
	$serial = $_uri[3];
	$userId = $_SESSION['profile']['id'];
	$rating = $_GET['r'];

	$r = $db->query("SELECT id FROM video WHERE serial = :serial and studio_id = ( SELECT id FROM studio WHERE code = :code )", array(':code' => $studio, ':serial' => $serial));
	$videoId = $r[0]['id'];

	$sql = "INSERT INTO rating ( user_id, video_id, rating ) VALUES ( :user_id, :video_id, :rating ) ON CONFLICT ( user_id, video_id ) DO UPDATE SET rating = :rating";

	if(false !== $db->query($sql, array(':user_id' => $userId, ':video_id' => $videoId, ':rating' => $rating))) $status = 'OK';
	else $status = 'ERROR';

	echo json_encode((object) array('status' => $status));
}
?>