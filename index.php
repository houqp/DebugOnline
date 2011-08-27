<html>
<head>
<title>
debugonline
</title>
<script type="text/javascript" src="scripts/ajax.js"></script>
</head>
<body>

<form action="system.php" method="POST" name="myForm">
code title:<input type="text" value="main.c" name="title" id="title">
<p>
<textarea type="submit" value="submit" name="code"  id="code" rows="10" cols="32">
	#include<stdio.h>
	int main()
	{
		int a=0;
		a=10;
		printf("hello world");
		return 0;
	}
</textarea>
<p>
<div id="debug">
	<input type="button" value="compile" onClick="checksubmit('compile');"/>
	<input type="button" value="debug" onClick="change();"/>
	<input type="button" value="run" onClick="checksubmit('run');"/>
</div>
<p>
<div id="result">
</div>
</br>
</form>

</body>
</html>
