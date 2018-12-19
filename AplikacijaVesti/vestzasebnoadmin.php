<?php  
	require "Klase/autoload.php";
	session_start();
	$conn 	= Konekcija::get();
	if($_SESSION['role'] != 'admin'){
		header('location:index.php');
	}else{
		$_SESSION['image'] = 'slika.jpg';
	
		$korisnik = new Korisnik("","","","","");
		if(!isset($_GET['v'])){
			$_GET['v'] = 0;
		}
	}
	if(isset($_POST['submit'])){
		if(isset($_POST['komentar']) && !empty($_POST['komentar'])){
			$vest 			= $_GET['v'];
			$user 	 		= "Admin";
			$sadrzaj 		= $_POST['komentar'];
			$slika 			= $_SESSION['image'];
			$korisnik_id 	= 0; 
			// UPIT
			$rezultat 	= $conn->query("INSERT INTO komentar VALUES(null,{$vest},'{$user}',{$korisnik_id},'{$slika}','{$sadrzaj}',NOW())");
			if($rezultat){
				$message = "Bravooo maco";
			}
			header("location:vestzasebnoadmin.php?v={$_GET['v']}");
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Vesti | Srpske Vesti</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="main">
	
	
	<?php
	require "include/headeradmin.php";

	$vest 		= $_GET['v'];
	$result  	= $conn->query("SELECT * FROM vesti WHERE id = $vest");
	require "include/vest.php";
	?>
	<div class="container">
		<form method = "POST" action = "#">
			<textarea width="300px" name="komentar" placeholder="Comment as Admin"></textarea><br>
			<input type="submit" name="submit" value="Comment" class="submit1">
		</form>
	</div>

	<?php 
		require "include/vestzaseb.php";
		include "include/footer.php";		
	?>
</body>
</html>