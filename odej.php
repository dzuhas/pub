<?php
session_start();

if(!isset($_SESSION['polaczony']))
{header('Location: index.php');
exit();
}
 
if(isset($_SESSION['jest']))  
echo $_SESSION['jest'];
if(isset($_SESSION['nimo']))  
echo $_SESSION['nimo'];

require_once "polacz.php";
echo "<p>Witaj " .$_SESSION['uzytkownik'].'! <a href="logout.php"> Wyloguj się</a></p>';

$id = $_POST['id'];

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');
$zapytanie = $cnt->query("DELETE FROM asortyment WHERE id = '$id'");
$_SESSION['usuniete'] = "Udało się usunąć";
header('Location: odejmij.php');


?>

