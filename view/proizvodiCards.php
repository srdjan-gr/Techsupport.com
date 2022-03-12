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
            // $upit = "SELECT * FROM pogledproizvodi WHERE obrisan=0 AND kategorija={$_GET['kategorija']}";
            $upit = "SELECT * FROM pogledproizvodi WHERE obrisan=0 AND kategorija={$_GET['kategorija']}";
            $rezultat =mysqli_query($db=konekcija(), $upit);

            while($red=mysqli_fetch_assoc($rezultat)){

                // var_dump($red);
                echo    "<div class='grid-shop-content'>";
                    echo        "<div class='grid-content-text'>";
                        echo        "<li><a href='proizvod.php?id={$red['id']}'>{$red['naslov']}</a></li>";
                    echo        "</div>";

                    // $upitfoto="SELECT * FROM shop_kategorije WHERE id={$_GET['id']}";
                    $upitfoto="SELECT * FROM shop_kategorije";
                    $rezfoto=mysqli_query($db=konekcija(), $upitfoto);
                    

                    if(mysqli_num_rows($rezfoto) > 0){

                        $redfoto=mysqli_fetch_assoc($rezfoto);

                        // var_dump($redfoto);

                        echo        "<img src='../img/product_category_photos/{$redfoto['slika']}' alt=''>"; 
                    }


                
                echo    "</div>";
            }
        ?>
    </div>
</div>
<!--Kraj Grid-->