<?php
	session_start();
	include_once 'configurazioneDB.php';
	$email=$_REQUEST['email'];
	$_SESSION['email']=$email; //mi servira per la confermaReg.php
	$password=$_REQUEST['psw'];
	$_SESSION['psw']=$password; //mi servira per la confermaReg.php
	$nome_azienda=$_REQUEST['nome_azienda'];
	$_SESSION['nome_azienda']=$nome_azienda;  //mi servira per la confermaReg.php
	$personaRif=$_REQUEST['personaRif'];
	$ruolo=$_REQUEST['ruolo'];
	$elencoCategorie=$_REQUEST['elencoCategorie'];
	$cf=$_REQUEST['cf'];
	$indirizzo=$_REQUEST['indirizzo'];
	$cap=$_REQUEST['cap'];
	$elencoProvince=$_REQUEST['elencoProvince'];
	$telefono=$_REQUEST['telefono'];
	$fax=$_REQUEST['fax'];
	$telefono2=$_REQUEST['telefono2'];
	$cell=$_REQUEST['cell'];
	$sitoweb=$_REQUEST['sitoweb'];
	$parlaci=$_REQUEST['parlaci'];
	$citta=$_REQUEST['citta'];
	$domanda=$_REQUEST['domanda'];
	$risposta=$_REQUEST['risposta'];
	
	
	//Ricavo l'id di categoria
	$query=" select idCat from categoria where categoria='".$elencoCategorie."';";
	$result=mysqli_query($conn,$query);
	$idCateg=mysqli_fetch_assoc($result);
	//ricavo l'id di provincia
	$query="select id from province where provincia='".$elencoProvince."';";
	$result=mysqli_query($conn,$query);
	$idProvinc=mysqli_fetch_assoc($result);

	//inserimento nella tabella telefoni
	$comandoSQL="insert into telefoni values ( NULL, '".$telefono."'";
	
	if($fax!=="")
		$comandoSQL=$comandoSQL.", '".$fax."'";
	else if($fax=="")
		$comandoSQL=$comandoSQL.", NULL";
	if($telefono2!=="")
		$comandoSQL=$comandoSQL.", '".$telefono2."'";
	else if ($telefono2=="")
		$comandoSQL=$comandoSQL.", NULL";
	if($cell!=="")
		$comandoSQL=$comandoSQL.", '".$cell."'";
	else if($cell=="")
		$comandoSQL=$comandoSQL.", NULL";
	
	$comandoSQL= $comandoSQL." );";

	//inserisco il telefono nella tabella telefoni
	$risultato= mysqli_query($conn,$comandoSQL);
	if($risultato===false){
		//Rimando alla pagina di registrazione con un messaggio di errore
		mysqli_close($conn);
		header("Location: REGISTRAZIONE2.php?errore=2");
	}
	else{
		//recupero idTel
		$query="select id from telefoni where numero='".$telefono."';";
		$result=mysqli_query($conn,$query);
		$idTelefono=mysqli_fetch_assoc($result);
		
		
		//Inserimento dati nella tabella azienda
		$comandoSQL = "insert into azienda values ( NULL, '".$email."', '".$password."', '".$nome_azienda."', '".
		$personaRif."', '".$cf."', '".$indirizzo."', '".$citta."', '".$cap."'";
	
		if($sitoweb!=="")
			$comandoSQL=$comandoSQL.", '".$sitoweb."'";
		else if($sitoweb=="")
			$comandoSQL=$comandoSQL.", NULL";
		
		$comandoSQL=$comandoSQL.", 0 ";
		
		if($parlaci!=="")
			$comandoSQL=$comandoSQL.", '".$parlaci."'";
		else if ($parlaci=="")
			$comandoSQL=$comandoSQL.", NULL";
		
		$comandoSQL=$comandoSQL.", 50, '".$idTelefono['id']."', '".$idCateg['idCat']."', '".$idProvinc['id']."', '".$ruolo."', '".$domanda."', '".$risposta."' );";
		$risultato=mysqli_query($conn,$comandoSQL);

		if($risultato===false){
	
			
			//se non riesco ad inserire in azienda allora elimino il dato inserito in telefoni
			$ripristina="DELETE FROM telefoni WHERE id= '".$idTelefono['id']."';";
			$risult=mysqli_query($conn,$ripristina);
			echo "ID TELEFONO :".$idTelefono['id'];
			mysqli_close($conn);
			header("Location: REGISTRAZIONE2.php?errore=1");//email già esistente
		
		}
		else{
			mysqli_close($conn);
			
			//Vado alla pagina php di conferma registrazione
			header("Location: ConfermaReg.php");
		}
	}
?>