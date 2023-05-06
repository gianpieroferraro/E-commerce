<?php 
include('cookie.php'); 

if(isset($_GET['logout'])) {
	setcookie("amministratore", "", time() -3600, "/shop");
	header("location: /shop/log_in.php");
}
?> 

<!DOCTYPE html>
<html lang="it">
	<head>
		<title>Gianpiero Ferraro - Foferys</title> 
		<link href="style.css?v=05" rel="stylesheet">
	</head>
	<body>