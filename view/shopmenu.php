<?php 
    require_once('../obaveznifajlovi.php');
    $db=new Baza;
    if(!$db->connect()) {
        echo "Neuspela konekcija na bazu";
        exit();
    } 
?>

<div class="aside-shop">
    <ul class="shop-menu">
        <?php

            $upit = "SELECT * FROM shop_kategorije";
            $rezultat = $db->query($upit);

            while($red=$db->fetch_object($rezultat)){
                echo "<li><a href='proizvod.php?id={$red->id}'>{$red->naziv}</a></li>";
            }
        ?>

    <!-- <li><a href="#" class="highlight">Tech podloge za miša</a></li> -->
    </ul>
</div>
