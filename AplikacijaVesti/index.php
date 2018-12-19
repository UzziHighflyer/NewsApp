<?php  
	require "Klase/autoload.php";
	session_start();
	session_destroy(); 
	if(isset($_POST['login'])){
		if (!empty($_POST['email']) && !empty($_POST['password'])){
			$conn 		= Konekcija::get();
			// Priprema varijabli za porednjenje
			$email 		= test_input($_POST['email']);
			$result 	= $conn->query("SELECT * FROM korisnik WHERE email = '{$email}'");
			if($result->num_rows == 0){
				$message 	= "User with that email doesn't exist";
			}else{
				$user 		= $result->fetch_object();
				if(password_verify($_POST['password'],$user->password)){
					session_start();
					$_SESSION['id']			= $user->id;
					$_SESSION['email'] 		= $user->email;
					$_SESSION['first_name'] = $user->fname;
					$_SESSION['last_name'] 	= $user->lname;
					$_SESSION['image']		= $user->image;
					$_SESSION['loggedin']	= true;
					header('location:main.php');
 					$message 	= "You have logged in successfully";
 				}else{
 					session_start();
 					$message 	= "Wrong password";
 					$_SESSION['loggedin'] 	= false;
 				}
 				print_r($_SESSION);
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
	<title>Welcome to News Portal</title>
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
	<form method = "POST" action = "#">
		<input type="email" name="email" placeholder="Email"><br>
		<input type="password" name="password" placeholder="Password" id="password"><br>
		<input type="checkbox" onclick="prikaziSifru()"> Show Password <br>
		<input type="submit" name="login" value="Log In" class="submit">
	</form>
	<a href="register.php" class="link">Nemas profil? Registruj se.</a> <br>
	<p><?=($message)??""?></p>

</body>
</html>