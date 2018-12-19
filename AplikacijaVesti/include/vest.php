<?php  
	if ($result) {
		while($row = $result->fetch_object()){
		?>	<div class="vesti">
				<div class="container">
					<div class="row">
						<div class="image">
							<img src="img/vesti/<?=$row->slika?>" alt="<?=$row->naslov?>">
								<?php	if($_SESSION['role'] == 'admin') {
								?>			<h1><span><a href="vestzasebnoadmin.php?v=<?=$row->id?>"><?=$row->naslov?></a></span></h1>
								<?php	}else{
								?>			<h1><span><a href="vestzasebno.php?v=<?=$row->id?>"><?=$row->naslov?></a></span></h1>
								<?php	} ?>
						</div>
						<small>added on: <?=$row->datum?></small>
						<p><?=$row->tekst?></p>	
					</div>
				</div>
			</div>
		<?php	
		}
	}
	
?>