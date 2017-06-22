<?php
// ALL ERRORS IN PRODUCTION WHEE! \o/
ini_set('display_errors', 1);
error_reporting(E_ALL);

require('./functions.php');
require('./uri.php'); // parse the URI into something useful, figure out what page applies

require('./database.php');
$db = new db();

// tell the browser about ourselves (can be overridden in $_page file)
header("Content-Type: text/html; charset=utf-8");
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

// get the page contents
$_title = 'Untitled Page';
ob_start();
require("./content/{$_page}.php");
$_body = ob_get_clean();

// gz ftw
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
        ob_start('ob_gzhandler');
        header("Content-Encoding: gzip");
} else ob_start();

require('./themes/standard/head.php');
require('./themes/standard/body.php');
require('./themes/standard/foot.php');

ob_end_flush(); // barf some html
?>