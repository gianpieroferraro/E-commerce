<?php 
	$host = "localhost";
	$port = 3306; 
	$user = "root";
	$password = "";
	$dbname = "database_shop";
	
	$con = new mysqli($host, $user, $password, $dbname, $port)
	or die ("Errore di connessione al database" . $con->connect_error);
	
	//echo "CONNESSIONE CORRETTA" . $con->host_info;

	$sql = $con->query("SELECT * FROM sconto");
	$sconto = $sql->fetch_assoc();
	
	function calcolaSconto($id_sconto, $prezzo_originale) {
		global $con;
		$qry = "SELECT * FROM sconto WHERE id_sconto = $id_sconto";
		$result = mysqli_query($con, $qry);
		$sconto = $result->fetch_assoc();
		

		if($sconto["tipo_sconto"] == "fixed") {
			return $prezzo_originale - $sconto["valore_sconto"];
		} else {
			return $prezzo_originale - ($prezzo_originale * number_format(($sconto["valore_sconto"]) / 100, 3));
		}
	}
	
?>