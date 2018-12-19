<?php  
	class Korisnik{
		public $id;
		public $fname;
		public $lname;
		public $email;
		public $image;
		public function __construct($id,$fname,$lname,$email,$image){
			$this->id  		= $id;
			$this->fname  	= $fname;
			$this->lname 	= $lname;
			$this->email 	= $email;
			$this->image 	= $image;
		}
		
	}
?>