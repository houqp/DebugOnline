<?php
	$code = $_POST["code"];
	$title = $_POST["title"];
	$compile = $_POST["compile"];
	$run = $_POST["run"];
	$debug = $_POST["debug"];
	$debugs = $_POST["debugs"];
	$next = $_POST["next"];
	
	$dir = "var/www/debugonline/";
	$filename = $dir.$title;
	$fp = fopen($filename,"w");
	fputs($code,$fp);
	
?>
