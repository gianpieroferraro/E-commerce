<?php 
	include("database.php");

	include("front_head.php");
	include("front_menu.php");
?>
	<div id="grid_right_user">
		
			<span style="position: relative;">
				<?php
					$id_user = $_COOKIE['user'];
					$sql = $con->query("SELECT * FROM utenti WHERE id=" .$id_user);
					$row = $sql->fetch_assoc(); 
					
					$nome = "";
					$cognome = "";
					$email = "";
					$pass = "";
					$indirizzo = "";
					$old_pass = "";
					
					if(isset($_POST['nome'])) {$nome = $_POST['nome'];}
					if(isset($_POST['cognome'])) {$cognome = $_POST['cognome'];}
					if(isset($_POST['email'])) {$email = $_POST['email'];}
					if(isset($_POST['password'])) {$pass = $_POST['password'];}
					if(isset($_POST['indirizzo'])) {$indirizzo = $_POST['indirizzo'];}
					
					
					if(isset($_POST['oldPass'])) {$old_pass = $_POST['oldPass'];}
					
				
					if(md5($old_pass) === $row['password']) {
						$qry = "UPDATE utenti SET nome='".$nome."', cognome= '$cognome', email='$email', password= md5('$pass'), 
						indirizzo='$indirizzo', ruolo = '".$ruolo."' WHERE id=" . $id_user;
					}else {
						$qry = "SELECT * FROM utenti";
						
					}
					
					
					?><div class="divInserMex"><?php
						if($_SERVER['REQUEST_METHOD'] === "POST") {
							if($con->query($qry) === true) {
								echo "Dati inseriti correttamente";
								?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "user_profile.php"
										window.clearTimeout(tID)
									},2000)
								</script>
								<?php
							}else {
								if(!$qry) {
									echo "Errore di connessione" . $con->error;
								}else {
									echo "Password errata";
								}
							}
						}
						$roleResult = $con->query("SELECT * FROM utenti");
						
					?></div>
				
				<div class="brid">
					<a href='front_user_profile.php'>Il tuo Profilo</a>/<b>Modifica i tuoi dati</b>
                    </div>
				<form class="formInser" name="editUser" action="front_user_edit.php?id=<?php echo $id_user; ?>" method="POST">
					<div class="table_art_ins">
						<table>
							<tbody>
								<tr>
									<th scope="col">Nome</th>
									<td><input class="inserInputUser" name="nome" value="<?php echo $row['nome']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">Cognome</th>
									<td><input class="inserInputUser" name="cognome" value="<?php echo $row['cognome']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">E-mail</th>
									<td><input class="inserInputUser" name="email" value="<?php echo $row['email']; ?>"></td>
								</tr>
								<tr>
									<th scope="col">Vecchia <br>Password</th>
									<td><input class="inserInputUser" type="password" name="oldPass" required></td>
								</tr>
								<tr>
									<th scope="col">Nuova<br>Password</th>
									<td><input class="inserInputUser" type="password" name="password" required></td>
								</tr>
								<tr>
									<th scope="col">indirizzo</th>
									<td><input class="inserInputUser" name="indirizzo" value="<?php echo $row['indirizzo']; ?>"></td>
								</tr>
                               
							</tbody>
						</table>	
						<input class="inpConf" type="submit" name="submit" value="Modifica">
					</div>
				</form>
			</span>
		
	</div>	