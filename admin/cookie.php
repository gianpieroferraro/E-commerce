<?php 
	if(!isset($_COOKIE['amministratore'])) {
		header("location: /shop/log_in.php");
	}
	
?>