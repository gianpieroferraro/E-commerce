<?php 
	
	include("database.php");
	include("front_head.php");
	include("front_menu.php");
	
	
?>

	<div id="hero_shoe" >
			<h4>Collezione Moda 2022</h4>
			<h2>I dettagli che fanno la differenza</h2>
			<h1>Il pantalone giusto, per un'estate perfetta!</h1>
			<p>Risparmia di più con i coupons, fino al 70% di sconto!</p>
			<button>Acquista ora</button>
	</div>		
	<div id="shoeHead" >
		<span class="brid">
			<a href='/shop/index.php'>Home</a> / <b><a href="elem_categ.php?id_cat=<?php echo $_GET['id_cat'];?>
			&tipo=<?php echo $_GET['tipo'];?>"><?php echo $_GET['tipo'];?></a></b>
		</span>
		<i><h1><?php echo $_GET['tipo'];?></h1></i>
		<div class="filters">
			<form id="searchFilter" action="elem_categ.php?id_cat=<?php echo $_GET['id_cat'];?>&tipo=<?php echo $_GET['tipo'];?>" method="POST">
				<div class="distrSel">
					<input class="shoeSearch" name="cerca" type="text" placeholder="Cerca">
					
					<button class="shoeCerca" type="submit">
						<i class="uil uil-search-alt"></i>
					</button>
				</div>	
			</form>
		</div>
	</div>
	<?php 
		
		$id_categ = $_GET['id_cat'];
		$tipo = $_GET['tipo'];
		
		
		if(!isset($_POST['cerca'])) {
			$cerca = "";
		}else{
			$cerca = $_POST['cerca'];
		}
		
		

		
		if($cerca ) {
			$query = "SELECT id FROM categorie WHERE id_padre = $id_categ";
			$result = mysqli_query($con, $query);
			$array = [];
			while ($r = mysqli_fetch_assoc($result)) {
				$array[] = $r['id'];
			}
			$array = implode(',', $array); 
			
			$query = "SELECT * FROM articoli INNER JOIN marca ON articoli.id_marca = marca.id_mar INNER JOIN categorie ON articoli.id_categoria = categorie.id WHERE (id_categoria = '$id_categ' OR id_categoria IN
			($array)) AND (nome LIKE '%".$cerca."%' OR nome_marca LIKE '%".$cerca."%')";
			
			$result = mysqli_query($con, $query);
		}else{
			$query = "SELECT id FROM categorie WHERE id_padre = $id_categ";
			$result = mysqli_query($con, $query);
			$array = [];
			while ($r = mysqli_fetch_assoc($result)) {
				$array[] = $r['id'];
			}
			$array = implode(',', $array); 
			
			$query = "SELECT * FROM articoli INNER JOIN marca ON articoli.id_marca = marca.id_mar INNER JOIN categorie ON articoli.id_categoria = categorie.id LEFT JOIN sconto ON articoli.sconto_id = sconto.id_sconto
			WHERE id_categoria = '$id_categ' OR id_categoria IN ($array)";
			//print $query;
			$result = mysqli_query($con, $query);
		}
		if (!$result) {
			echo 'Could not run query: ' . mysqli_error($con);
			exit;
		}
		
	?>	
		
		<section id="feature" class="sectionP1">
	<?php
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
	?>
			<div class="imgShoeContainer">
				<a href="prodotto.php?id_art=<?php echo $row["id_art"]?>&tipo=<?php echo $tipo?>"><img src="/shop/admin/<?php echo $row['immagine']; ?>"></a>
				<h4><?php echo $row['nome']; ?></h4>
				<h5><?php echo $row['nome_marca']; ?></h5>
				<h5><?php echo $row['tipo']; ?></h5>
				<div class="shoePrice">
					<b><?php 
							if($row["sconto_id"]) {
								?> 
								<span class="normal_price">
									<?php echo $row["prezzo"]; ?>
								</span>
								<span class="sconto">
								<?php
									echo calcolaSconto($sconto["id_sconto"], $row["prezzo"]);?> 	<!--FUNZIONE PRESENTE NEL FILE DATABASE-->
								</span><?php
							} else {
								echo $row["prezzo"];
							} ?> €
					</b>
					
					<span>
						<button data-product="<?php echo $row['id_art'] ?>" class="uil uil-shopping-bag basket prod_bask"></button>
					</span>
					<select id="id_<?php echo $row["id_art"] ?>"  class="quantity quantity_all_el">
						<?php
						$num = 0;
						while($num < $row["pezzi"]) {

							$num = $num + 1;
							
							echo "<option value='".$num."'>".$num."</option>";
						}
						?>
					</select>
				</div>
				
			</div>
	<?php } 
	}
	else{
		echo "Errore: non ci sono elementi con questo nome! " . $con->error;
	}

	?>
	</section>	

	
<?php include("front_footer.php"); ?>