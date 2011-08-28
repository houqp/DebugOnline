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

	if(flag == "break")
	{
		var breakpoint = document.getElementById("breakpoint").value;
		str+="&breakpoint="+breakpoint;
	}
	else if(flag == "printf")
	{
		var printf = document.getElementById("barname").value;
		str+="&barname="+printf;
	}
	doAjax(doSubmitResult,'POST','system.php',str);
	return true;
}
function doSubmitResult(flag)
{
	document.getElementById("result").innerHTML="<h2>Result</h2><p>"+flag;
}
function cancle()
{
	str="action=cancle";
	doAjax("",'POST','system.php',str);
	document.getElementById("debug").innerHTML='<div id="main_buttons"><input type="button" value="compile" onClick="checksubmit(\'compile\');"/><input type="button" value="debug" onClick="change();"/><input type="button" value="run" onClick="checksubmit(\'run\');"/></div>';
}
function change()
{
	document.getElementById("debug").innerHTML='<h4>Line&nbsp;number:</h4><input type="text" value="" rows="20" cols="5" id="breakpoint" name="breakpoint" /><input type="button" value="Break" id="break" name="break" onClick="checksubmit(\'break\');"/><h4>Variable&nbsp;name:</h4><input type="text" value="" name="barname" id="barname" /><input type="button" value="Print value" id="printf" onClick="checksubmit(\'printf\');"/><div id="main_buttons"><input type="button" value="run" onClick="checksubmit(\'debug\');"/><input type="button" value="next" id="next" onClick="checksubmit(\'next\');"/><input type="button" value="cancle" onClick="cancle();"/></div>';
}
