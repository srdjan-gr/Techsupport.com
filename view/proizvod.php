<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db=konekcija();
    if(!$db){
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
    <title>TechSupport | Proizvod</title>
</head>

<body>
<div class="color-overlay">
    <?php require_once('../_header.php')?>
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>

    <!-- Main -->
    <div class="main">
        <div class="wrapper container">

     
            <!-- Prikaz jednog proizvoda sa slikama, opisom proizvoda, cenom i dugmetom za porucivanje -->
            <div class="proizvod">

                <!-- Container za slike i Modal JS-->
                <div id="popup">
                    <ion-icon name="close-circle-outline" class="popupClose" id="popupClose"></ion-icon>
                    <div class="buttonsDiv" id="buttonsDiv"></div>
                </div>

                <div class="gallery" id="gallery">
                    <div class="images">
                        <div class="images-big" id="images-big" >
                            <p class="imgOverlay" onmouseover="dosoMis()" onmouseleave="otisoMis()">Prikazi</p>
                        </div>
                        <div class="images-small" id="images-small"></div>
                    </div>
                </div>
                <!-- Container za slike i Modal JS-->

            <?php
                if(isset($_GET['id']))
                {
                    $idProizvoda=$_GET['id'];

                    $upit="UPDATE shop_proizvodi SET pogledan=pogledan+1 WHERE id={$idProizvoda}";
                    mysqli_query($db, $upit);

                    $upit="SELECT * FROM pogledproizvodi WHERE obrisan=0 AND id={$idProizvoda}";
                    $rezultat=mysqli_query($db, $upit);

                    while($red=mysqli_fetch_assoc($rezultat))
                    {
                        echo "<div class='proizvod-card'>";
                            echo "<div class='proizvod-card-info'>";
                                echo "<label for='naslov'>Proizvod</label>";
                                echo "<h2 id='naslov'>{$red['naslov']}</h2> <br>";

                                echo "<label for='text'>Opis proizvoda</label>";
                                echo "<div id='text'>{$red['tekst']}</div><br>";
                                
                    
                                echo "<label for='kategorijaProizvoda'>Kategorija proizvoda</label>";
                                // echo "<div><a href='proizvodi.php?kategorija={$red['kategorija']}'>{$red['naziv']}</a> | ".date("d.m.Y H:i",strtotime($red['vreme']))."</div> <br><br>";
                                echo "<div id='kategorijaProizvoda'><a href='proizvodi.php?kategorija={$red['kategorija']}'>{$red['naziv']}</a> </div> <br>";

                                echo "<label for='kolicina'>Količina</label><br>";
                                echo "<input id='kolicina' type='number' name='komada' id='komada' value='1'><br><br>";

                                echo "<label for='cenaProizvoda'>Cena proizvoda</label>";
                                echo "<div id='cenaProizvoda' >{$red['cena']},00 din</div><br>";
                            echo "</div>";

                        echo "<button class='btn-order'>Poruči proizvod</button>";
                    echo "</div>";
                    }

                    // Slike
                    $upit="SELECT * FROM shop_proizvodi_slike WHERE idProizvoda={$idProizvoda}"; 
                    $rezultat=mysqli_query($db, $upit);

                    // Uslov - Ako postoje slike u bazi onda ih prikazujemo
                    if(mysqli_num_rows($rezultat)>0){

                        // PHP nacin prikazivanja slika iz baze podataka i foldera u kome se fizicki nalaze
                        // echo "<div class='images' id='galerija'>";
                        //     echo "<div class='images-big' id='imgBig'>";
                        //         $red=mysqli_fetch_assoc($rezultat);
                                 
                        //         echo "<img src='../img/product_photos/{$red['imeSlike']}' alt=''>";
                        //     echo "</div>";

                        //     echo "<di class='images-small' id='imgSmall'>";
                          
                        //         $rezultat=mysqli_query($db, $upit);
                        //         while($red=mysqli_fetch_assoc($rezultat))  {
                        //             echo "<img src='../img/product_photos/{$red['imeSlike']}' alt=''>";
                        //         }  
                        //     echo "</div>";
                        // echo "</div>"; 
                            
                        // Od PHP podataka koje citamo iz baze pravimo JS script tj JS NIZ i dalje se u JS referenciramo na promenljivu LET SLIKE
                        echo "<script> let slike=[";
                            $rezultat=mysqli_query($db, $upit);
                            while($red=mysqli_fetch_assoc($rezultat))  {
                                echo "'../img/product_photos/{$red['imeSlike']}',";
                            } 
                        echo "];</script>"; 

                    }   
                }
                else
                    echo poruka("Proizvod koji ste odabrali nije trenutno dostupan.", 2);
            ?>
            </div>
        </div>

        <section class="komentari">
            <div class="container">
                <div class="btn-komentari"  >
                    <button type="button" class="btn-order" onclick="prikaziFormu()">Dodaj komentar za proizvod</button>
                </div>
                <div class="komentari-sadrzaj" id="komentari-sadrzaj">
                   
                    <div class="komentari-sadrzaj-komentari" id="komentari-sadrzaj-komentari">
                        <h1>Komentari</h1>

                    </div>

                    <div class="komentari-sadrzaj-forma" id="komentari-sadrzaj-forma">
                        <form action="proizvod.php?id=<?php $_GET['id'] ?>" method="POST" id="komentarForma" onsubmit="return proveriKomentar()">
                            <input type="text" id="ime" placeholder="Unesite ime"><br><br>
                            <textarea name="komentar" cols="30" rows="10" id="komentar" placeholder="Unesite komentar"></textarea><br><br>
                            <div class="message">
                                <div class="message-content" id="messageContent">   </div> 
                            </div>
                            <button class="btn-order" >Dodaj komenatar</button>
                        </form>
                    </div>
    
                </div>
            </div>
               
        </section>
    </div>
    <!-- Main -->

  

   <?php require_once('../_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../js/script.js"></script>

    <script src="../js/galerija.js"></script>
</div>
</body>

</html>