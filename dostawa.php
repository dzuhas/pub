<?php 
session_start();
if(!isset($_SESSION['polaczony']))
{header('Location: index.php');
exit();}
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
<table>
	<thead>
		<tr>
			<td>Nazwa:</td>
			<td>Ilość:</td>
			<td>Kategoria:</td>
			<td>Dostawa:</td>
		</tr>
	</thead>
	<tbody>
	<form action="dos.php" method="post" align="center">
<?php
require_once "polacz.php";
echo "Witaj " .$_SESSION['uzytkownik']."ie".'! <a href="logout.php"> Wyloguj się</a>';

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');

$zapytanie = $cnt->query("SELECT*FROM Asortyment");
while ($wynik = $zapytanie->fetch_assoc()) {
	echo "<tr><td>".$wynik["Nazwa"]."</td><td>".$wynik["Ilosc"]."</td><td>".$wynik["Kategoria"]."</td><td><input type='number' name='" . $wynik["Nazwa"] . "'></td></tr>";
}
$zapytanie->free();

?>
<div style="padding: 30px 0;">

<button type="submit">Zapisz</button>
</div>
</form>
</tbody>
</table>
</body>

</html>