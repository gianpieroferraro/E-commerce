<?php
     if(!isset($_COOKIE['user'])) {
        header("location: /shop/log_in.php");
    }

	include("database.php");
	include("front_head.php");
	include("front_menu.php");
	
    $id_user = $_COOKIE['user'];
    $sql = $con->query("SELECT * FROM utenti WHERE id=" .$id_user);
    $row = $sql->fetch_assoc(); 
?>
	<div id="grid_right_user">
		<h1>Ciao <?php echo $row['nome']; ?>, da qui puoi gestire il tuo profilo.</h1>
		<h2>I tuo dati:</h2>
		
		<div class="table_art_ins">
			<table>
				<tbody>
					<tr>
						<th scope="col">Nome</th>
						<td><input disabled class="inserInputUser" value="<?php echo $row['nome']; ?>"></td>
					</tr>
					<tr>
						<th scope="col">Cognome</th>
						<td><input disabled class="inserInputUser" value="<?php echo $row['cognome']; ?>"></td>
					</tr>
					<tr>
						<th scope="col">E-mail</th>
						<td><input disabled class="inserInputUser" value="<?php echo $row['email']; ?>"></td>
					</tr>
					<tr>
						<th scope="col">Password</th>
						<td><input disabled class="inserInputUser" type="password" value="<?php echo $row['password']; ?>"></td>
					</tr>
					<tr>
						<th scope="col">indirizzo</th>
						<td><input disabled class="inserInputUser" value="<?php echo $row['indirizzo']; ?>"></td>
					</tr>
					<tr>
						<th scope="col">Ruolo</th>
						<td><input disabled class="inserInputUser" value="<?php echo $row['ruolo']; ?>"></td>
					</tr>
				</tbody>
			</table>	
			<input class="inpConf" onclick="location.href='front_user_edit.php'" type="button" value="Modifica Dati">
		</div>
	</div>	