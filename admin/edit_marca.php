<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM marca;");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id_marca = $_GET['id'];
					$sql = $con->query("SELECT * FROM marca INNER JOIN distr ON marca.id_distr = distr.id WHERE id_mar=" .$id_marca);
					$row = $sql->fetch_assoc(); 
				
					$marca = "";
					$target_file = "";
					$distr = 0;
	
					if(isset($_POST['marca'])) {$marca = $_POST['marca'];}
					if(isset($_POST['submit'])) {
						$target_dir = "loghi/";
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
					if(isset($_POST['distr'])) {$distr = $_POST['distr'];}
					
					$qry = ("UPDATE marca SET nome_marca = '".$marca."', nome_logo = '".$target_file."', id_distr= '".$distr."' WHERE id_mar=" . $id_marca);
					
					
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
						
						$distrResult = $con->query("SELECT * FROM distr");
						
					?></div>
				
				<span class="brid">
					<a onclick="location.href='gest_marca.php'">Gestione Marche</a>/<b>Modifica <?php echo $row['nome_marca'] ?></b>
				</span>
				<form class="formInser" name="editMarca" action="edit_marca.php?id=<?php echo $id_marca; ?>" method="POST" enctype="multipart/form-data">
					<div class="table_art_ins">
						<table>
							<tbody>
								<tr>
									<th scope="col">Marca</th>
									<td><input class="inserInput" type="text" name="marca" value="<?php echo $row['nome_marca']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">Logo</th>	
									<td><input class="choose_file" type="file" name="file_to_upload"></td>
								</tr>
								<tr>
									<th scope="col">Distributore</th>
									<td><select class="inserInput" name="distr">
											<?php while($p = mysqli_fetch_assoc($distrResult)) {
												if($p['nome_distr'] == $row['nome_distr']) {
													$selected = "SELECTED";
												}else {
													$selected = "";
												}
												echo "<option ".$selected." value='".$p['id']."'>".$p['nome_distr']."</option>";
											} ?>
										</select>
									</td>
								</tr>
							</tbody>
						</table>	
						<input class="inpConf" type="submit" name="submit" value="Conferma">
					</div>
				</form>
			</span>
		
	</div>	
<?php include("footer.php"); ?>