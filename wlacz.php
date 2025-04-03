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
	<center>
		<form action="zmiana.php" method="post">
			<?php
			
			require_once 'config.php';
			
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0)
			{
				echo "Error: ". $polaczenie->connect_errno;
			}



			$sql = "SELECT `name` FROM `test`.`all_tests`";
			$result = $polaczenie->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<input type='submit' class=btn name = 'dbtable' value = '". $row["name"]."'><br>";
				}
			}
			else {
				echo "0 results";
			}
			$polaczenie->close();
			?>
		</form>
		<input class=btn type=button value='POWRÓT' onClick=window.location.href='admin.php'>
	</center>
</body>
</html>