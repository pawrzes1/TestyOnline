<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:logadm.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <script src="scripts/quizzer.js" type="text/javascript"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <meta charset="UTF-8">
  
  <title>Dodaj nowy test</title>
</head>
<body>
  <center>
    <form action="insert.php" method="post">
      <div id="f1" name="f1">
        <hr width=50%><span><b><font size=6%>Nazwa testu : </font></b></span><input type="text" name="quizName" id="quizName"> &nbsp;   
		<br><span>kod dostępu:</span><input type="text" name="kodDost" id="kodDost">
		<span>klasa:</span><input type="text" name="klasa" id="klasa"> </br>
		</hr width=50%>
        <span><font size=5%>Pytanie : </font></span><input type="text" name="q0" id="q0"><br>
        <span>Opcja 1 : </span><input type=radio name="a0" value=1 checked="checked"><input type="text" name="a10" id="a10" ><br>
        <span>Opcja 2 : </span><input type=radio name="a0" value=2><input type="text" name="a20" id="a20"><br>
        <span>Opcja 3 : </span><input type=radio name="a0" value=3><input type="text" name="a30" id="a30"><br>
        <span>Opcja 4 : </span><input type=radio name="a0" value=4><input type="text" name="a40" id="a40"><br>
		 <br>
	  </div>
      <br>
      <input type=button class=btn onClick=addQ() value="Dodaj pytanie">
	  <br>
      <input class=btn type=button value='Powrót' onClick=window.location.href='admin.php'>
	  
	  <input type="submit" class=btn value="Zakończ">
	  
	  
    </form>
  </center>
</body>
</html>
