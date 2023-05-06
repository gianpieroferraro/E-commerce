<?php 
	$host = "localhost";
	$port = 3306; 
	$user = "root";
	$password = "Kimiraikkonen7.";
	$dbname = "database_shop";
	
	$con = new mysqli($host, $user, $password, $dbname, $port)
	or die ("Errore di connessione al database" . mysqli_connect_error());
	
	//echo "CONNESSIONE CORRETTA" . $con->host_info;
?>