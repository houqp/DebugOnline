<?php
	$code = $_POST["code"];
	$title = $_POST["title"];
	$breakpoint = $_POST["breakpoint"];
	$action = $_POST["action"];
	$barname = $_POST["barname"];
	//echo $code.$title.$action;
	function getResult($file)
	{
		$result = file_get_contents($file);	
		return $result;		
	}
	function debugRun()
	{
		$command = "cd temp && make gdb";
		exec($command);
	}
	$dir = "/var/www/debugonline/temp/";
	$filename = $dir.$title;
	$breakfile = $dir."gdb_commands";
	$fp = fopen($filename,"w");
	fputs($fp,$code);
	fclose($fp);
	if($action == "run")
	{	
		$command = "cd temp && make run" ;
		//echo $command;
		exec($command);
		$resultfile = $dir."run_output";
		$result = getResult($resultfile);
		unlink($filename);
		unlink($resultfile);
		$result = str_replace("\n","<p>",$result);
		echo $result;
	}
	else if($action == "compile")
	{
		$command = "cd temp && make";
		shell_exec($command);
		$resultfile = $dir."compile_output";
		$result = getResult($resultfile);
		unlink($resultfile);
		if($result == "")
			echo "compile good";
		$result = str_replace("\n","<p>",$result);
		echo $result;
		
	}
	else if($action == "debug")
	{			
		$command = "r\n";
		$breakfp = fopen($breakfile,"a+");
		fputs($breakfp,$command);
		fclose($breakfp);
		debugRun();
		$result = getResult($dir."gdb_output");
		unlink($dir."gdb_output_raw.old");
		$result = str_replace("\n","<p>",$result);
		echo $result;
	}
	else if($action == "break")
	{
		$command = "b ".$breakpoint."\n";
		$breakfp = fopen($breakfile,"a+");
		fputs($breakfp,$command);
		fclose($breakfp);
		$result = getResult($dir."gdb_commands");
		if(strstr($result,"r") != FALSE)
		{
			debugRun();
			$result = getResult($dir."gdb_output");
			unlink($dir."gdb_output_raw.old");
			$result = str_replace("\n","<p>",$result);
			echo $result;
		}
	}
	else if($action == "next")
	{
		$command = "n\n";
		$breakfp = fopen($breakfile,"a+");
		fputs($breakfp,$command);
		fclose($breakfp);
		debugRun();
		$result = getResult($dir."gdb_output");
		unlink($dir."gdb_output_raw.old");
		$result = str_replace("\n","<p>",$result);
		echo $result;
	}
	else if($action == "printf")
	{
		$command = "p ".$barname."\n";
		$breakfp = fopen($breakfile,"a+");
		fputs($breakfp,$command);
		fclose($breakfp);
		debugRun();
		$result = getResult($dir."gdb_output");
		$result = str_replace("\n","<p>",$result);
		echo $result;
	}
	else if($action == "cancle")
	{
		unlink($dir."gdb_commands");	
		$result = str_replace("\n","<p>",$result);
		echo $result;
		
	}

?>
