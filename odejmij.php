<?php 
session_start();
if(!isset($_SESSION['polaczony']))
{header('Location: index.php');
exit();
}
?>

<!DOCTYPE html> 
<html lang="pl"> 
<head>
	
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="description" content="Kolorowy świat alkoholi i innych dobrodziejstw"> 
	<title> Towar </title> 
	<link rel="stylesheet" href="style.css" />  
</head>

<body>
<ul>
  <li><a href="towar.php">Towar</a></li>
  <li><a href="sprzedaz.php">Sprzedaż</a></li>
  <li><a href="dostawa.php">Dostawa</a></li>
  <li><a href="dodaj.php">Nowy towar</a></li>
  <li><a href="odejmij.php">Usuń towar</a></li>
  <li><a href="historia.php">Historia</a></li>


</ul>

<?php
require_once "polacz.php";

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = $cnt->query("SELECT*FROM asortyment");
	

?>

<form action="odej.php" method="post" align="center">
  Nazwa: <select name="id">
	<?php 
		while ($wypisanie = $zapytanie->fetch_assoc()) {
		echo "<option value=". $wypisanie['Id'] .">". $wypisanie['Nazwa'] ."</option>";
			
		}

    $zapytanie->free();
  ?>
  </select>

  
  <input type="submit" value="Usuń">
<?php
  if(isset($_SESSION['usuniete'])){
    echo $_SESSION['usuniete'];
    unset($_SESSION['usuniete']);
  }

?>
</form>
</body>
</html>
