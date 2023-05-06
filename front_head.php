<?php 
	if(isset($_GET['logout'])) {
		setcookie("user", "", time() -3600, "/shop");
		header("location: /shop/index.php");
	}

	


	$hero_img = "";
	if(isset($_GET['id_cat'])) {
		$id_categ = $_GET['id_cat'];
		$query = "SELECT * FROM categorie WHERE id = $id_categ LIMIT 1 ";
		$result = mysqli_query($con, $query);
		while($r = mysqli_fetch_assoc($result)) {
			$hero_img = $r['hero_img'];
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Foferys Abbigliamento</title> 
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css?v=20">
		<link rel="stylesheet" href="style.css?v=48">
		<style>
			
			#hero_shoe {
				background-image: url(<?php echo $hero_img ?>);
				height: 440px;
				background-size: cover;
				background-position: top 2% right 0;
				padding: 70px 150px;
				display: flex;
				flex-direction: column;
				align-items: flex-start;
				justify-content: center;
				color: #fff;
				margin: 0;
				padding-bottom: 15px;
			}
		</style>
	</head>
	<body>
	