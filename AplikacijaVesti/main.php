<?php  
	session_start();
	require "Klase/autoload.php";
	$_SESSION['role'] = "user";
	if($_SESSION['loggedin'] == false){
		header('location:index.php');
	}else{
		if (empty($_SESSION['image'])){
			$_SESSION['image'] = "slika.jpg";
		}
		$korisnik = new Korisnik($_SESSION['id'],$_SESSION['first_name'],$_SESSION['last_name'],$_SESSION['email'],$_SESSION['image']);
		
		
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>POCETNA | Srpske Vesti</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body class="main">
	

	<?php
		require "include/headermain.php";
		require "include/vestikomentari.php";
	?>
	<div class="footer <?=$klasa?>">
		<div class="container">
			<div class="row">	
				<p class="levo">Srpske Vesti | &copy; 2018</p>
				<p class="desno">Developed by: &lt;UzzI&gt;</p>
			</div>
		</div>
	</div>

</body>
</html>