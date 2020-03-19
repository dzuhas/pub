<?php
session_start(); 


require_once "polacz.php"; 
$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy); 
$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');
if($cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy)) {
	if ($cnt->connect_errno!=0)
{
	echo "Dzis prochibicja - Error: ".$cnt->connect_errno;    
}
else
{
$Nazwa=$_POST['Nazwa'];
$Ilosc=$_POST['Ilosc'];
$Kategoria=$_POST['Kategoria'];
$eskuel= "INSERT INTO `asortyment` (`Nazwa`, `Ilosc`, `Kategoria`) VALUES ('$Nazwa', '$Ilosc', '$Kategoria')";
}
if ($wynik=$cnt->query($eskuel)) 
{
    unset($_SESSION['nimo']);

    $_SESSION['jest']='<span style="color:red">Udało się!</span>'; 

    header('Location: towar.php');
}
else{
    unset($_SESSION['jest']);

    $_SESSION['nimo']='<span style="color:red">Błąd!</span>'; 
    header('Location: towar.php');
}
$cnt->close();
}


?>

