<?php 
	if(!isset($_COOKIE['user'])) {
		header("location: /shop/log_in.php");
	}
	
?>