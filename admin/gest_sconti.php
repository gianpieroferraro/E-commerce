<?php 
	$results_per_page = 6;
	
	if (!isset ($_GET['page']) ) {  
		$page = 1;  
	} else {  
		$page = $_GET['page'];  
	}  
	$page_first_result = ($page-1) * $results_per_page; 


	include("database.php");
	
	include("head.php");
	include("menu.php");
	include("side_bar.php");
	
	$query = "SELECT * FROM sconto INNER JOIN articoli ON sconto.id_articoli = articoli.id_art";
	$result = mysqli_query($con, $query);

	$total = $result->num_rows;
	$number_of_pages = ceil ($total / $results_per_page);
	
	
	if(!isset($_POST['search_sconto'])) {
		$search_sconto = "";
	} else {
		$search_sconto = $_POST['search_sconto'];
	}
	
	
	if($search_sconto) {
		$query = $con->query("SELECT * FROM sconto INNER JOIN articoli ON sconto.id_articoli = articoli.id_art WHERE valore_sconto LIKE '%".$search_sconto."%' 
		LIMIT " . $page_first_result . ',' . $results_per_page);
	}else {
		$query = $con->query("SELECT * FROM sconto INNER JOIN articoli ON sconto.id_articoli = articoli.id_art LIMIT " . $page_first_result . ',' . $results_per_page);
	}
?>
	<div id="grid_right">
		<div class="tab">
			<span>
				<form id="searchform" action="gest_sconti.php" method="POST">
					<div class="distrSel">
						<div class="insImgBut">
							<a class="add" href="insert_sconto.php" title="aggiungi sconto"><image class="insArtBut" src="./images/add.svg"></a><br>
							<b>Inserisci</b>
						</div>	
						</span>
						<input class="inserInput" name="search_sconto" type="text" placeholder="Cerca Sconto">
							
						<input class="inpCerca " type="submit" value="Cerca">
					</div>	
				</form>
				<table class="table_art">
					<thead>
						<tr>
							<th scope="col">Elimina</th>
							<th scope="col">Valore Sconto</th>
							<th scope="col">Tipo Sconto</th>
							<th scope="col">Data Inizio</th>
							<th scope="col">Data Fine</th>
							<th scope="col">SKU articolo</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if ($query->num_rows > 0) {
							while($row = mysqli_fetch_assoc($query)) {?>
								<tr>
									<td class="td_center"><a title="elimina" href="delete_sconto.php?id=<?php echo $row['id_sconto']; ?>">
										<image class="icons" src="./images/delete.svg"></a>
									</td>
									<td><?php echo $row['valore_sconto']; ?></td>
									<td><?php echo $row['tipo_sconto']; ?></td>
									<td><?php echo $row['data_inizio']; ?></td>
									<td><?php echo $row['data_fine']; ?></td>
									<td><?php echo $row['id_articoli']; ?></td>
								</tr>
							<?php
							}
						}else {
							echo "Non ci sono righe da mostrare.";
						}
						?>
					</tbody>
				</table>
				
				<div class="pagination">
					<?php
					   $series = 1;
					   $self = "gest_fornitori.php";
					   $page_pagination = '';
						if ($number_of_pages > '1' ) {
					   
					   
							   $range =10;
							   $range_min = ($range % 2 == 0) ? ($range / 2) - 1 : ($range - 1) / 2;
							   $range_max = ($range % 2 == 0) ? $range_min + 1 : $range_min;
							   $page_min = $page- $range_min;
							   $page_max = $page+ $range_max;
					   
							   $page_min = ($page_min < 1) ? 1 : $page_min;
							   $page_max = ($page_max < ($page_min + $range - 1)) ? $page_min + $range - 1 : $page_max;
							   if ($page_max > $number_of_pages) {
								   $page_min = ($page_min > 1) ? $number_of_pages - $range + 1 : 1;
								   $page_max = $number_of_pages;
							   }
					   
							   $page_min = ($page_min < 1) ? 1 : $page_min;
					   
							   //$page_content .= '<p class="menuPage">';
					   
							   if ( ($page > ($range - $range_min)) && ($number_of_pages > $range) ) {
								   $page_pagination .= '<a title="First" href="'.$self.'?page=1">&lt;</a> ';
							   }
					   
							   if ($page != 1) {
								   $page_pagination .= '<a href="'.$self.'?page='.($page-1). '"></a> ';
							   }
					   
							   for ($i = $page_min;$i <= $page_max;$i++) {
								   if ($i == $page)
								   $page_pagination .= '<a class="active">' . $i . '</a> ';
								   else
								   $page_pagination.= '<a href="'.$self.'?page='.$i. '">'.$i.'</a> ';
							   }
					   
							   if ($page < $number_of_pages) {
								   $page_pagination.= ' <a href="'.$self.'?page='.($page + 1) . '"></a>';
							   }
					   
					   
							   if (($page< ($number_of_pages - $range_max)) && ($number_of_pages > $range)) {
								   $page_pagination .= ' <a title="Last" href="'.$self.'?page='.$number_of_pages. '">&gt;</a> ';
							   }
							   $pages['PAGINATION'] ='<p id="pagination">'.$page_pagination.'</p>';
						   }//end if more than 1 page
					   echo $page_pagination;
					   
					?>
				</div>
			</span>
		</div>
	</div>
	
<?php include("footer.php"); ?>