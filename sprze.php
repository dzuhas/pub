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

$cnt = new mysqli($serwer, $kto, $haslo_do_bazy, $nazwabazy);

$cnt -> query ('SET NAMES utf8'); $cnt -> query ('SET CHARACTER_SET utf8_unicode_ci');


foreach ($_POST as $key => $value)
{
if ($value){
	if (!($stmt = $cnt->prepare("INSERT INTO sprzedane (nazwa, ilosc, data, uzytkownik) VALUES (?, ?, CURRENT_DATE(), ?)"))) {
		echo "Błąd: (" . $cnt->errno . ") " . $cnt->error;
	} else {
		if (!$stmt->bind_param("sss", $key, $value, $_SESSION['uzytkownik'])) {
			echo "Błąd: (" . $stmt->errno . ") " . $stmt->error;
		} else {
			if (!$stmt->execute()) {
				echo "Błąd: (" . $stmt->errno . ") " . $stmt->error;
			}
		}
	}

	$nowaIlosc;
	if (!($stmt2 = $cnt->prepare("SELECT `Ilosc` FROM `asortyment` WHERE Nazwa = ?"))) {
		echo "Błąd: (" . $cnt->errno . ") " . $cnt->error;
	} else {
		if (!$stmt2->bind_param("s", $key)) {
			echo "Błąd: (" . $stmt2->errno . ") " . $stmt2->error;
		}
		if (!$stmt2->execute()) {
			echo "Błąd: (" . $stmt2->errno . ") " . $stmt2->error;
		} else {
			$aktualnaIlosc;
			$stmt2->bind_result($aktualnaIlosc);
			while ($stmt2->fetch()) {

				$nowaIlosc = $aktualnaIlosc - $value;
				

			}
		}
		
	}

	if (!($stmt3 = $cnt->prepare("UPDATE asortyment SET Ilosc=? WHERE Nazwa=?"))) {
		echo "Błąd: (" . $cnt->errno . ") " . $cnt->error;
	} else {
		if (!$stmt3->bind_param("is", $nowaIlosc, $key)) {
			echo "Błąd: (" . $stmt2->errno . ") " . $stmt2->error;
		} else {
			if (!$stmt3->execute()) {
				echo "Błąd: (" . $stmt2->errno . ") " . $stmt2->error;
			}  else{
				header('Location: towar.php');
			}
		}
	}
	
	
	

}
}

?>

