<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Idol @ 忍<?php echo strlen($_title) > 0 ? ' — '.htmlspecialchars($_title) : ''; ?></title>
		<link rel="stylesheet" href="/themes/standard/style.css" type="text/css" media="all" />
	</head>

	<body>

		<header>
			<nav>
				<ul>
<?php
foreach($_nav as $n) {
?>
					<li><a href="<?php echo $n['uri']; ?>"><?php echo htmlspecialchars($n['text']); ?></a></li>
<?php
}
?>
				</ul>
			</nav>

<?php
if(count($_pagePath) > 1) {
?>
			<article id="page-path">
<?php
	$_pathIndex = 0;
	$_pathUri = array();
	foreach($_pagePath as $_pageItem) {
		array_push($_pathUri, $_pageItem['uri']);
		if($_pathIndex > 0) {
?>
				<span class="path-separator">/</span>
<?php
		}
		if($_pathIndex == count($_pagePath) - 1) {
?>
				<span class="path-item"><?php echo htmlspecialchars($_pageItem['text']); ?></span>
<?php
		} else {
			$_pathHref = implode('/', $_pathUri);
			if(strlen($_pathHref) == 0) $_pathHref = '/';
?>
				<span class="path-item"><a href="<?php echo $_pathHref; ?>" title="Go to <?php echo htmlspecialchars($_pageItem['text']); ?>"><?php echo htmlspecialchars($_pageItem['text']); ?></a></span>
<?php
		}
		$_pathIndex++;
	}
?>
			</article>
<?php
}
?>
		</header>
