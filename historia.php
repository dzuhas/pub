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
<form action="historia.php" method="post" align="center">
	<input type="date" name="data">
	<button type="submit">Pobierz</button>
</form>
<br>

<?php

require_once "polacz.php";
echo "Witaj " .$_SESSION['uzytkownik']."ie".'! <a href="logout.php"> Wyloguj się</a>';

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');
$data = '';

if($_POST && $_POST['data']){
	$data = $_POST['data'];
}

?>
<div class="table-wrapper">
<div class="half-page-table"><h3>Sprzedane</h3>

<table>
	<thead>
		<tr>
			<td>Nazwa</td>
			<td>Ilość</td>
			<td>Data</td>
			<td>Kto</td>
		</tr>
	</thead>
	<tbody>
<?php

if($data) {
	$zapytanie = $cnt->query("SELECT*FROM sprzedane WHERE data='$data'");
} else {
	$zapytanie = $cnt->query("SELECT*FROM sprzedane");
}

while ($wynik = $zapytanie->fetch_assoc()) {

	echo "<tr><td>".$wynik['nazwa']."</td><td>".$wynik['ilosc']."</td><td>".$wynik['data']."</td><td>".$wynik['uzytkownik']."</td></tr>";
}
$zapytanie->free();
?>
</tbody>
</table>
</body>
</div>

<div class="half-page-table"><h3>Dostawa</h3>
<table>
	<thead>
		<tr>
			<td>Nazwa</td>
			<td>Ilość</td>
			<td>Data</td>
			<td>Kto</td>
		</tr>
	</thead>
	<tbody>
<?php
if($data) {
	$zapytanie2 = $cnt->query("SELECT*FROM dostawa WHERE data='$data'");
} else {
	$zapytanie2 = $cnt->query("SELECT*FROM dostawa");
}

while ($wynik2 = $zapytanie2->fetch_assoc()) {

	echo "<tr><td>".$wynik2['nazwa']."</td><td>".$wynik2['ilosc']."</td><td>".$wynik2['data']."</td><td>".$wynik2['uzytkownik']."</td></tr>";
}
$zapytanie2->free();

?>

</tbody>
</table>
</div>
</div>
</body>



</html>
