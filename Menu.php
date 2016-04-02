<?php
session_start();
// controllo se è stato impostato l id per evitare che accedano direttamente senza fare il login
if( !isset($_SESSION['id']) )
	header("Location: LOGIN2.php");
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

// Ricavo tutte le informazioni sull azienda che mi interessa tramite l id
$sql = "SELECT * FROM azienda where id='".$_SESSION['id']."'";
$result = $conn->query($sql);
// tutti i dati son messi nelll array dati
$dati = $result->fetch_assoc();

// ho bisogno di sapere anche i valori che ci sono nella tabella categoria
$SQLcateg ="select categoria from categoria where idCat='$dati[idCat]'";
$result_cat = $conn->query($SQLcateg);
// tutti i valori saranno memorizzati in dati_cat
$dati_cat=$result_cat->fetch_assoc();

// ho bisogno di sapere tutte le informazioni riguardanti i telefoni
$SQLtel ="select * from telefoni where id='".$dati[idTel]."'";
$result_tel = $conn->query($SQLtel);
// tutti i valori saranno memorizzati nell array dati_tel
$dati_tel=$result_tel->fetch_assoc();
?>

<!-- sono classi predefinite, inverse vuol dire sfondo scuro
	quella di default è chiara -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
  
  <!-- questo è l header contiene gli elementi che devono essere visibili anche quando la barra è minimizzata per i display di piccole dimensioni -->
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

<?php 
// mi permette di mostrare dei messaggi di errore o di successo di modifica, si riferisce alla pagina emodifica.php 
if( isset($_GET['modifica']) ) // se modifica è settato entro nel if  e con uno switch distinguo i vari casi 
{
	echo "<p id='box_modifica'>";
	switch ($_GET['modifica'])
	{
	case 1:
		echo "<div class='alert alert-warning'>
    <strong>Success!</strong> Aggiornamento non riuscito!
  </div>";
		break;
		
	case 2:
		echo "<div class='alert alert-success'>
    <strong>Success!</strong> Aggiornamento riuscito!
  </div>";
		break;
		}
}
?>
  </div>
<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2><?php echo $dati[nome_azienda]?> <img src="immagini\nala.jpg" width="150" height="80"> </h2>
     <div class="container"> 
     		<a href="modificaW.php" class="btn btn-info" role="button">Modifica</a>
     		</div>
    </div>
    <br>
    <div class="col-sm-9">
      <div class="well">
        <h4>La nostra azienda</h4>
        <p><?php  echo $dati[parlaci]?> </p>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="well">
            <h4>Users</h4>
            <p> Utente fondatore <br/> Utente partecipante <br/> <?php echo $dati[persona_di_riferimento]?></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Sito:</h4>
            <p style="text-align:right"><?php echo $dati[sito_web]?> </p> 
            <h4> Email</h4>
            <p>  <p style="text-align:right"><?php echo $dati[email]?></p> </p>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Campo di interesse</h4>
			<?php  echo $dati_cat[categoria];?>
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col-sm-5">
          <div class="well">
          <h4> Citta </h4>
            <p><?php echo $dati[citta]?></p> 
            <h4>Cap</h4>
            <p><?php echo $dati[cap]?></p> 
            <h4>Indirizzo</h4>
            <p><?php echo $dati[indirizzo]?></p> 
          </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
          <h4> Idee</h4>
            <p>GreenCity</p> 
            <p>LoveAffair</p> 
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
          <h4>Telefono</h4> 
 <?php echo  "<p>".$dati_tel[numero]."</p>"; // ottengo i dati dall array dati_tel che è stato creato precedentemente, usando come chiavi i nomi delle colonne nel db
	 if( !($dati_tel[numero2]==0) ) // gli if mi permettono di non mostrare nulla nel caso questi campi non siano presnti nel db
		echo "<h4> Telefono 2 </h4> <p>".$dati_tel[numero2]."</p>";
	  if( !($dati_tel[fax]==0) )
		echo "<h4> Fax </h4> <p>".$dati_tel[fax]."</p>";
		if( !($dati_tel[cellulare]==0) )
		echo "<h4> Cellulare </h4> <p>".$dati_tel[cellulare]."</p>";
		
?>
        </div>
        </div>
        <div class="col-sm-4">
          <div class="well">
            <h4>Iva</h4> 
            <p><?php echo $dati[p_ivaOcf]?></p> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>