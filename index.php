<?php
// ALL ERRORS IN PRODUCTION WHEE! \o/
ini_set('display_errors', 1);
error_reporting(E_ALL);

// FIXME: should probably come up with a config file or something?
$_title = 'Untitled Page'; // in case a page doesn't set the title
$_pagePath = array( // links for e.g. home / studio / serial
	array(
		'text' => 'Idol @ 忍',
		'uri'  => '' // home doesn't get a URI since it's just /
	)
);

require('./functions.php');
require('./session.php'); // needs functions
require('./uri.php'); // parse the URI into something useful, figure out what page applies
require('./nav.php'); // needs session

require('./db.pgsql.php');
$db = new db();

// tell the browser about ourselves (can be overridden in $_page file)
header("Content-Type: text/html; charset=utf-8");
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

// get the page contents
ob_start();
require($_pageHandler);
$_body = ob_get_clean();

// gz ftw
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
        ob_start('ob_gzhandler');
        header("Content-Encoding: gzip");
} else ob_start();

if(!isset($_noHtml)) {
	chdir("./themes/standard");
	require('./theme.php');
} else echo $_body;

ob_end_flush(); // barf some output
?>