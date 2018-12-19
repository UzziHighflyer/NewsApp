<?php  
	session_start();
	require "Klase/autoload.php";
	if($_SESSION['role'] != 'admin'){
		header('location:index.php');
	}else{

	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>POCETNA | Srpske Vesti</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="main">
	<?php
		require "include/headeradmin.php";
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