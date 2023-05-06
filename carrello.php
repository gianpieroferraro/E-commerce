<?php 
	include("database.php");
	include("front_head.php");
	include("front_menu.php");

?>
<div class="cart_main_cont">
	<div>
		<div id="cart_title">
			<h1>IL TUO CARRELLO</h1>
			<H5>Gli articoli nel tuo carrello non sono riservati per te. Completa l'acquisto per non perderli.</H5>
		</div>
		<?php
			
			$idart = $_COOKIE['carrello'];
			//print $idart;
			$tot = 0;
			$id_art = explode(",", $idart);
			//print_r($id_art);
			foreach ($id_art as $value) {
				$quantity = explode(":", $value);
				//print_r($quantity[1]);



				$query = "SELECT * FROM articoli INNER JOIN marca ON articoli.id_marca = marca.id_mar INNER JOIN categorie ON articoli.id_categoria = categorie.id WHERE id_art = $quantity[0]";

				$result = mysqli_query($con, $query);
				

				
				
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()){ ?>
						<div>
							<div>	
								<div class="cart_container">
									<img src="/shop/admin/<?php echo $row['immagine']; ?>"> 
									<div class="box_cart">
										<i id="cart_delete" data-id="<?php echo $quantity[0] ?>" data-num="<?php echo $quantity[1] ?>"  class="uil uil-multiply"></i>		
										<h2><?php echo $row['nome']; ?></h4>
										<div>
											<h3><?php echo $row['nome_marca']; ?></h5>
											<h3><?php echo $row['tipo']; ?></h5>
										</div>
										<div class="price" data-change="<?php echo $row["prezzo"] * $quantity[1]?>" data-price="<?php echo $row["prezzo"] ?>">
											
											<b><?php 
												if($row["sconto_id"]) {
													?> 
													<span class="normal_price">
														<?php 
															echo $row["prezzo"] * $quantity[1];
														?>
														
													</span>
													<span data-sconto="<?php echo calcolaSconto($sconto["id_sconto"], $row["prezzo"]) ?>" class="sconto"><?php
															echo calcolaSconto($sconto["id_sconto"], $row["prezzo"]) * $quantity[1]; 
															$tot = $tot + calcolaSconto($sconto["id_sconto"], $row["prezzo"]) * $quantity[1];
															//echo "  take ".  $tot;
														?> 	<!--FUNZIONE PRESENTE NEL FILE DATABASE-->
													</span><?php
												} else {
													echo $row["prezzo"] * $quantity[1];
												
													$tot = $tot + $row["prezzo"] * $quantity[1];
													//echo  "  tot ".$tot;
												} ?> €
											</b>
										</div>

										<select class="num_art">
											<?php
												$num = 0;
												while($num < $row["pezzi"]) {

													$num = $num + 1;
													if($num == $quantity[1]) {
														$selected = "SELECTED";
													}else {
														$selected = "";
													}
													echo "<option ".$selected." value='".$num."'>".$num."</option>";
												}
											?>
										</select>
								
									</div>	
								</div>
							</div>	
						</div><?php 
					} 
				}else if($result->num_rows <= 0) {
					echo "nessun articolo nel carrello."; ?> <a href="./front_index.php">Torna alla HOME</a> <?php
				}
				else{
					echo "Errore: non ci sono elementi con questo nome! " . $con->error;
				}	
			}

			?>
			
	</div>
	<div id="right_pan">
		<div class="procedi_box">
			<input data-product="<?php echo $row['id_art'] ?>" type="submit" name="add_bask" class="cart_procedi" value="Procedi"><i class="uil uil-arrow-right"></i>
		<br><br><br>
		<div class="vest_box">
            <p><img src="/shop/images/paypal.png"><i class="uil uil-arrow-right"></i></p>
        </div>
		<div class="riepilogo_cont">
			<h2>RIEPILOGO ORDINE</h2>
			<div class="flex">
				<h4>PREZZO ORIGINALE</h4>
				<h4>170,90€</h4>				 
			</div>
			<div class="flex">
				<h4>OUTLET</h4>
				<h4>-20,00€</h4>
			</div>
			<div class="flex">
				<h4><?php ?> PRODOTTI</h4>
				<h4><?php ?> 150,90€ </h4>
			</div>
			<div class="flex">
				<h4>CONSEGNA</h4>
				<h4>Gratuito</h4>
			</div>
			<div style="margin-top: 20px;" class="flex">
				<h2><b>TOTALE:</b></h2>
				<h2 data-tot="<?php echo $tot ?>" class="tot"><b><?php echo $tot ?> €</b></h2>
			</div>
		</div>

		<div>
			<input type="text" name="coupon" id="coupon" placeholder="Inserisci il codice">
		</div>
		<br><br><br>
		<h4>METODI DI PAGAMENTO ACCETTATI</h4>
		<div class="flex">
			<img src="./loghi/visa-amex-master-klarna-pp-ap_tcm213-806063.png">
		</div>

	</div>
</div>
<?php include("front_footer.php") ?>