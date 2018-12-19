<?php  
	require "Klase/autoload.php";
	session_start();

	$conn 	= Konekcija::get();
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
	<title> Vesti | Srpske Vesti</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body class="main">
	<?php 
		require "include/headermain.php";
	?>	
	<h1 style="text-align: center;margin:20px">Profil korisnika: <?=$korisnik->fname . ' ' . $korisnik->lname?></h1>
	<div class="container">
		<div class="row">	
			<div class="profil">
				<div class="cover">
					<img src="img/korisnici/<?=$korisnik->image?>" class="slika">
				</div>
				<div class="podaci">
					<h2>Osnovni podaci</h2>
					<p>IME:<b> <?=$korisnik->fname?></b></p>
					<p>PREZIME:<b> <?=$korisnik->lname?></b></p>
					<p>EMAIL:<b> <?=$korisnik->email?></b></p>
				</div>
				<div class="komentari">
					<h2>Komentari</h2>
					<?php
						$klasa  = "stiki";
						$result = $conn->query("SELECT * FROM komentar WHERE korisnik_id = {$korisnik->id}");
						if($result->num_rows > 0){
							if($result->num_rows<2){
								$klasa = "stiki";
							}else{
								$klasa = "";
							}
							?>
							<p> Komentari (<?=$result->num_rows?>)</p>
						<?php
							while($row = $result->fetch_object()){
							?>	
								<div class="komentar" style="margin:20px 10px">
									<p><?=$row->sadrzaj?> </p>	
									<small><?=$row->datum?></small>
									<?php if (($row->korisnik == $korisnik->fname . ' ' . $korisnik->lname && $row->korisnik_id == $korisnik->id) || $_SESSION['role'] == 'admin'): ?>
										<p><a href="remove.php?id=<?=$row->id?>" style="color:black"><i class="fas fa-times s" style="float:right;position:relative;bottom:40px;color:#341f97;"></i></a></p>
									<?php endif ?>
								</div><?php
							}
						}
					?>

				</div>
			</div>
		</div>
	</div>
	
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