<?php
		
		include_once 'configurazioneDB.php';	
		$comandoSQL ="select categoria from categoria";
		$result=mysqli_query($conn,$comandoSQL);
?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="author" content="Mario" />
		<meta name="description" content="Registrazione azienda borsa delle idee" />
		<meta name="keywords" content="borsa delle idee, idea, borsa, azienda" />
	    <title>Borsa delle idee</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link href="css/stileREG2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style >
				@keyframes evidenzia{
					from{color:black;font-weight: bold;}
					to {color:red;font-weight: bold;}
				}
				@keyframes illuminati
				{
					from{}
					to{color: yellow;font-size: 50px;}
				}
				@keyframes composizioneborsa
				{
					from{padding-left:5px; font-size: small;}
					to{}
				}
		</style>
	</head>
	<body style='background-color: #5D8AA8; margin-top:40px;'>
		<div class="container">
    		<h1 class="well" style='background-color:#4646FF; color:white;'>
				<div id='Titolo'>Borsa delle <span id='idea'>idee</span></div>
				<div id='registrazione'>Registrazione azienda</div>
			</h1>
				<div class="col-lg-12 well" style='background-color:white; margin-top:-22px;'>
					<div class="row">
					<form name='registra' action='eRegistra.php' method='POST' id="registra">
						<div class="col-sm-12">
											<?php
												 if( isset($_GET['errore']) )
												 {
												    echo " <div class='alert alert-danger' style='font-style: monospace; font-weight: bold;  letter-spacing:1px;'>
												    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
												         
												    switch ($_GET['errore'])
												    {
												       case 1:
												         echo "Indirizzo Email o Codice fiscale(Partita iva) gi&agrave esistente .";
												        break;
												    
												       case 2:
												         echo "Telefono  gi&egrave esistente.";
												        break;
												    }
												    
												    echo "</div>";
												    
												 }
											 ?><br/>
											 <label class='star' data-toggle="tooltip" title="I campi indicati con * sono obbligatori!">[?]</label><br/>
							<div class="row">
								<div class="col-sm-4 form-group">
									<label class='star' >* </label> <label >Nome azienda:</label>
									<input  type="text"  value='' name='nome_azienda'  class="form-control" required>
								</div>
								<div class="col-sm-4 form-group">
									<label class='star' >* </label> <label>Persona di riferimento:</label>
									<input  type="text" value='' name='personaRif' required class="form-control"></br>
								</div>
								<div class="col-sm-4 form-group">
									<label class='star' >* </label> <label>Ruolo nell'azienda:</label>
									<input  type="text" value='' name='ruolo' required class="form-control" placeholder="Il tuo ruolo all'interno dell'azienda"></br>
								</div>

	                            
	                            
	                            
	                            
	                            <div class="col-sm-4 form-group">
	                        
	    							<label class='star'>* </label> <label>Categoria:</label>
									<select class="form-control"  name='elencoCategorie' required>
												<option  value="" selected>Scegli la categoria</option>
											<?php 			
													while	($row = mysqli_fetch_assoc($result) ){
														echo"<option id='$row[idCat]'>$row[categoria]</option>";
													}
											?>		
												</select>
								</div>
	                            
	                            <div class="col-sm-4 form-group">
	    							<label class='star'>* </label> <label>Partita IVA o Codice Fiscale:</label>
									<input type="text" value='' name='cf' required class="form-control">
								</div>
	                            
	                            <div class="col-sm-4 form-group">
	    							<label>Sito web:</label>
									<input type="text" value='' name='sitoweb' class="form-control">
								</div>
	                                    
						</div>					
							<div class="form-group">
								<label>Maggiori dettagli:</label>
									<textarea value='' name='parlaci' placeholder="Qualcosa sulla tua azienda..." class="form-control"></textarea>
							</div>	
							<div class="row">
								<div class="col-sm-4 form-group">
									<label class='star'>* </label> <label>Citta:</label>
									<input type='text' value='' name='citta' required class="form-control">
								</div>	
								<div class="col-sm-4 form-group">
									<label class='star'>* </label> <label>CAP:</label>
									<input type="number" value='' name='cap' required class="form-control">
								</div>	
								<div class="col-sm-4 form-group">
									<label class='star'>* </label> <label>Indirizzo:</label>
									<input type='text' value='' name='indirizzo' required class="form-control">
								</div>		
							</div>
							<div class="row">
								<div class="col-sm-6 form-group">
									<label class='star'>* </label> <label>Provincia:</label>
									<select name='elencoProvince' required class="form-control">
												<option value="" selected>Scegli la provincia</option>
											<?php 		
													$comandoSQL = "select provincia from province";
													$result=mysqli_query($conn,$comandoSQL);
													
														
													  while	($row = mysqli_fetch_assoc($result) ){
														echo"<option id='$row[idProv]'>$row[provincia]</option>";
													}
											?>		
												</select> 
								</div>		
								<div class="col-sm-6 form-group">
									<label class='star'>* </label> <label>Telefono:</label>
									<input type="tel" pattern="[0-9]{1,15}" value='' name='telefono' required class="form-control" >
								</div>	
							</div>						
						<div class="col-sm-4 form-group">
							<label>Fax</label>
							<input type="tel" pattern="[0-9]{1,15}" value='' name='fax' class="form-control">
						</div>		
						<div class="col-sm-4 form-group">
							<label>Secondo telefono:</label>
							<input type="tel" pattern="[0-9]{1,15}" value='' name='telefono2' class="form-control">
						</div>	
						<div class="col-sm-4 form-group">
							<label>Cellulare:</label>
							<input type="tel" pattern="[0-9]{1,15}" value='' name='cell' class="form-control">
						</div>
						
						<div class="col-sm-6 form-group">
							<label class='star'>* </label> <label data-toggle="tooltip" title="Questo campo <?php  echo '&egrave '?> necessario per l'eventuale recupero o modifica delle credenziali.">Domanda di sicurezza:</label>
							<input type='text'  name='domanda'  required class="form-control">
						</div>
						<div class="col-sm-6 form-group">
							<label class='star'>* </label> <label>Risposta:</label>
							<input type='text' value='' name='risposta' required class="form-control">
						</div>						
						
						
						<div class="col-sm-6 form-group">
							<label class='star'>* </label> <label>Indirizzo email:</label>
							<input type='email' value='' name='email' placeholder="Inserisci la tua email... " required class="form-control">
						</div>
						<div class="col-sm-6 form-group">
							<label class='star'>* </label> <label>Password:</label>
							<input type='Password' value='' name='psw' required class="form-control">
						</div>
						<div class="form-group">
								<label>Prima della registrazione, leggi con attenzione l'informativa sul trattamento dei dati personali:</label>
									<textarea  readonly="readonly" class="form-control" style='overflow: scroll;'>
<?php echo "
Termini e condizioni di utilizzo

Informativa sul trattamento dei dati personali

I dati personali dell'utente saranno utilizzati dai titolari del trattamento nel rispetto dei principi di protezione della privacy stabiliti dal Decreto Legislativo n. 196 del 30 giugno 2003 e dalle altre norme vigenti in materia.

La presente informativa riguarda i dati personali inviati dall'Utente al momento della registrazione, nonch&egrave quelli ricavati dalle visite e navigazioni nel nostro sito e successivamente forniti dall'Utente per la attivazione dei servizi offerti all'interno del sito.

I titolari del trattamento sottopongono i dati personali degli Utenti a tutte le operazioni di trattamento individuate dal D. lgs 196/2003 - ovvero, alla raccolta, registrazione, organizzazione, conservazione, elaborazione, modifica, selezione, estrazione, raffronto, utilizzo, ed ogni altra operazione utile alla fornitura dei servizi richiestici, ivi compresa la comunicazione a terzi, ove necessaria - con modalit&agrave automatizzate ed informatizzate.

Tali dati potranno anche essere organizzati in banche dati o archivi. In particolare, le finalit&agrave del trattamento dei dati personali sono le seguenti:

svolgere i servizi e le attivit&agrave previsti;
verificare la qualit&agrave dei servizi offerti;
informare sulle funzionalit&agrave e i servizi offerti dal sito e fornire i servizi di informazione periodica (es. newsletter) esplicitamente richiesti;
inviare informazioni non periodiche in ordine alle iniziative ed alle attivit&agrave dei titolari dei dati
provvedere a tutti gli eventuali adempimenti contabili e fiscali;
risalire ad autori di eventuali illeciti solo in caso di specifiche richieste e per conto delle Autorit&agrave competenti.
Contitolari del trattamento dei dati personali forniti dall'utente, che saranno registrati su data base elettronici della Centro di Produzione S.p.A.. sono la Lista Bonino-Pannella, con sede in Roma, in via di Torre Argentina, 76 e Partito Radicale, con sede in Roma, via di Torre Argentina, 76. Responsabile del trattamento &egrave il l.r.p.t. del Partito Radicale al quale, tramite mail al seguente indirizzo unsubscribe@radicalparty.org o tramite richiesta scritta indirizzata al Partito Radicale, Via di Torre Argentina 76, Responsabile Trattamento Dati Internet, potr&agrave essere inoltrata richiesta per l'esercizio dei diritti di cui all'art. 7 D.lgs 196/2003.

I dati personali possono essere suddivisi in due categorie: obbligatori e facoltativi. I dati obbligatori sono contrassegnati. Il conferimento dei dati obbligatori ed il relativo trattamento per le finalit&afrave sopra indicate sono strettamente funzionali all'esecuzione dei servizi indicati. L'eventuale rifiuto dell'utente a fornire tali dati o l'eventuale rifiuto di consentire al loro trattamento comporter&agrave l'impossibilit&agrave di usufruire dei servizi offerti.

L'Utente potr&agrave accedere ai propri dati in qualsiasi momento ed esercitare i diritti di cui all'art. 7, D. lgs . 196/2003, che di seguito si riporta integralmente:

Art. 7 (Diritto di accesso ai dati personali ed altri diritti)

L'interessato ha diritto di ottenere la conferma dell'esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.
L'interessato ha diritto di ottenere l'indicazione:
dell'origine dei dati personali;
delle finalit&agrave e modalit&agrave del trattamento;
della logica applicata in caso di trattamento effettuato con l'ausilio di strumenti elettronici;
degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell'articolo 5, comma 2;
dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualit&agrave di rappresentante designato nel territorio dello Stato, di responsabili o incaricati.

L'interessato ha diritto di ottenere:
l'aggiornamento, la rettificazione ovvero, quando vi ha interesse, l'integrazione dei dati;
la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non &egrave necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;
l'attestazione che le operazioni di cui alle lettere a) e b) sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.

L'interessato ha diritto di opporsi, in tutto o in parte:
per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorche' pertinenti allo scopo della raccolta;
al trattamento di dati personali che lo riguardano a fini di invio di materiale informativo - pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazione commerciale.

L'utente, potr&agrave richiedere di integrare, modificare o cancellare i dati, in qualsiasi momento e sotto la propria responsabilit&agrave.
			" ?>
									</textarea>
							</div>
						<div>
							<label>Ho letto e accetto</label>
							<input type="checkbox" required >
						</div>	
						
						<input id='bottone' type='submit'  class='btn btn-primary' value='Registrati' name='registrati'/>					
						</div>
					</form> 
				</div>
			</div>
		</div>
		<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
	</body>
	</html>