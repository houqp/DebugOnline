<?php
	$code = $_POST["code"];
	$title = $_POST["title"];
	$breakpoint = $_POST["breakpoint"];
	$action = $_POST["action"];
	$barname = $_POST["barname"];
	//echo $code.$title.$action;
	$ip = $_SERVER['REMOTE_ADDR'];
	
	//mkdir a folder for a user
	$fold1="/var/www/debugonline/temp/";
	$dir="/var/www/debugonline/".$ip."/";
	xCopy($fold1,$dir,1);
	
	$breakfile = $dir."gdb_commands";
	
	//write in you c or c++ file
	$filename = $dir.$title;
	$fp = fopen($filename,"w");
	fputs($fp,$code);
	fclose($fp);
	

	if($action == "run") 	//run you code
	{	
		$command = "cd ".$ip." && make run" ;
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
		$command = "cd ".$ip." && make";
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
		debugRun($ip);
		$result = getResult($dir."gdb_output");
		//unlink($dir."gdb_output_raw.old");
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
			debugRun($ip);
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
		debugRun($ip);
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
		debugRun($ip);
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

	function xCopy($source, $destination, $child){
		if (!file_exists($destination))
		{
		    if (!mkdir(rtrim($destination, '/'), 0777))
		    {
		    //$err->add($_LANG['cannt_mk_dir']);
		    return false;
		    }
		    @chmod($destination, 0777);
		 }
		if(!is_dir($source)){  
			return 0;
		}
		if(!is_dir($destination)){
			mkdir($destination,0777);   
		}
		$handle=dir($source);
		while($entry=$handle->read()){
			if(($entry!=".")&&($entry!="..")){
				if(is_dir($source."/".$entry)){ 
					if($child)
					xCopy($source."/".$entry,$destination."/".$entry,$child);
				}
			else{
				copy($source."/".$entry,$destination."/".$entry);
				}
			}    
		}    
		return 1;
	}
	function getResult($file)
	{
		$result = file_get_contents($file);	
		return $result;		
	}
	function debugRun($ip)
	{
		$command = "cd ".$ip." && make gdb";
		exec($command);
	}
?>
