<?php
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>

<!-- Prikaz svih proizvoda iz JEDNE kategorije -->
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
                 
                        echo    "<div class='grid-shop-content-img'>";
                                
                            // $upitfoto="SELECT * FROM shop_proizvodi WHERE id={$_GET['id']}";
                            // $upit="SELECT * FROM shop_proizvodi_slike WHERE obrisan=0 AND id={$_GET['idProizvoda']}";
                            // $upitfoto="SELECT * FROM shop_proizvodi_slike WHERE obrisan=0 AND idProizvoda={$_GET['id']}";
                            // $rezfoto=mysqli_query($db=konekcija(), $upit);
                            
                            // if(mysqli_num_rows($rezfoto) > 0){

                            //     $redfoto=mysqli_fetch_assoc($rezfoto);
                            //     echo "<img src='../img/product_category_photos/{$redfoto['imeSlike']}' alt=''>"; 
                            // }

                            // echo "<img src='../img/product_category_photos/_no-product.jpg' alt=''>"; 
                        echo    "</div>";

                        echo        "<div class='grid-shop-content-text'>";
                            echo        "<li><a href='proizvod.php?id={$red['id']}'>{$red['naslov']}</a></li>";
                        echo        "</div>";
             
                echo    "</div>";
            }
        ?>
    </div>
</div>
<!--Kraj Grid-->