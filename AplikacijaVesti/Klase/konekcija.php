<?php 
	class Konekcija {
		private static $konekcija;
		public static function get(){
			if(!self::$konekcija){
				self::$konekcija = new Mysqli("localhost","root","","korisnici");
			}
			return self::$konekcija;
		}
	}


?>