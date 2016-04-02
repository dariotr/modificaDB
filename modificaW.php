<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 100%}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>
<?php
$nl="<br/>";
include_once 'configurazioneDB.php';
// ricavo tutte le informazioni che mi servono sull azienda tramite l id che p una variabile di sessione
$comando= "select * from azienda where id='$_SESSION[id]' ";
$result = $conn->query($comando);
$dati = $result->fetch_assoc();

//ricavo attraverso l idCat il nome della categoria della mia azienda
$SQLcateg ="select categoria from categoria where idCat='".$dati[idCat]."'";
$result_cat = $conn->query($SQLcateg);
$dati_cat=$result_cat->fetch_assoc();
// il nome sarˆ memorizzato nella variabile categoria
$categoria=$dati_cat[categoria];

// questa  un altra query che mi serve per pooi avere tutta la lista di categorie
$comandoSQL ="select categoria from categoria";
		$result=mysqli_query($conn,$comandoSQL); 
		
// ricavo le informazioni sui telefoni della mia azienda tramite idTel ottenuto con la prima query
$SQLtel ="select * from telefoni where id='".$dati[idTel]."'";
$result_tel = $conn->query($SQLtel);
$dati_tel=$result_tel->fetch_assoc();
?>
<!-- sono classi predefinite, inverse vuol dire sfondo scuro
	quella di default  chiara -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
  <!-- questo  l header contiene gli elementi che devono essere visibili anche quando la barra  minimizzata per i display di piccole dimensioni -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
           <span class="icon-bar"></span>
        <span class="icon-bar"></span>   
        <!-- Ciascuno di questi disegna una lineetta sul pulsante quando si minimizza la pagina -->                     
      </button>
      <a class="navbar-brand">Borsa delle Idee</a>
    </div>
 <!--  elementi della barra -->
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Menu.php">Home</a></li>
        <li><a href="#">About</a></li>
         <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Idee <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Crea</a></li>
          <li><a href="#">Cerca</a></li>
        </ul>
      </li>
        <li><a href="#">Contatti</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">

    <br>
    <div class="col-sm-offset-2 col-sm-8">
      <div class="well well-lg">
        <h4>Modifica i tuoi dati</h4>
           <!-- Questo  un form con tutti i dati che sarˆ possibile modificare, utilizzeremo il metodo post -->
      	 <form  method="post" name="registra" action="emodifica.php" id="registra">
	<table width="300" >
			<tr>
				<td> Categoria</td> <td> <select class="form-control"  name='elencoCategorie' >
												<option  value="<?php  echo $categoria ?>" selected><?php  echo $dati_cat[categoria];?> </option>
											<?php 			
													while	($row = mysqli_fetch_assoc($result) ){
														echo"<option id='$row[idCat]'>$row[categoria]</option>";
													}
											?>		
												</select> </td>
			</tr>	
			<tr>
				<td> Email</td> <td> <input type="text" id="email" name="email" value='<?php echo $dati["email"]; ?>'> </td>
			</tr>	
				<tr>
				<td> Cap</td> <td> <input type="text" id="cap" name="cap" value='<?php echo $dati["cap"]; ?>'> </td>
			</tr>	
				<tr>
				<td> Indirizzo</td> <td> <input type="text" id="indirizzo" name="indirizzo" value='<?php echo $dati["indirizzo"]; ?>'> </td>
			</tr>		
			<tr>
				<td> Citta</td> <td><input type="text" id="citta" name="citta" value='<?php echo $dati["citta"]; ?>' > </td>
			</tr>		
			<tr>
				<td> Iva o codice fiscale</td> <td> <input type="text" id="p_ivaOcf" name="p_ivaOcf" value='<?php echo $dati["p_ivaOcf"]; ?>'> </td>
			</tr>
			<tr>
				<td> Sito</td> <td><input type="text" id="sito_web" name="sito_web" value='<?php echo $dati["sito_web"]; ?>' > </td>
			</tr>
			<tr>
				<td> Telefono</td> <td><input type="text" id="numero" name="numero" value='<?php echo $dati_tel["numero"]; ?>' > </td>
			</tr>
			<tr>
				<td> Telefono 2</td> <td><input type="text" id="numero2" name="numero2" value='<?php echo $dati_tel["numero2"]; ?>' > </td>
			</tr>
			<tr>
				<td> Fax</td> <td><input type="text" id="fax" name="fax" value='<?php echo $dati_tel["fax"]; ?>' > </td>
			</tr>
			<tr>
				<td>Cellulare</td> <td><input type="text" id="cellulare" name="cellulare" value='<?php echo $dati_tel["cellulare"]; ?>' > </td>
			</tr>
			<tr> 
				<td> Maggiori dettagli </td> <td> <input type="longtext" name="parlaci" value='<?php echo $dati["parlaci"]; ?>' > </td>
	     	<tr>
			<td height="100"><input id="aggiorna" value="AGGIORNA" type="submit" name="aggiorna"></td>
	    	</tr>
	</table>
</form>

<?php 

// se emodifica.php mi da qualche errore, compariranno dei messaggi di avvertimento, con lo switch gestisco i var casi
if( isset($_GET['errore']) )
{
	echo "<p id='box_errore'> <div class='alert alert-danger'>
    <strong>Attenzione!</strong> ";
	switch ($_GET['errore'])
	{
	case 1:
		echo "Numero di telefono/cellulare o fax non valido";
		break;
		
	case 2:
		echo "Mail non valida";
		break;
		}
		echo "</div>";
}
?> 
  </div>
<br/> <p style="text-align: right"><a href='Menu.php'><button> Indietro </button></a></p>
  </div>
</div>

</body>
</html>

</body>
</html>

