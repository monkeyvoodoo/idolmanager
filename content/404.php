<?php
$_title = 'nope';
header("HTTP/1.0 404 Not Found");

$i = array();
$d = dir('./themes/standard/images/404');
while(false !== ($e = $d->read())) {
	if($e[0] != '.') array_push($i, $e);
}

$imageFile = $i[(mt_rand(0, count($i) - 1))];
?>
<div style="display:table;width:100%;height:100%">
	<div style="display:table-cell;height:100%;vertical-align:middle;text-align:center">
		<div class="fourohfour-image" style="background-image:url('/themes/standard/images/404/<?php echo $imageFile; ?>')">
		<div class="fourohfour-row top"><div class="top"><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></div></div>
		<div class="fourohfour-row"></div>
		<div class="fourohfour-row bottom"><div class="bottom">Really?!</div></div>
		</div>
	</div>
</div>