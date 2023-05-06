
<?php 

include("database.php");

include("front_head.php");
include("front_menu.php");
?>
	<div class="cont">
		<div class="containForm registration">
			<div class="form">
				<?php 
					$name = "";
					$surname = "";
					$email = "";
					$password = "";
					$indirizzo = "";
					if(isset($_POST['name'])) {$name = $_POST['name'];}
					if(isset($_POST['surname'])) {$surname = $_POST['surname'];}
					if(isset($_POST['email'])) {$email = $_POST['email'];}
					if(isset($_POST['password'])) {$password = $_POST['password'];}
					if(isset($_POST['indirizzo'])) {$indirizzo = $_POST['indirizzo'];}
					
				
				?>
				<span class="title">Registrazione</span>
					<form id="reg_form" action="registration.php" method="POST">	
						<div class="input-field">
							<input name="name" type="text" placeholder="Inserisci il tuo nome" required>	
							<i class="uil uil-user"></i>
						</div>
						<div class="input-field">
							<input name="surname" type="text" placeholder="Inserisci il tuo Cognome" required>	
							<i class="uil uil-user"></i>
						</div>
						<div class="input-field">
							<input name="indirizzo" type="text" placeholder="via Letizia sfdfia, 12 - 80100, Cosenza (CS)" required>	
							<i class="uil uil-map-marker-shield"></i>
						</div>
						<div class="input-field">
							<input name="email" type="text" placeholder="Inserisci la tua email" required>	
							<i class="uil uil-envelope"></i>
						</div>
						<div class="input-field">
							<input name="password" class="password" type="password" placeholder="Inserisci la tua password" required>	
							<i class="uil uil-lock icon"></i>
							<i class="uil uil-eye-slash showHidePw"></i>
						</div>
						
						
						<div class="input-field button">
							<input type="submit" value="Registrati">
						</div>
					</form>
					
					<div class="login_signup">Sei già registrato?
						<span>
							<a href="log_in.php" class="text signup_text log_link">Accedi</a>
						</span>
					</div>
					
				<span class="form_succes">	
					<?php 
						$query = "INSERT INTO utenti (nome, cognome, email, password, indirizzo, ruolo) VALUES ('$name','$surname',
						'$email', md5('$password'), '$indirizzo', 'user')";
						
						if($_SERVER['REQUEST_METHOD'] === 'POST') {
							if($con->query($query) == true) {
								echo "Registrazione avvenuta con successo";?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "log_in.php"
										window.clearTimeout(tID)
									},2200)
								</script><?php
							}else{
								echo "Errore di connessione al server: " . $con->error;
							}
						}
					?>
				</span>
				
			</div>
		</div>	
	</div>
<?php include("front_footer.php"); ?>