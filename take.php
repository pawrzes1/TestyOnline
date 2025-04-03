<?php
	session_start();
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>
<body>

<br>
<br>
<br>
<br>
	<center>
		<form action="take2.php" method="post">
			<?php
			
			require_once 'config.php';
			
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0)
			{
				echo "Error: ". $polaczenie->connect_errno;
			}

			$kod = $_SESSION['kod'];
			

			$sql = "SELECT `name` FROM `pawrzes1ns_test`.`all_tests` WHERE kodDost='$kod'";
			$result = $polaczenie->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "<input type='submit' class=btn name='dbtable' value = '". $row["name"]."'><br>";
				}
			}
			else {
				echo "0 results";
			}

			$polaczenie->close();
			?>
		</form>
		<input class=btn type=button value='POWRÓT' onClick=window.location.href='index.php'>
	</center>
</body>
</html>
