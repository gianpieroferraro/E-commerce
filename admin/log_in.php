<?php 
	include("database.php");
	
	include("front_head.php");
	include("front_menu.php");
?>
	<div class="cont">
		<div class="containForm log_in">
			<div class="form login">
				<?php 
					$email = "";
					$password = "";
					
					if(isset($_POST['email'])) {$email = $_POST['email'];}
					if(isset($_POST['password'])) {$password = $_POST['password'];}
				
					$query = "SELECT * FROM utenti WHERE email='$email' AND password= md5('$password')";
					
					
					if($_SERVER['REQUEST_METHOD'] === 'POST') {
							if($con->query($query) == true) {
								echo "Accesso confermato";?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "#"
										window.clearTimeout(tID)
									},2200)
								</script><?php
							}else{
								echo "Errore di connessione al server: " . $con->error;
							}
						}
					
				?>
				<span class="title">Login</span>
					<form id="reg_form" action="log_in.php" method="POST">	
						<div class="input-field">
							<input name="email" type="text" placeholder="Inserisci la tua email" required>	
							<i class="uil uil-envelope"></i>
						</div>
						<div class="input-field">
							<input name="password" class="password" type="password" placeholder="Inserisci la tua password" required>	
							<i class="uil uil-lock icon"></i>
							<i class="uil uil-eye-slash showHidePw"></i>
						</div>
						
						<div class="checkbox_text">
							<div class="checkbox_content">
								<input type="checkbox" id="log_check">
								<label for="log_check" class="text">Ricorda</label>
							</div>
							
							<a href="#" class="text">Pasword dimenticata?</a>
						</div>
						
						
						<div class="input-field button">
							<input type="submit" value="Accedi">
						</div>
					</form>
					
					<div class="login_signup">Non sei ancora un membro?
						<span>
							<a href="registration.php" class="text signup_text reg_link">Registrati</a>
						</span>
					</div>
			</div>
		</div>	
	</div>
	
<?php include("front_footer.php"); ?>