	<header class="coloreBase">
	<?php 
		$id_user = $_COOKIE['amministratore'];
		$sql = $con->query("SELECT * FROM utenti WHERE id=" .$id_user);
		$row = $sql->fetch_assoc(); 
		
	?>
		<a href="./index.php" rel="nofollow" target="blank"><img src="images/logo_foferys.png"></a>
		<nav id="navMenu">
			<ul>
				<li><a id="user_but"><?php echo $row['nome']; ?></a>
					<div class="sub_menu hidden">
						<div>
							<a class="profile" href="user_profile.php">Il tuo profilo</a><br>
						</div>
						<div>
							<a class="logout" href="?logout=true">Log out</a>
						</div>
					</div>
				</li>
				<li><a href="../index.php" target="blank">Vai al sito</a></li>
			</ul>
		</nav>
	</header><br><br><br>
	<div class="container">