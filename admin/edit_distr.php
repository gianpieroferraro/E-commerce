<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM distr;");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id_distr = $_GET['id'];
					$sql = $con->query("SELECT * FROM distr WHERE id=" .$id_distr);
					$row = $sql->fetch_assoc(); 
				
					$nome_distr = 0;
					$email = "";
					$tel = 0;
					$ind = "";
					$piva = "";
	
					if(isset($_POST['distr'])) {$nome_distr = $_POST['distr'];}
					if(isset($_POST['email'])) {$email = $_POST['email'];}
					if(isset($_POST['tel'])) {$tel = $_POST['tel'];}
					if(isset($_POST['ind'])) {$ind = $_POST['ind'];}
					if(isset($_POST['piva'])) {$piva = $_POST['piva'];}
					
					$qry = ("UPDATE distr SET nome_distr = '".$nome_distr."', email = '".$email."', tel= '".$tel."', indirizzo= '".$ind."', 
					p_iva= '".$piva."' WHERE id_mar=" . $id_distr);
					
					
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
					<a onclick="location.href='gest_distr.php'">Gestione Distributori</a>/<b>Modifica <?php echo $row['nome_distr'] ?></b>
				</span>
				<form class="formInser" name="editDistr" action="edit_distr.php?id=<?php echo $id_distr; ?>" method="POST">
					<div class="table_art_ins">
						<table>
							<tbody>
								<tr>
									<th scope="col">Distributore</th>
									<td><input class="inserInputDis" type="text" name="distr" value="<?php echo $row['nome_distr']; ?>"></td>
								</tr>
								<<tr>
									<th scope="col">E-mail</th>
									<td><input class="inserInputDis" type="text" name="email" value="<?php echo $row['email']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">Telefono</th>
									<td><input class="inserInputDis" type="text" name="tel" value="<?php echo $row['tel']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">indirizzo</th>
									<td><input class="inserInputDis" type="text" name="ind" value="<?php echo $row['indirizzo']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">P.IVA</th>
									<td><input class="inserInputDis" type="text" name="piva" value="<?php echo $row['p_iva']; ?>"></td>
								</tr>
							</tbody>
						</table>	
						<input class="inpConf" type="submit" name="submit" value="Conferma">
					</div>
				</form>
			</span>
		
	</div>	
<?php include("footer.php"); ?>