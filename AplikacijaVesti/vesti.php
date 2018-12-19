<?php  
	require "Klase/autoload.php";
	session_start();

	if($_SESSION['role'] != 'admin'){
		header('location:index.php');
	}else{
		$conn	= Konekcija::get();
	}
	
	if (isset($_POST['add'])) {
		if(isset($_POST['naslov']) && isset($_POST['tekst']) && isset($_POST['kategorija'])){
			$naslov 	= $conn->escape_string($_POST['naslov']);
			$tekst 		= $conn->escape_string($_POST['tekst']);
			$kategorija = $_POST['kategorija'];
			if (isset($_FILES['slika']) && !empty($_FILES['slika']['name'])) {
				$ime = $_FILES['slika']['name'];
				$dozvoljeneEkstenzije = ['jpg','jpeg','png'];
				$ekstenzija = explode('.', $ime);
				$velicina  	= $_FILES['slika']['size'];	
				
				if(in_array($ekstenzija[1], $dozvoljeneEkstenzije) && $velicina < 500000){	
					move_uploaded_file($_FILES['slika']['tmp_name'],'img/vesti/'.$_FILES['slika']['name']);
					$slika 	= $_FILES['slika']['name'];
				}else{
					$slika = "slika.jpg";
				}	
			}else{
				$slika 	= "slika.jpg";
			}
			// Pravljenje upita
			$result 	= $conn->query("INSERT INTO vesti VALUES(null,'{$slika}','{$naslov}','{$kategorija}','{$tekst}',NOW())");
			if($result){
				$message = "Vest je uspesno dodata";
			}
		}
	}
	$selected_id 		 = -1;
	$selected_naslov 	 = "";
	$selected_tekst 	 = "";
	$selected_kategorija = 0;

	if(isset($_GET['vid']) && is_numeric($_GET['vid']) && $_GET['vid'] != 0){
        $result 	= $conn->query("SELECT * FROM vesti WHERE id = {$_GET['vid']}");
        if($row = $result->fetch_object()){
        	$selected_id 	  		= $row->id;
        	$selected_naslov		= $row->naslov;  
        	$selected_tekst			= $row->tekst;
        	$selected_kategorija 	= $row->kategorija;
        }
    }

    if(isset($_POST['delete'])){
    	if(isset($selected_id)){
    		$result 	= $conn->query("DELETE FROM vesti WHERE id = {$selected_id}");
    		if($result){
    			$message = "Vest je uspesno obrisana";
    		}
    	}
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Adding News</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>
<body class="login main">
	<?php
		require "include/headeradmin.php";
	?>
	<h2>Dodaj/Izbrisi Vest</h2>
	<form method="POST" action="#" enctype="multipart/form-data">
		<select name="vesti" onchange ="window.location='?vid='+this.value">
			<option value="-1">Izaberi vest</option>
			<?php
				$result = $conn->query("SELECT * FROM vesti");
				while($row = $result->fetch_object()){
					echo "<option " . ($selected_id==$row->id?"selected":"")  . " value ='{$row->id}'><b>{$row->naslov}</b></option>";
				} 
			?>
		</select> <br>
		<input type="text" name="naslov" placeholder="News Heading" value="<?=($selected_naslov)?>"><br>
		<textarea class="text" name="tekst" placeholder="News Text" ><?=($selected_tekst)?></textarea>
		<select name="kategorija">
			<option value="-1">Izaberi Kategoriju</option>
			<?php 
				
				$result = $conn->query("SELECT * FROM kategorije");
				while($row = $result->fetch_object()){
					echo "<option " . ($selected_kategorija==$row->id?"selected":"")  . " value ='{$row->id}'><b>{$row->ime}</b></option>";
				} 
			?>
		</select> <br>
		<input type="file" name="slika"> <br>
		<input type="submit" name="add" value="Dodaj Vest" class="submit">
		<input type="submit" name="delete" value ="Izbrisi Vest" class="submit">
	</form>

	<p><?=($message)??""?></p>
</body>
</html>