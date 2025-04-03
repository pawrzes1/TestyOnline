<!DOCTYPE html>
<html lang="pl">
<head>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>WYNIKI</title>
  
</head>
<body>

	<center>
<table >
	<tr>		
	<td width="500">
	<form action="results2.php" method="post">

			<?php

			require 'config.php';

			// Create connection
			 $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			// Check connection
			if ($polaczenie->connect_error) {
				die("Połączenie nie powiodło się: " . $polaczenie->connect_error);
			}

			$sql = "SELECT name FROM all_tests";
			$result = $polaczenie->query($sql);

			if ($result->num_rows > 0) {

				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<input type='submit' class=btn name ='dbtable' value = '". $row["name"]."'><br>";
				}
			}
			else {
				echo "<center><b>BRAK WYNIKÓW</b></center>";
			}

			$polaczenie->close();
			?>
			
		</form>
		</td>
		<td >
			<center>
				<form name="wyszukaj_form" method="POST" action="results2b.php">
				<h5>Pokaż wszystkie wyniki ucznia:</h5> <input type="text" name="szukaj" id="szukaj" value="" />
				<br><input type="submit" name="znajdz" value="szukaj">
				</form>
			</center>
		</td>
		</table>
		<input class=btn type=button value='Powrót' onClick=window.location.href='admin.php'>
		
		
	</center>
</body>
</html>
