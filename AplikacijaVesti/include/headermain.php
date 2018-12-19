<div class="upperheader">
		<div class="container">
			<div class="row">
				<div class="levo">
					<i class="fas fa-envelope"></i>
					sprskevesti@gmail.com
				</div>
				<div class="desno">
					<a href="#"><i class="fab fa-instagram inst"></i></a>
					<a href="#"><i class="fab fa-facebook-square fac"></i></a>
					<a href="#"><i class="fab fa-twitter-square twi"></i></a>
				</div>
			</div>
		</div>
	</div>
	<header>
		<div class="container">
			<div class="row">
				<h1><a href="main.php">Srpske Vesti</a></h1>
				<div class="nav">	
					<ul>	
						<li><a href="profil.php"><?=$korisnik->fname . " " . $korisnik->lname?></a></li>
						<li><a href="profil.php"><img src="img/korisnici/<?=$korisnik->image?>" alt="<?=$korisnik->fname . " " . $korisnik->lname?>"></a></li>
						<li><a href="verifikacije/logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>	
	</header>