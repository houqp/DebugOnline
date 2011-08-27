<html>
<head>
<title>
debugonline
</title>
<script>

function initAjax()
{
    if(window.XMLHttpRequest) {
        ajax = new XMLHttpRequest();
        if (ajax.overrideMimeType)
            ajax.overrideMimeType('text/xml');
    }
    else if(window.ActiveXObject) { 
        try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(e) {
            try {
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    
    if (!ajax || typeof(ajax) =='undefined') {
        alert('Cannot create an XMLHTTP instance!');
        return null;
    }
    
    return ajax;
}

function doAjax(funcResp, method, url, content)
{   
    var ajax = initAjax();
    if(! ajax || (method != 'GET' && method != 'POST') ) return;
     
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
            
                var resp = '';
                var contentType = ajax.getResponseHeader('Content-Type');
                if(/text\/xml/i.test(contentType)) {
                    resp = ajax.responseXML;
                }
                else { 
                    resp = ajax.responseText;
                }
                
                if(typeof(funcResp) == 'function') {
                    funcResp(resp);
                }
                else {
                }
            }
            else {
                alert('There was a problem with the request.');
            }
        }
    };

    ajax.open(method, url, true);
    if(method == 'POST') {
        ajax.setRequestHeader("Content-Type",
                    "application/x-www-form-urlencoded;charset=gb2312");
    }
    ajax.send(content);
}
function checksubmit(flag)
{
	var code=document.getElementById("code").value;
	var title=document.getElementById("title").value;
	var str="action="+flag+"&code="+code+"&title="+title;
	doAjax(doSubmitResult,'POST','system.php',str);
	return true;
}
function doSubmitResult(flag)
{
	document.getElementById("result").innerHTML="result:<p>"+flag;
}
function cancle()
{
	document.getElementById("debug").innerHTML='<input type="button" value="compile" onClick="checksubmit(\'compile\');"/><input type="button" value="debug" onClick="change();"/><input type="button" value="next" onClick="checksubmit(\'next\');"/><input type="button" value="run" onClick="checksubmit(\'run\');"/>';
}
function change()
{
	document.getElementById("debug").innerHTML='<p>debug line:<input type="text" value="" rows="20" cols="5" name="debugline" /><input type="button" value="break" id="break" onClick="checksubmit(\'break\');break();"/><p>bar &nbsp;&nbsp;name:<input type="text" value="" name="barname" /><input type="button" value="printf" id="printf" onClick="printf();"/><p><input type="button" value="debug" onClick="checksubmit(\'debug\');"/><input type="button" value="next" id="next" onClick="next();"/><input type="button" value="cancle" onClick="cancle();"/>';
}
</script>
</head>
<body>

<form action="system.php" method="POST" name="myForm">
code title:<input type="text" value="" name="title" id="title">
<p>
<textarea type="submit" value="submit" name="code" id="code" rows="10" cols="32">
#include<stdio.h>
int main()
{
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
