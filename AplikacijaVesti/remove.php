<?php  
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		require "Klase/autoload.php";
		session_start();
		$id 		= $_GET['id'];
		$conn 		= Konekcija::get();
		$result 	= $conn->query("DELETE FROM komentar WHERE id = {$id}");
		if($result){
			if($_SESSION['role']=='admin'){
				header("location:vestzasebnoadmin.php?v={$_SESSION['vest']}");
			}else{
				header("location:vestzasebno.php?v={$_SESSION['vest']}");
			}
		} 
	}else{
		header("location:main.php");
	}

?>