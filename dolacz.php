<?php
session_start(); 

if((!isset($_POST['uzytkownik']))||(!isset($_POST['haslo']))) 
{
	header('Location: index.php');
	exit();
}

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
$uzytkownik=$_POST['uzytkownik'];
$haslo=$_POST['haslo'];
$eskuel="SELECT * FROM logowanie WHERE login='$uzytkownik' AND haslo='$haslo'"; 

if ($wynik=$cnt->query($eskuel)) 
{
	$ilu_userow=$wynik->num_rows; 
	if($ilu_userow>0)
	{
		$_SESSION['polaczony']=true; 
		$wiersz=$wynik->fetch_assoc();
		$_SESSION['uzytkownik']=$wiersz['uzytkownik'];
		unset($_SESION['blad']);
		$wynik->free();	
	
		header('Location: towar.php'); 
	} else {
		$_SESSION['blad']='<span style="color:red">Czyżby dziś prohibicja?! Nieprawidłowy login lub hasło!</span>'; 
		header('Location: index.php'); 
	}
}
$cnt->close();
}
}

?>