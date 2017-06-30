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

function loggedIn(): bool {
	if(isset($_SESSION['profile']) && count($_SESSION['profile']) > 0) return(true);
	else return(false);
}

function tagNest(array &$tagList, int $parentId = 0, int $level = 0) {
	$output = array();

	foreach($tagList as $k => $t) {
		if($t['parent_id'] == $parentId) {
			$output[$t['tag']] = array(
				'id'       => $t['id'],
				'parent'   => $t['parent_id'],
				'children' => tagNest($tagList, $t['id'], $level + 1)
			);
		}
	}

	return $output;
}

function printTags($tags) {
	foreach($tags as $p => $t) { // p = parent, c = children
		$class = $t['parent'] == 0 ? ' class="tag-parent"' : '';
		echo "<div{$class}>".htmlspecialchars($p);
		if(count($t['children']) > 0) printTags($t['children']);
		echo '</div>';
	}
}
?>