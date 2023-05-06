<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM utenti;");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id_user = $_GET['id'];
					$sql = $con->query("SELECT * FROM utenti WHERE id=" .$id_user);
					$row = $sql->fetch_assoc();  
				
					$ruolo = "";
					
					if(isset($_POST['ruolo'])) {$ruolo = $_POST['ruolo'];}
					
					$qry = ("UPDATE utenti SET ruolo = '".$ruolo."' WHERE id=" . $id_user);
					
					
					?><div class="divInserMex"><?php
						if($_SERVER['REQUEST_METHOD'] === "POST") {
							if($con->query($qry) === true) {
								echo "Dati inseriti correttamente";
								?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "gest_utenti.php"
										window.clearTimeout(tID)
									},2000)
								</script>
								<?php
							}else {
								echo "Errore di connessione" . $con->error;
							}
						}
						$roleResult = $con->query("SELECT * FROM utenti");
						
					?></div>
				
				<span class="brid">
					<a onclick="location.href='gest_utenti.php'">Gestione Utenti</a>/<b>Modifica <?php echo $row['nome']." ".$row['cognome'] ?></b>
				</span>
				<form class="formInser" name="editUser" action="edit_utenti.php?id=<?php echo $id_user; ?>" method="POST">
					<div class="table_art_ins">
						<table>
							<tbody>
								<tr>
									<th scope="col">Nome</th>
									<td><input disabled class="inserInputDis" value="<?php echo $row['nome']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">Cognome</th>
									<td><input disabled class="inserInputDis" value="<?php echo $row['cognome']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">E-mail</th>
									<td><input disabled class="inserInputDis" value="<?php echo $row['email']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">indirizzo</th>
									<td><input disabled class="inserInputDis" value="<?php echo $row['indirizzo']; ?>"></td>
								</tr><tr>
									<th scope="col">Ruolo</th>
									<td><select class="inserInput" name="ruolo">
											<?php while($p = mysqli_fetch_assoc($roleResult)) {
												if($p['ruolo'] == $row['ruolo']) {
													$selected = 'SELECTED';
												}else {
													$selected = '';
												}
												echo "<option ".$selected." value='".$p['ruolo']."'>".$p['ruolo']."</option>";
											} ?>
										</select>
									</td>
								</tr>
							</tbody>
						</table>	
						<input class="inpConf" type="submit" name="submit" value="Modifica Ruolo">
					</div>
				</form>
			</span>
		
	</div>	
<?php include("footer.php"); ?>