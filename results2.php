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
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <title>Winiki testu</title>
  
   <?php 
  
  $tab = $_POST['dbtable'];

          require 'config.php';

          // Create connection
          $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
          // Check connection
          if ($polaczenie->connect_error) {
            die("Connection failed: " . $polaczenie->connect_error);
          }
   ?>
  
</head>
<body>
  <center>
  <h1>Wyniki testu: 
  <?php 
  
  echo "$tab" 
  ?>
  </h1>
  
  
    <form action="../take3.php" method="post">
      <table id="table">
        <tr>
		<td cellpadding="10" width="110"><b>nr w dzienniku</b><td width="100"><b>Imie</b><td width="100"><b>klasa</b><td width="100"><b>WYNIK</b></tr>

          <?php

          

          $sql = "SELECT * FROM results where quiz='$tab' ORDER BY nr_dziennika";
          $result = $polaczenie->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td>". $row["nr_dziennika"]."</td><td>". $row["name"].  "</td><td>". $row["klasa"]. "</td><td>". $row["wynik"]. "</td></tr>";
            }
            echo "</table>";
          }
          else {
            echo "brak wyników <br><br>";
          }
          echo "<input type=hidden name=table value='$tab'>";
          $polaczenie->close();
          ?>

         
        </table>
        
      </form>
	  

    <input class=btn type=button value='Powrót' onClick=window.location.href='results.php'>
	
	</center>
  </body>
  </html>
