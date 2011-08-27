<?php
	$code = $_POST["code"];
	$title = $_POST["title"];
	$debug = $_POST["debug"];
	$debugs = $_POST["debugs"];
	$next = $_POST["next"];
	$action = $_POST["action"];
	
	$dir = "var/www/debugonline/temp/";
	$filename = $dir.$title;
	$fp = fopen($filename,"w");
	fputs($fp,$code);
	fclose($fp);
	
	if(action == "run")
	{	
		//留待完善
		$command = ;
		shell_exec($command);
		$resultfile = $dir."";
	}
	else if(action == "compile")
	{
		$command = ;
		shell_exec($command);
	}
	else if(action == "debug")
	{
		$command = ;
		shell_exec($command);
	}
	
	function getResult($file);
	{
		$result = file_get_contents($fp);
		echo $result;		
	}
?>
