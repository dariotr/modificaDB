<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title> 
</head>
<body>
<ul>
	<li> <a href="htmlProva.html"> Prima pagina</a></li>
	<li> <a href="Pagina2.html"> Seconda Pagina</a></li>
	<li> <a href="Bottoni.html"> Bottoni</a> </li>
	<li style="float:right"> <a class="active" href="#about"> About</a></li>
</ul>
<div>
<form style= padding:2px; width:30%" name="login" action="eloginW.php" method="POST">
	<table width="25px" cellpadding="10">
		<tr>
			<td>Email:</td> 
			<td> <input type="email" name="email" /> </td>
		</tr>
		<tr>
			<td> Password:</td>
			<td> <input type="password" name="password"/> </td>
		</tr>
		<tr>
			<td> Nome:</td>
			<td> <input type="text" name="user"/> </td>
		</tr>

		</table>
		Secure Login <input type=radio value="login" name="secure" /> <br/>
		Secure FTP <input type="radio" value="ftp" name="secure" /> <br/>
		Secure upload <input type="radio" value="upload" name="secure" /> </br>
		Secure voip <input type="radio" value="voip" name="secure" /> </br>
<input type="submit"/> <input type="reset" value="Annulla"/>
</form>
</div>

<select id="anno" name="anno">
<?php
$annoInizio=1940; $annoDefault=1995; $annoFine= getdate()['year'];
while ($annoInizio<=$annoFine)
	{
	echo "<option value='$annoInizio'";
	if($annoInizio==$annoDefault)
	echo "selected";
	echo ">$annoInizio </option>\n";
	$annoInizio++;
}
?>
</select>

<?php
	$elencoJPG = glob("immagini/*.jpg");
	echo"<table>\n";
	for($immagini=0;$immagini<count($elencoJPG); )
		{
		echo"<tr>\n";
		for($suQuestaRiga=0;
			$suQuestaRiga<2 && $immagini<count($elencoJPG); 
			$immagini++,$suQuestaRiga++)
			echo "<td> <img id='$immagini' src='$elencoJPG[$immagini]'
				onmouseover='zoom(this,200);'
				onmouseout='zoom(this,100)'/> </td>";
			echo "</tr>\n";
		}
	echo "</table>\n";
?>

<script type="text/javascript">
	function zoom(chi, quanto){
		chi.style.width=quanto+"px";
		chi.style.height=quanto+"px";
	}
</script>
</body>
</html>