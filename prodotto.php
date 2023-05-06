<?php 
	include("database.php");
	include("front_head.php");
	include("front_menu.php");

	$id_art = $_GET['id_art'];
	$tipo = $_GET['tipo'];

	$query = "SELECT * FROM articoli INNER JOIN marca ON articoli.id_marca = marca.id_mar INNER JOIN categorie ON articoli.id_categoria = categorie.id WHERE id_art = $id_art";
	$result = mysqli_query($con, $query);
    $row = $result->fetch_assoc();

    $imgs_sql = "SELECT * FROM immagini INNER JOIN articoli ON immagini.id_articolo = articoli.id_art WHERE id_art = " . $id_art;
    $imgsRes = mysqli_query($con, $imgs_sql);


    
?>
<!--<script>
var json = "";
<?php
    /*$myArray = array(); 
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }*/
?>
json = "<?php echo json_encode($myArray) ?>"
</script>-->

 <div id="prod_brid">
    <i class="uil uil-corner-up-left-alt arrow"></i>  <a href="elem_categ.php?id_cat=<?php echo $row['id_categoria']?>&tipo=<?php echo $row['tipo']?>">Indietro</a> / <a href="index.php">Home</a> / <a href="elem_categ.php?id_cat=<?php echo $row['id_categoria']?>&tipo=<?php echo $row['tipo']?>"><?php echo $tipo ?></a>
</div>
<div id="main_cont">
   
    <div class="prod_img_container">
        <img src="/shop/admin/<?php echo $row['immagine']; ?>"> 
        <div class="img_descr"> 
            <p>Descrizione Scarpe</p>
        </div>
    </div>

    <div class="small_img_cont">
        <div class="small_imgs">
            <span class="imgs">
                <img  src="/shop/admin/<?php echo $row['immagine']; ?>">
            </span>

            <?php while($imgs_row = $imgsRes->fetch_assoc()) {?>
                <span class="imgs">
                    <img src="/shop/admin/<?php echo $imgs_row['img']; ?>">
                    <h2 class="hidden" data-title="<?php echo $imgs_row['descrizione']; ?>"></h2>
                </span>
            <?php } ?>
        </div>
         
        
       
    </div>


    
    <div id="right_col">
        <h5><?php echo $row['nome_marca']; ?></h5>
        <h2><i><?php echo $row['nome']; ?></i></h4>
        <b><?php if($row["sconto_id"]) {?> 
                    <span class="normal_price">
                        <?php echo $row["prezzo"]; ?>
                    </span>
                    <span class="sconto">
                    <?php
                        echo calcolaSconto($sconto["id_sconto"], $row["prezzo"]);?>
                    </span><?php
                } else {
                    echo $row["prezzo"];
                }  
        ?> €</b>
        <br><br>
        <a class="pagamenti">Paga con PayPal o Carta di Credito.</a>
        <br><br><br>
        <h4>Personalizza</h4>
        <p>Aggiungi nome o numero per personalizzare il tuo prodotto <?php echo $row["nome_marca"] ?> o per creare il regalo perfertto!</p>

        <input type="text" name="personalizzazione" class="personaliz" placeholder="Tallone piede destro e sinistro">
        <br><br><br>
        <i class="uil uil-ruler ">  </i><a class="taglie" href="#">Guida alle taglie</a>
        <br><br>
        <div class="vest_box">
            <p><i class="uil uil-info-circle"></i> <a>Vestibilità standard.</a> Ti consigliamo di ordinare la tua taglia standard.</p>
        </div>
        <br><br><br>

        <select id="id_<?php echo $row["id_art"] ?>"  class="quantity">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <br><br><br>
      
        <div class="carrello">
            <input data-product="<?php echo $row['id_art'] ?>" type="submit" name="add_bask" class="add_bask" value="AGGIUNGI AL CARRELLO"><i class="uil uil-arrow-right"></i>
        </div>
    </div>

</div>
<?php include("front_footer.php"); ?>