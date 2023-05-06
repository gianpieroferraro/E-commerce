<?php 
	include("database.php");

	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = $con->query("SELECT * FROM distr");
?>
	<div id="grid_right_insart">
		
			<span style="position: relative;">
				<?php
					$id_distr = 0;
					if(isset($_GET['id'])) {$id_distr = $_GET['id'];}
					
					
					$sql = "DELETE FROM distr WHERE id=" .$id_distr;
					
					?><div class="divInserMex"><?php
						
						if($con->query($sql) === true) {
							echo "Cancellazione avvenuta con successo";
							?>
								<script>
									let tID = setTimeout(function() {
										window.location.href = "gest_distr.php"
										window.clearTimeout(tID)
									}, 2500);
								</script>
							<?php
						}else {
							echo "Errore di connessione" . $con->error;
						}
						
					?></div>
				
		
	</div>	
<?php include("footer.php"); ?>