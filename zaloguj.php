<?php

	session_start();
	
	if((!isset($_POST['login']))||(!isset($_POST['haslo'])))
	{
		header('Location:logadm.php');
		exit();
	}

	require_once 'config.php';
	
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
		if($polaczenie->connect_errno!=0)
		{
			echo "Error: ". $polaczenie->connect_errno;
		}
		else
		{		
			$login = $_POST['login'];
			$haslo = $_POST['haslo'];
			
			/* zabezpieczenie przed wstrzykiwaniem SQL */
			
			$login = htmlentities($login,ENT_QUOTES, "UTF-8");
			$haslo = htmlentities($haslo,ENT_QUOTES, "UTF-8");
			/*-----------------------------------------*/
			
			
			
			
			if ($rezultat = @$polaczenie->query(
			sprintf("SELECT * FROM admlog WHERE name='%s' AND password='%s'",
			mysqli_real_escape_string($polaczenie, $login),
			mysqli_real_escape_string($polaczenie, $haslo))))
			{
				$ilu_userow = $rezultat->num_rows;
				if($ilu_userow>0)
				{
					
					$_SESSION['zalogowany']=true;
					
					$wiersz= $rezultat->fetch_assoc();
					
					$_SESSION['login'] = $wiersz['name'];
					
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location:admin.php');
					
					
				} else{
					
					
					$_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location:logadm.php');
				}
			}
			
				
			}
		
			$polaczenie->close();
		

		
?>
