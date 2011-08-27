<?php
class Compile extends Code
{
	private $command;
	public function __construct($code = "")
	{
		$command = $code;
	}
	function runCommand($command)
	{
		shell($command);
	}
	function getResult()
	{
		
	}
}
?>
