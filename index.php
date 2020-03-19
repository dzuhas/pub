<?php 
session_start();
if((isset($_SESSION['polaczony'])) && ($_SESSION['polaczony']==true))
{
	header('Location: towar.php');
	exit();
}
?>

<!DOCTYPE html> 
<html lang="pl"> 
<head>
	
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="description" content="Kolorowy świat alkoholi i innych dobrodziejstw"> 
	<title> Zaopatrzenie Pubu </title> 
	<link rel="stylesheet" href="style.css" />  
</head>
<body>

<header>
<h1 align="center" > Witaj Karczmarzu! </h1>
</header>
<main>
<form action="dolacz.php" method="post" align="center"> 
<font size="9" color="lime">Login:</font> <br /> <input type ="text" name="uzytkownik" /> <br/>
<font size="9" color="lime">Hasło:</font> <br/> <input type="password" name="haslo"/> <br/><br/> 
<input type="submit" value="Zaloguj się" />
</form>
<br></br> 
<?php
if(isset($_SESSION['blad'])) 
echo $_SESSION['blad'];
?>
</main>
</body>

</html>