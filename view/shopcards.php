<?php
    require_once('../obaveznifajlovi.php');
    $db= konekcija();
    if(!$db){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>


<!-- SHOP stranica - Kartice koje pokazuju kategorije na prvoj stranici SHOP-a -->
<!-- Grid -->
<div class="grid-shop-container">
    <div class="grid-shop">
  
        <?php
        //  if(isset($_GET['id'])){

            // $idKategorije=$_POST['id'];

            $upit = "SELECT * FROM shop_kategorije WHERE obrisan=0";
            $rezultat = mysqli_query($db, $upit);

            while($red=mysqli_fetch_assoc($rezultat)){

                    echo    "<div class='grid-shop-content'>";

                        echo    "<div class='grid-shop-content-img'>";

                            $upitslike="SELECT * FROM shop_kategorije_slike";
                            // $idslike=$_GET['id'];

                            $rezultatslike=mysqli_query($db, $upitslike);

                            if($redi=mysqli_num_rows($rezultatslike) > 0){

                                $redslike=mysqli_fetch_assoc($rezultatslike);
                    
                                echo "<img src='../img/product_category_photos/{$redslike['imeSlike']}' alt=''>"; 
                                
                            }
                            else{
                                // echo "<img src='../img/product_category_photos/_no-product.jpg' alt=''>";
                            }


                        echo    "</div>";

                    echo        "<div class='grid-shop-content-text'>";
                    echo            "<li><a href='proizvodi.php?kategorija={$red['id']}'>{$red['naziv']}</a></li>";
                    echo        "</div>";

                    echo    "</div>";
                }
                
               
            // }
        ?>
    </div>
</div>
<!--Kraj Grid-->