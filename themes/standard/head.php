<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo htmlspecialchars($_title); ?></title>
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
		</header>
