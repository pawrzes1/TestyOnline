<?php
	session_start();
	

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skeleton.css">
</head>
<body>
  
	<div id="kontener">
	  
		  <div id="sideleft">
				.
		  </div>
		
			<div id="center">
			
	<?php

	require 'config.php';

	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	// Sprawdzanie połączenia
	if ($polaczenie->connect_error) {
		die("Połączenie nie powodło się: " . $polaczenie->connect_error);
	}

	@$tab = $polaczenie->real_escape_string($_POST['table']);
	@$imie = $polaczenie->real_escape_string($_POST['imie']);
	@$nrWDzienniku = $polaczenie->real_escape_string($_POST['nrWDzienniku']);
	@$klasa = $polaczenie->real_escape_string($_POST['klasa']);


	$sql="select count(s) from $tab";
	$r= $polaczenie->query($sql);

	if ($r->num_rows > 0) {
		// output data of each row
		while($row = $r->fetch_assoc()) {
			$length= $row["count(s)"];
		}
	}

	$sql="select * from $tab";
	$r= $polaczenie->query($sql);

	if ($r->num_rows > 0) {
		$i=0;
		while($row = $r->fetch_assoc()) {
			$ans[$i]= $row["box"];
			$q[$i] = $polaczenie->real_escape_string($_POST["q$i"]);
			$i++;
		}
	}

	$s = 0;

	$length = count($ans);

	for ($i = 0; $i < $length; $i++) {
		if ($ans[$i] == $q[$i]) $s++;
	}

	// attempt insert query execution
	$sql = "INSERT INTO results (name, klasa, nr_dziennika, wynik, quiz) VALUES ('$imie', '$klasa', '$nrWDzienniku' , $s, '$tab')";

	if($polaczenie->query($sql)){
		echo "<br><br><center><h1>Wynik testu dodany poprawnie! </h1><br><br><h4>Poczekaj na ocenę od nauczyciela</h4><br></center>";
	}
	else{
		echo "ERROR: Nie można wykonać polecenie $sql. " .$polaczenie->error();
	}
	echo "<center><input class=btn type=button value='Powrót' onClick=window.location.href='index.php'></center>";
	// close connection
	$polaczenie->close();
	?>
	
		</div>
				
			<div id="sideright">
				<br><br><br><br><br><br><img src="gify/2.gif"/>
				  
			</div>
	</div>
</body>
</html>
