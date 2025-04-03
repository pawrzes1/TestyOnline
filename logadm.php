<?php
	session_start();
	
	
	
	if ((isset($_SESSION['zalogowny']))&&($_SESSION['zalogowany']==true))
	{
		header('Location:admin.php');
		exit();
	}
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Logowanie do panelu administratora</title>
		
		<link rel="stylesheet" href="css/style.css"> 
		<link rel="stylesheet" href="css/skeleton.css">
	
</head>

<body>
<?php
	require_once 'config.php';
	
	$link=mysqli_connect($host, $db_user, $db_password, $db_name);

	if($link === false){
		die("ERROR: Nie można się połączyc. " . mysqli_connect_error());
	}

	@mysqli_query($link,"CREATE DATABASE IF NOT EXISTS $dbname");

	$link = mysqli_connect($host, $db_user, $db_password, $db_name);
	if($link === false){
		die("ERROR: Nie można połączyć. " . mysqli_connect_error());
	}

	$val = mysqli_query($link,"select 1 from results LIMIT 1");
	if($val === false){
		$sql = "create table results(name varchar(20),klasa varchar(20),nr_dziennika varchar(10),wynik int(3), quiz varchar(20))";
		mysqli_query($link, $sql);
		echo "Utworzono results! <br>";
	}

	$val = mysqli_query($link,"select 1 from all_tests LIMIT 1");
	if($val == FALSE) {
		$sql = "create table all_tests(name varchar(50), kodDost varchar(10), klasa varchar(1))";
		mysqli_query($link, $sql);
		echo "Utworzono all_tests! <br>";
	}
	
	$val = mysqli_query($link,"select 1 from admlog LIMIT 1");
	if($val == FALSE) {
		$sql = "create table admlog(name varchar(20), password varchar(20))";
		mysqli_query($link, $sql);
		echo "Utworzono admlog! <br>";
	}

	mysqli_close($link);
	?>



<div class=tytul>
	<center> </br></br>
		<form action="zaloguj.php" method="post">
		Login: <input type="text" name="login"/></br>
		Hasło: <input type="password" name="haslo"/></br>
	
		<input type="submit" value="Zaloguj">
	
		</form>
		
		<?php
			if(isset($_SESSION['blad']))
			
				echo $_SESSION['blad'];
			
		?>
	</center>
</div>


</body>
</html>