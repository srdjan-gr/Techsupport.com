<?php
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>

<!-- SHOP stranica - Kartice koje pokazuju kategorije na prvoj stranici SHOP-a -->
<!-- Grid -->
<div class="grid-shop-container">
    <div class="grid-shop">
  
        <?php
            $upit = "SELECT * FROM shop_kategorije";
            $rezultat = $db->query($upit);

            while($red=$db->fetch_object($rezultat)){
                echo    "<div class='grid-shop-content'>";
                echo        "<div class='grid-content-text'>";
                echo            "<li><a href='proizvod.php?id={$red->id}'>{$red->naziv}</a></li>";
                echo        "</div>";
                // echo        "<img src='' alt=''>";
                echo    "</div>";
            }
        ?>
    </div>
</div>
<!--Kraj Grid-->