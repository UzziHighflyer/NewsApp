<?php	
	$_SESSION['vest'] = $_GET['v'];
	$result = $conn->query("SELECT * FROM komentar WHERE vest = {$_GET['v']} ORDER BY id DESC");
		if($result->num_rows > 0){
			?>
			<div class="container">
				<p>Comments (<?=$result->num_rows?>)</p>
			</div>
			<?php
			while ($row = $result->fetch_object()){
			?>
			<div class="container">
				<div class="row">
					<img src="img/korisnici/<?=$row->korisnik_slika?>" style="width:33px;height:33px;border-radius:50%"> <span class="ime"><?=$row->korisnik?></span> 
						<div class="komentar">
							<p><?=$row->sadrzaj?></p>
							<small><?=$row->datum?></small>
							<?php if (($row->korisnik == $korisnik->fname . ' ' . $korisnik->lname && $row->korisnik_id == $korisnik->id) || $_SESSION['role'] == 'admin'): ?>
								<p><a href="remove.php?id=<?=$row->id?>" style="color:black"><i class="fas fa-times s" style="float:right;position:relative;bottom:40px;color:#341f97;"></i></a></p>
							<?php endif ?>
						</div>
				</div>
			</div>			
			<?php
			}
		}


