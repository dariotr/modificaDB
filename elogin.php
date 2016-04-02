<?php
	session_start();
  include_once 'configurazioneDB.php';
  
  //Controllo che i dati siano arrivati tramite POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	  	//ok la pagina  stata davvero richiamata dalla form
	  
	  	//recupero il contenuto della textbox email
	  	$email = $_POST['email'];
	  
	  	//... e quello della textbox password
	  	$psw = $_POST['psw'];
	  	
	  	
	  	
	  	//=====================DA QUESTO PUNTO IN POI C'E' LA COMUNICAZIONE CON IL DB============================
	  	if($_POST['tipoLog']==='azienda'){
		  	//RICERCO LA MAIL NELLA TABELLA AZIENDA
		  	$comandoSQL =
		  	"select id, email, psw, stato_account from azienda where email ='" . $email ."'";
		  	$risultatoRicercaEmail = @mysqli_query($conn, $comandoSQL);
		  		if ($risultatoRicercaEmail) //la query ha avuto successo
		  		{
		  			//3 elaborare il risultato
		  			if ($riga = mysqli_fetch_assoc($risultatoRicercaEmail) ) //mail trovata, confrontiamo psw
		  			
		  				$autenticato = ($psw === $riga['psw']);
		  			
		  			else
		  				
		  				$autenticato = false;
		  	
		  			//4 chiudere la/le connessione/i
		  			mysqli_close($conn);
		  	
		  			//redirect
		  			if($autenticato)
		  			{
		  				if($riga['stato_account']){
			  				$_SESSION['id']=$riga['id'];
			  				header("Location: Menu.php");
		  				}
		  				else
		  					header("Location: LOGIN2.php?err=2");
		  				
		  			}
		  			else{
		  				header("Location: LOGIN2.php?err=1");
		  			 	exit; 
		  				}
			  	}
	  	}
		else if($_POST['tipoLog']==='utente')
		{
			//RICERCO LA MAIL NELLA TABELLA UTENTI
			$comandoSQL =
			"select id, email, psw, stato_account from utenti where email ='" . $email ."'";
			$risultatoRicercaEmail = @mysqli_query($conn, $comandoSQL);
			if ($risultatoRicercaEmail) //la query ha avuto successo
			{
				//3 elaborare il risultato
				if ($riga = mysqli_fetch_assoc($risultatoRicercaEmail) ) //mail trovata, confrontiamo psw
				
					$autenticato = ($psw === $riga['psw']);
				
				else
					
					$autenticato = false;
				 
				//4 chiudere la/le connessione/i
				mysqli_close($conn);
				 
				//redirect
				if($autenticato)
				{
					if($riga['stato_account']){
						$_SESSION['id']=$riga['id'];
						header("Location: Menu.php");
						}
					else
						header("Location: LOGIN2.php?err=2");
					
				}
				else{
					header("Location: LOGIN2.php?err=1");
					exit;
					}
			}
			
		
		}
	}
	else
	{
		header("Location: LOGIN2.php"); 
		exit;
	}
 ?>