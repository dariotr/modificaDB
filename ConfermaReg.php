<?php 
	session_start();
	//Invio un Email contentente NickName, password in chiaro e link per confermare la registrazione. 
	$mail=$_SESSION['email'];
	$pass=$_SESSION['psw'];
	//Attraverso la funzione md5 che sfrutta l'algoritmo MD5 cripto un messaggio che dopo utilizzero
	$msgid = md5(time());
	//mi servirà per mandare $msgid al loginborsa.php
	$_SESSION['mdid']=$msgid;
	
	$to ="postmaster@localhost";//$_SESSION['email']; 
	$toname = $_SESSION['nomeAZ']; 
	$subject = "Completa la tua registrazione"; 
	//MIME, Multiporpouse Internet Mail Extensions 
	//sono estensioni del formato originario con cui venivano inviati i messaggi di posta elettronica
	$boundary = "==MP_Bound_xyccr948x=="; /*Separatore per il "multipart message"*/
	
	//versione del MIME
	$headers = "MIME-Version: 1.0\r\n"; 
	//multipart/alternative per indicare che il messaggio è costituito da più parti 
	//(“multipart”) le quali sono tra loro alternative (“alternative”). Separate dal BOUNDARY 
	$headers .= "Content-type: multipart/alternative; boundary='$boundary'\r\n"; 
	// costruiamo intestazione generale
	$headers .= "From: miaemail@gmail.com \r\n";  
	
	//Costruisco il messaggio html
	$html_msg = "<center>"; 
	$html_msg .= "<table width='500' border=0 cellpadding='4'>"; 
	$html_msg .= "<tr><td align='center'>&nbsp;"; 
	$html_msg .= "</td></tr>"; 
	$html_msg .= "<tr><td>Questi sono i dati della tua registrazione:"; 
	$html_msg .= "</td></tr><tr><td>Username: <font color=\"red\">" . $mail . "</font>"; 
	$html_msg .= "</td></tr><tr><td>Password: <font color=\"red\">" . $pass . "</font>"; 
	$html_msg .= "</td></tr><tr><td align='center'>&nbsp;"; 
	$html_msg .= "</td></tr></table></center>"; 
	
	//Messaggio di conferma
	$confirmmessage = "Salve,\n\n"; 
	$confirmmessage .= "per completare la registrazione dell' azienda ".$toname." devi cliccare sul link sottostante:\n\n"; 
	$confirmmessage .= $html_msg . "\n\n"; 
	// confirm_reg.php 
	$confirmmessage .= "<a href='LOGIN2.php" . 
	  "?id=$msgid'>Clicca qui per confermare la tua registrazione</a>"; 
	
	//questa parte del messaggio viene visualizzata
	// solo se il programma non sa interpretare
	// i MIME poiché è posta prima della stringa boundary
	$message = "This is a Multipart Message in MIME format\n"; 
	$message .= "--$boundary\n"; 
	$message .= "Content-type: text/html; charset=iso-8859-1\n"; 
	//la codifica con cui viene trasmesso il contenuto.
	$message .= "Content-Transfer-Encoding: 7bit\n\n"; 
	$message .= $confirmmessage . "\n"; 
	$message .= "--$boundary--";
	
	//invio mail
	$mailsent = mail($to, $subject, $message, $headers); 
	//controllo 
	if ($mailsent) 
	{ 
	  echo "<body style='background-color:#8080ff; font-family: monospace; font-size: x-large; color: white; text-align: center;'>
	  		Salve,<br>"; 
	  echo "Un messaggio &egrave stato inviato all'indirizzo <b>" . $to . "</b> da te fornito.<br><br>"; 
	  echo "IMPORTANTE:<br>"; 
	  echo "Per completare la registrazione al sito devi aprire la tua casella e-mail, leggere il messaggio di conferma e cliccare sul link che troverai all'interno.<br><br>Tra pochi secondi verrai reindirizzato alla pagina di login</body>"; 
	  // reindirizzamento a tempo
	  header( "refresh:10;LOGIN2.php" );
	}
	 else { 
	  	echo "<body style='background-color:#8080ff; font-family: monospace; font-size: x-large; color: white; text-align: center;'>
	  			Errore durante l'invio dell'e-mail. 
	  		</body>"; 
	  	header( "refresh:10;LOGIN2.php" );
	} 
?>