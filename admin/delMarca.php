<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM marca");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id = 0;
					if(isset($_GET['id'])) {$id = $_GET['id'];}
					
					
					$sql = "DELETE FROM marca WHERE id=" .$id;
					
					?><div class="divInserMex"><?php
						
						if($con->query($sql) === true) {
							echo "Cancellazione avvenuta con successo";
							?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "gest_marca.php"
										window.clearTimeout(tID)
									}, 2500);
								</script>
							<?php
							
						}else {
							echo "Errore di connessione" . $con->error;
						}
						$distrResult = $con->query("SELECT * FROM distr");
					?></div>
				
		
	</div>	
<?php include("footer.php"); ?>