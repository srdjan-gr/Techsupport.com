<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }

    statistika($db);
?>

<!DOCTYPE html>
<html lang="sr">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>TechSupport | Home</title>
</head>

<body>
<div class="color-overlay">
    <?php require_once('../_header.php')?>
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>

    <!-- Main -->
    <div class="main">
        <div class="wrapper container">
            <div class="proizvod">

            
            <?php
                if(isset($_GET['id']))
                {
                    $idSlike=$_GET['id'];

                    $upit="UPDATE shop_proizvodi SET pogledan=pogledan+1 WHERE id={$idSlike}";
                    $rezultat=$db->query($upit);

                    $upit="SELECT * FROM pogledproizvodi WHERE obrisan=0 AND id={$idSlike}";
                    $rezultat=$db->query($upit);

                    while($red=mysqli_fetch_assoc($rezultat))
                    {
                        echo "<div class='proizvod-card'>";
                            // echo "<div><a href='index2.php?autor={$red['autor']}'>{$red['ime']} {$red['prezime']}</a></div>";
                            echo "<div class='proizvod-card-info'>";
                                echo "<label for=''>Proizvod</label>";
                                echo "<h2>{$red['naslov']}</h2> <br>";

                                echo "<label for=''>Opis proizvoda</label>";
                                echo "<div>{$red['tekst']}</div><br>";
                                
                     
                                echo "<label for=''>Kategorija proizvoda</label>";
                                // echo "<div><a href='proizvodi.php?kategorija={$red['kategorija']}'>{$red['naziv']}</a> | ".date("d.m.Y H:i",strtotime($red['vreme']))."</div> <br><br>";
                                echo "<div><a href='proizvodi.php?kategorija={$red['kategorija']}'>{$red['naziv']}</a> </div> <br>";

                                echo "<label for=''>Cena proizvoda</label>";
                                echo "<div>{$red['cena']},00 din</div><br>";
                            echo "</div>";

                            echo "<button class='btn-order'>Poruči proizvod</button>";
                        echo "</div>";
                    }

                    // Slike
                    $upit="SELECT * FROM shop_proizvodi_slike WHERE idProizvoda={$idSlike}"; 
                    $rezultat=mysqli_query($db=konekcija(), $upit);

                    // Uslov - Ako postoje slike u bazi onda iz prikazujemo
                    if(mysqli_num_rows($rezultat)>0){


                        echo "<div class='images'>";
                            echo "<div class='images-big'>";
                                $red=mysqli_fetch_assoc($rezultat);
                                 
                                echo "<img src='../img/product_photos/{$red['imeSlike']}' alt=''>";
                            echo "</div>";

                            echo "<di class='images-small'>";
                          
                                $rezultat=mysqli_query($db=konekcija(), $upit);
                                while($red=mysqli_fetch_assoc($rezultat))  {
                                    echo "<img src='../img/product_photos/{$red['imeSlike']}' alt=''>";
                                }  
                            echo "</div>";

                        echo "</div>";
                        
                    }
                }
                else
                    echo poruka("Niste odabrali proizvod !!!", 2);
            ?>
            </div>
        </div>
    </div>
    <!-- Main -->

   <?php require_once('../_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</div>
</body>

</html>