<?php 
    require_once('../obaveznifajlovi.php');
    $db=new Baza;
    if(!$db->connect()) {
        echo "Neuspela konekcija na bazu";
        exit();
    } 
?>

<!-- SHOP stranica - Meni ispod logovanog usera koji prikazije sve kategorije -->
<div class="nav-sub">
    <ul class="container">

        <?php
            $upit = "SELECT * FROM shop_kategorije ";
            $rezultat = mysqli_query($db=konekcija(), $upit);

            while($red=mysqli_fetch_assoc($rezultat)){

                echo "<li><a href='proizvodi.php?kategorija={$red['id']}'>{$red['naziv']}</a></li>";
            }
        ?>

    </ul>
</div>
