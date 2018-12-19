<?php  
	require "Klase/autoload.php";
	if(isset($_POST['login'])){
		if(!empty($_POST['username'])&& !empty($_POST['password'])){
			$conn 		= Konekcija::get();
			$username 	= test_input($_POST['username']);
			$password 	= test_input($_POST['password']);
			$query 		= "SELECT * FROM admin WHERE username = '{$username}'";
			$result 	= $conn->query($query);
			if(!($result->num_rows >0)){
				$message = "Username doesn't exist";
			}else{
				$row 	= $result->fetch_object();
				if($password==$row->password){
					session_start();
					$_SESSION['role'] 	= "admin";
					header('location:mainadmin.php');
				}else{
					$message = "Wrong password";
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
	<title>Admin stranica</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
	<script src="include/function.js"></script>

</head>
<body class="login">
	<?php
		require "include/header.php"
	?>
	<a href="index.php" class="admin">&larr;Go back to login</a>
	<form method="POST" action="#">
		<input type="text" name="username" placeholder="Admin Username"><br>
		<input type="password" name="password" placeholder="Admin Password" id="password"><br>
		<input type="checkbox" onclick="prikaziSifru()"> Show Password <br>
		<input type="submit" name="login" class="submit">
	</form>
	<?=($message)??""?>
</body>
</html>