<?php
	session_start();
	
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <script src="scripts/quizzer.js" type="text/javascript"></script>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <title>Udostępnianie</title>
</head>
<body>
  <center>
   <form action="" method="post">
	 
        <table>
          <?php


		  
          require_once 'config.php';

          // Create connection
          $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
          // Check connection
          if ($polaczenie->connect_error) {
            die("Połączenie nie powiodło się: " . $polaczenie->connect_error);
          }
		  

		  
		  $ntab = ($_POST['dbtable']);
		  
			echo "<h1>".$ntab."</h1>";
			echo "<br>";
		  
          $sql = "SELECT kodDost FROM all_tests WHERE name='$ntab'";
          $result = $polaczenie->query($sql);
			$row = $result->fetch_assoc();
			echo "<h2> Udostępniony: ";
			echo ($row['kodDost']);
         $udost = ($row['kodDost']);
		 		  
			$selected_radio = isset($_POST['value']);		  
			$sql1 = "UPDATE all_tests SET kodDost='".$selected_radio."' WHERE name='$ntab'";
			$result = $polaczenie->query($sql1);
		 
		echo "<br><br>czy udostępnić?";
		echo "<tr><td> <h3><input type=radio name=radio value=TAK class=radio"; 
				if ($row['kodDost'] == 'Tak') 
					{echo "checked";} 
					echo "/>TAK</h3>";
		  echo "</td><td><h3> <input type=radio name=radio value=NIE class=radio ";
				if ($row['kodDost'] == 'NIE')
					{echo "checked";}
					echo "/>NIE</td></tr></h3>";
          

		  
		  echo "</h2></table>";
		  $polaczenie->close();
          ?>
        </table>
        <input type="submit" class=btn value="Zatwierdź" >
  
	</form>
  </center>
</body>
</html>
