<?php
	ob_start();
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:logadm.php'); 
		exit();
	}
?>
<!--sprawdzamy czy użytkownik jest zalogowany, jeżeli nie jest zalogowany zostanie automatycznie przekierowany do adresu logadm.php-->
<!--strona panelu administratora-->
<!DOCTYPE html>
<html>
<head lang="pl">
	<title>
		Panel administratorski
	</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="css/style.css"> 
		<link rel="stylesheet" href="css/skeleton.css"> 
	<style>
	div {
		height:50%;
		position:relative;
		top:20%;
	}
	</style>
</head>
<body>



<?php

	echo "<b><center><font color=white> Witaj ".$_SESSION['login']."</b></center></font>";

?>


<!--panel zarządznia testami i wynikami-->
	<center>
	</br><br>
	<div class=tytul>PANEL ADMINISTRATORA</div></br></br>
		<div>
			<input class=btn type=button value="Utwórz test" onClick="window.location.href='ins.php'"> <!--tworzymy nowy test w bazie danych-->
			        
			<input class=btn type=button value="wypróbuj test" onClick="window.location.href='index.php'"> <!--sprawdzamy działanie naszego testu-->
			</br>
			<input class=btn type=button value="wyniki" onClick="window.location.href='results.php'"> <!--sprawdzamy wyniki testów uczniów-->
			   
			<input class=btn type=button value="wykasuj Test" onClick="window.location.href='pro/delete.php'"> <!--kasujemy wybrany test-->
			</br></br></br>
			
			<div class=wyloguj>
				<a href='wyloguj.php' class=wylog>WYLOGUJ</a>
			</div>

	</div>
</center>
</body>
</html>
<?php
ob_end_flush();
?>
