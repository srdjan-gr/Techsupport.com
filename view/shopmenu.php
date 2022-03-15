<?php 
    require_once('../obaveznifajlovi.php');
    $db=new Baza;
    if(!$db->connect()) {
        echo "Neuspela konekcija na bazu";
        exit();
    } 
?>
<!-- SHOP stranica - Meni sa leve strane kategorije. Sluzi kao glavni meni za Mobilne uredjaje. Sluzi za meni DASHBOARDA -->
<div class="aside-shop">
    <ul class="shop-menu">
        <?php             
            $upit = "SELECT * FROM shop_kategorije WHERE obrisan=0";
            $rezultat = mysqli_query($db=konekcija(), $upit);

            while($red=mysqli_fetch_assoc($rezultat)){
                echo "<li><a href='proizvodi.php?kategorija={$red['id']}'>{$red['naziv']}</a></li>";
            }
        ?>

    </ul>
</div>
