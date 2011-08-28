<html>
<head>
  <title>debugonline</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <script type="text/javascript" src="scripts/ajax.js"></script>
</head>
<body>
  <form action="system.php" method="POST" name="myForm">
  <div id="">
  <h4>File name:</h4>
  <input type="text" value="main.c" name="title" id="title">
  <h4>Code:</h4>
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
  <div id="debug">
    <div id="main_buttons">
    <input type="button" value="compile" onClick="checksubmit('compile');"/>
    <input type="button" value="run" onClick="checksubmit('run');"/>
    <input type="button" value="debug" onClick="change();"/>
    </div>
  </div>
  <div id="result">
  </div>
  </br>
  </form>

</body>
</html>
