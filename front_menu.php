	
	<header class="header">
		<a class="logo" href="/shop/index.php" rel="nofollow"><img src="site_imgs/logo_foferys.png"><b>Foferys</b></a>
		
		<div class="circle hidden"></div>

		<input class="menu_btn" id="menu_btn" type="checkbox">
		<label for="menu_btn" class="menu_icon">
			<div id="log_menu">
				<a class="active" href="/shop/index.php"><b>Home</b></a>
				<a href="log_in.php"><b>Login</b></a>
				<div style="position: relative;">
					<a href="carrello.php"><i class="uil uil-shopping-bag basket"></i></a>
				</div>
				<span class="nav_icon"></span>
			</div>
		</label>
		
		<ul class="menu">
			<div id="mainSearch">
				<span><a href="front_user_profile.php">Il tuo profilo</a></span>
				<span>
					<a href="?logout=true">Log out</a>
				</span>
			
				<form action="index.php" method="post">
					<input class="mainSearch" name="search" type="text"> <!--RICERCA-->
					<button class="mainCerca" type="submit">
						<i class="uil uil-search-alt"></i>
					</button>
				</form>	
			</div>

			<?php 
				$sql = "SELECT * FROM categorie WHERE id_padre IS NULL";
				$result = mysqli_query($con, $sql);
				while($row = $result->fetch_assoc()){
			?>

			<li><a href="/shop/elem_categ.php?id_cat=<?php echo $row['id']?>&tipo=<?php echo $row['tipo']?>"><?php echo $row['tipo'] ?></a></li>
		
			<?php } ?>
			
		</ul>
	</header>
	