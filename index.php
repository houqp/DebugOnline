
<html>
<head>
<title>
debugonline
</title>
<script>
function checksubmit(flag)
{
	document.myForm.action = "system.php?action="+flag;
	document.myForm.submit();
}
function debug()
{

}
</script>
</head>
<body>

<form action="system.php" method="POST" name="myForm">
code title:<input type="text" value="" name="title">
<br>
<textarea type="submit" value="submit" name="code" rows="10" cols="32">
</textarea>
<br />
<div id="debug">
debug line:<input type="text" value="" rows="20" cols="5" name="debugline"/>
<br />
<br>
bar name:<input type="text" value="" name="barname">
</br>
<input type="button" value="compile" onClick="checksubmit('compile');"/>
<input type="button" value="debug" onClick="checksubmit('debug');"/>
<input type="button" value="next" onClick="checksubmit('next');"/>
<input type="button" value="run" onClick="checksubmit('run');"/>
</div>
</form>

</body>
</html>
