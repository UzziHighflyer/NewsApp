<?php
		$conn 	= Konekcija::get();
		if(isset($_GET['cat']) && is_numeric($_GET['cat'])){
			$kategorija = ' WHERE kategorija =' . $_GET['cat'] . ' ';
			if($_GET['cat'] == 0){
				$kategorija = "";
			}
		}else{
			$kategorija = "";
		}
		$result = $conn->query("SELECT * FROM vesti {$kategorija}  ORDER BY id DESC");
		$klasa = "";
		if($result->num_rows<2){
			$klasa = "stiki";
		}
		require "include/vest.php";
	?>

	<?php
		$rezultat = $conn->query("SELECT * FROM kategorije")
	?>
	<div class="kategorije">
		<h2>Kategorije</h2>
			<ul>
				<li><a href="?cat=0">SVE KATEGORIJE</a></li> 
				<?php
					if($rezultat){
						while($row = $rezultat->fetch_object()){
							?>
								<li><a href="?cat=<?=$row->id?>"><?=$row->ime?></a></li>
							<?php
						}
					}
				?>
			</ul>
	</div>