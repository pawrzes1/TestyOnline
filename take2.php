<?php
	session_start();
	
	
	
	
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <script src="scripts/quizzer.js" type="text/javascript"></script>
  <script src="scripts/walidacjaform.js" type="text/javascript"></script>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <title>Rozwiąż test</title>
  

  
</head>
<body>

  <center>
    <br><br><br>
	<form action="take3.php" method="post" id="logform">
      <div style="display:block;" id="f1">
        <table>
          <tr><td><label for="imie">Imie:</label><td><input type="text" name="imie" id="imie" placeholder="Wpisz swoje imie" required="required"></td></tr>
          <tr><td><label for="nrWDzienniku">Nr w dzienniku:</label><td><input type="number" placeholder="0" name="nrWDzienniku" id="nrWDzienniku"></td></tr>
          <tr><td><label for="klasa">Klasa:</label><td><input type="text" name="klasa" placeholder="Wpisz literę klasy" id="klasa"></td></tr>
		  
        </table>
        <input type=button class=btn value=Potwierdź id="btn1" onClick=op()>
      </div>
	  
	  
      <div style="display:none;" id="f2">

		
		<div id="time" style="position: absolute; right: 0; margin-right: 50px; font-size: 30px; color:red;"></div>
		
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
  <script type="text/javascript">
	$(document).ready(function() {
	
	var sekundy = 1000;
	var url = 'take3.php';
	
		function countdown(){
			var minuty = Math.round((sekundy - 30)/ 60);
			var pozostaleSekundy = sekundy % 60;
			
			if (pozostaleSekundy < 10){
				pozostaleSekundy = "0" + pozostaleSekundy;
			};
			setTimeout(countdown, 1000);			
			$('#time').html("Do końca zostało <br><b>" +minuty + ":"+pozostaleSekundy +"</b>");
			sekundy --;
			
			if ((minuty + sekundy) <0){
				window.location=url;
				sekundy = 0;
			};
		}
		
		countdown();
		
	});
  </script>
  
  
		<table>
          <?php

          $tab = $_POST['dbtable'];

          require_once 'config.php';

          // Create connection
          $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
          // Check connection
          if ($polaczenie->connect_error) {
            die("Połączenie nie powiodło się: " . $polaczenie->connect_error);
          }

          $sql = "SELECT s,q,a1,a2,a3,a4 FROM $tab ORDER BY RAND() LIMIT 5";
          $result = $polaczenie->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td colspan=2>Pytanie: ". $row["q"]."</tr>";
              echo "<tr><td> <input type=radio name=q".$row["s"]." value=1> A) ". $row["a1"]."<td> <input type=radio name=q".$row["s"]." value=2> B) ". $row["a2"]."</tr>";
              echo "<tr><td> <input type=radio name=q".$row["s"]." value=3> C) ". $row["a3"]."<td> <input type=radio name=q".$row["s"]." value=4> D) ". $row["a4"]."</tr>";
			  echo "<tr><td><br><br></td></tr>";
			}
            echo "</table>";
			
          }
          else {
            echo "0 rezultatów";
          }
          echo "<input type=hidden name=table value='$tab'>";
          $polaczenie->close();
          ?>
        </table>
        <input type="submit" class=btn value="Zakończ" >
      </div>
    </form>
  </center>
  

</body>
</html>
