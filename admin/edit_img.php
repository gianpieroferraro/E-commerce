<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM immagini;");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id_art = $_GET['id'];
					$sql = $con->query("SELECT * FROM immagini INNER JOIN articoli ON immagini.id_articolo = articoli.id_art WHERE id_articolo=" .$id_art);
					$row = $sql->fetch_assoc(); 
				
					$art = 0;
					$target_file = "";
					$descr = "";
                    
					
					if(isset($_POST['art'])) {$art = $_POST['art'];}
					
					if(isset($_POST['submit'])) {
						$target_dir = "art_img/";
						$target_file = $target_dir . basename($_FILES["file_to_upload"]["name"]);
						
						$upoad_ok = 1;
						$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
					
						$check = getimagesize($_FILES['file_to_upload']['tmp_name']);
						if($check !== false) {
							echo "Il file è un'immagine - " . $check["mime"] . ".";
							$upload_ok  = 1;
						} else {
							echo "Il file non è un'immagine.";
							$upload_ok = 0;
						}
						
						if($upload_ok == 0) {
							echo "Errore di caricamento, riprova.";
						}else {
							if(move_uploaded_file($_FILES['file_to_upload']['tmp_name'], $target_file)) {
								echo "Il file " . htmlspecialchars(basename($_FILES['file_to_upload']['name'])) . " E' stato caricato.";
								
							}else {
								echo "Ci scusiamo, è stato riscontrato un errore duranete il caricamento.";
							}
						}
					}
					
					if(isset($_POST['descr'])) {$descr = $_POST['descr'];}
					
					$qry = ("UPDATE immagini SET img = '".$target_file."', descrizione = '".$descr."', id_articolo= '".$art."' WHERE id_mar=" . $id_art);
					
					
					?><div class="divInserMex"><?php
						if($_SERVER['REQUEST_METHOD'] === "POST") {
							if($con->query($qry) === true) {
								echo "Dati inseriti correttamente";
								?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "gest_marca.php"
										window.clearTimeout(tID)
									},2000)
								</script>
								<?php
							}else {
								echo "Errore di connessione" . $con->error;
							}
						}
						
						$artResult = $con->query("SELECT * FROM articoli");
						
					?></div>
				
				<span class="brid">
					<a onclick="location.href='gest_img.php'">Immagini</a>/<b>Modifica Immagine</b>
				</span>

				<form class="formInser" name="editImg" action="edit_img.php?id=<?php echo $id_art; ?>" method="POST" enctype="multipart/form-data">
					<div class="table_art_ins">
                        <table>
							<tbody>
								<tr>
									<th scope="col">Articolo</th>
									<td><select class="inserInput" name="art">
											<?php while($p = mysqli_fetch_assoc($artResult)) {
												if($p['nome'] == $row['nome']) {
													$selected = "SELECTED";
												}else {
													$selected = "";
												}
												echo "<option ".$selected." value='".$p['id_art']."'>".$p['nome']."</option>";
											} ?>
										</select>
									</td>
								</tr>
								<tr>
									<th scope="col">Immagine</th>	
									<td><input class="choose_file" type="file" name="file_to_upload"></td>
								</tr>
								<tr>
									<th scope="col">Descrizione</th>
									<td><textarea class="inserDescr" rows="5" cols="32" name="descr">Scrivi il tuo testo qui</textarea></td>
								</tr>
							</tbody>
						</table>	
						<input class="inpConf" type="submit" name="submit" value="Conferma">
					</div>
				</form>
			</span>
		
	</div>	
<?php include("footer.php"); ?>