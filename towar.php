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
	<link rel="stylesheet" href="style.css">  
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
if(isset($_SESSION['jest']))  
echo $_SESSION['jest'];
if(isset($_SESSION['nimo']))  
echo $_SESSION['nimo'];
?>
<table>
	<thead>
		<tr>
		
			<td>Nazwa:</td>
			<td>Ilość:</td>
			<td>Kategoria:</td>
		</tr>
	</thead>
	<tbody>
<?php
require_once "polacz.php";
echo "Witaj " .$_SESSION['uzytkownik']."ie".'! <a href="logout.php"> Wyloguj się</a>';

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = $cnt->query("SELECT*FROM Asortyment");
while ($wypisanie = $zapytanie->fetch_assoc()) {
   
	echo "<tr><td>".$wypisanie["Nazwa"]."</td><td class='ilosc'>".$wypisanie["Ilosc"]."</td><td>".$wypisanie["Kategoria"]."</td></tr>";
}
$zapytanie->free();

?>

</tbody>
</table>
<script>
	document.querySelectorAll('.ilosc').forEach(function(el, ind){
		var ilosc = el.textContent;
		if(ilosc == "0"){
			el.style.color = "red";
		}
	})
</script>
</body>

</html>