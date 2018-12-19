<?php  
	require "Klase/autoload.php";
	
	if(isset($_POST['register'])){
		if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
			$conn 		= Konekcija::get();
			// Priprema varijabli za unos
			$fname 		= test_input($_POST['fname']);
			$lname 		= test_input($_POST['lname']);
			$email 		= test_input($_POST['email']);
			$password  	= test_input(password_hash($_POST['password'],PASSWORD_BCRYPT));
		
			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
				$ime = $_FILES['image']['name'];
				$dozvoljeneEkstenzije = ['jpg','jpeg','png'];
				$ekstenzija = explode('.', $ime);
				$velicina  	= $_FILES['image']['size'];

				if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){
					move_uploaded_file($_FILES['image']['tmp_name'],'img/korisnici/'.$_FILES['image']['name']);
					$image 	= $_FILES['image']['name'];
				}else{
					$image = "slika.jpg";
				}	
			}else{
				$image 	= "slika.jpg";
			}
			
			// Provera da li postoji vec korisnik sa istim mailom
			$upit 		= "SELECT * FROM korisnik WHERE email = '{$email}'";
			$result 	= $conn->query($upit);
			if($result->num_rows > 0){
				unset($_POST['email']);
				?>
					<script>alert('Korisnik sa ovim emailom vec postoji.');</script>
				<?php
				
			}else{
				// Definicija upita
				$upit 		= "INSERT INTO korisnik VALUES(null,'{$fname}','{$lname}','{$email}','{$password}','{$image}')";
				$result 	= $conn->query($upit);
				if($result){
					?>
						<script>
							alert('Uspesno ste se registrovali');
						</script>
					<?php
					header('Refresh:0; url=index.php',true,303 );
				}else{
					?>
						<script>alert('Neuspesno ste se registrovali');</script>
					<?php
				}
			}	
		}
	}

	function test_input($data){
		$data 	= trim($data);
		$data 	= stripslashes($data);
		$data 	= htmlentities($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registruj se</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<script src="include/function.js"></script>
</head>
<body class="login">
	<?php
		require "include/header.php";
	?>
	
	<form method = "POST" action = "#" enctype="multipart/form-data">
		<input type="text" name="fname" placeholder="Firstname"><br>
		<input type="text" name="lname" placeholder="Lastname"><br>
		<input type="email" name="email" placeholder = "Email"><br>
		<input type="password" name="password" placeholder = "Password" id="password"><br>
		<input type="checkbox" onclick="prikaziSifru()"> Show Password <br>
		<input type="file" name="image" class="inputfile" id="file"> <br>
		<input type="submit" name="register" value="Register" class="submit"> 
	</form>

	<a href="index.php" class="link">Vec imas profil? Uloguj se.</a> <br>
	<?=($message)??''?>
</body>
</html>