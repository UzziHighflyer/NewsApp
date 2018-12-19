<?php  
	function autoload($klasa){
		require_once("Klase/{$klasa}.php");
	}
	spl_autoload_register("autoload");

?>