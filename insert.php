<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location:logadm.php');
		exit();
	}
	ini_set( 'display_errors', 'On' ); 
	error_reporting( E_ALL );
?>


<!DOCTYPE html>
<html>
<head lang="pl">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>
<body>
	<?php

	/* Attempt MySQL server connection. */
	require_once 'config.php';
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		

	// Check connection
	if($polaczenie === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$quizName = mysqli_real_escape_string($polaczenie, $_POST["quizName"]);
	$kodDost = mysqli_real_escape_string($polaczenie, $_POST["kodDost"]);
	$klasa = mysqli_real_escape_string($polaczenie, $_POST["klasa"]);
	
	$quizNames = str_replace(" ","_","$quizName");
		$sql1 = "create table $quizNames (s int(2),q varchar(150), a1 varchar(100), a2 varchar(100), a3 varchar(100), a4 varchar(100), box varchar(5))";
	mysqli_query($polaczenie, $sql1);
	$sql2 = "insert into all_tests (name, kodDost, klasa) values ('$quizNames','$kodDost','$klasa')";
	mysqli_query($polaczenie, $sql2);

	// Escape user inputs for security
	for($x=0;;$x++) {
		@$q = mysqli_real_escape_string($polaczenie, $_POST["q"."$x"]);
		@$a1 = mysqli_real_escape_string($polaczenie, $_POST["a1"."$x"]);
		@$a2 = mysqli_real_escape_string($polaczenie, $_POST["a2"."$x"]);
		@$a3 = mysqli_real_escape_string($polaczenie, $_POST["a3"."$x"]);
		@$a4 = mysqli_real_escape_string($polaczenie, $_POST["a4"."$x"]);
		@$a = mysqli_real_escape_string($polaczenie, $_POST["a"."$x"]);
		
		
		
		
		// attempt insert query execution
		$sql = "INSERT INTO $quizNames ('s', 'q', 'a1', 'a2', 'a3', 'a4', 'box') VALUES ($x,'$q','$a1','$a2','$a3','$a4', 'a'+$a)";
		if(mysqli_query($polaczenie, $sql)){
			continue;
		    echo 'udalo sie';
		}
		else{
			
			echo 'nic z tego'. mysqli_connect_error();
			break;
			
		}
		}
	echo "<center></br></br><h2>ZROBIONE</h2></center>";
	echo "<center><input class=btn type=button class=btn value='POWRÓT' onClick=window.location.href='admin.php'></center>";

	mysqli_close($polaczenie);
	?>

</body>
</html>
