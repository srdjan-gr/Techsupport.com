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

            if($_SESSION['status']=='Admin'){

                echo "<h3>Administrator</h3>";
                echo "<hr><br>";
                echo "<li><a href='adduser.php'>Dodaj Korisnika</a></li>";
                echo "<li><a href='deluser.php'>Obriši Korisnika</a></li>";

                echo "<li><a href='addproduct.php'>Dodaj Proizvod</a></li>";
                echo "<li><a href='deleteproduct.php'>Obriši Proizvod</a></li>";
                echo "<li><a href='#'>Dodaj Kategoriju</a></li>";
                echo "<li><a href='#'>Obriši Kategoriju</a></li>";

                echo "<li><a href='#'>Promeni Avatara</a></li>";
                echo "<li><a href='#'>Promeni Lozinku</a></li>";

                echo "<li><a href='statistika.php'>Statistika</a></li>";
                
            }

            if($_SESSION['status']=='Urednik'){

                echo "<h3>Administrator</h3>";
                echo "<hr><br>";
                echo "<li><a href='addproduct.php'>Dodaj Proizvod</a></li>";
                echo "<li><a href='deleteproduct.php'>Obriši Proizvod</a></li>";
                echo "<li><a href='#'>Dodaj Kategoriju</a></li>";
                echo "<li><a href='#'>Obriši Kategoriju</a></li>";

                echo "<li><a href='#'>Promeni Avatara</a></li>";
                echo "<li><a href='#'>Promeni Lozinku</a></li>";
            }

            // if($_SESSION['status']=='Korisnik'){

            //     echo "<h3>Administrator</h3>";
            //     echo "<hr><br>";
            //     echo "<li><a href='#'>Promeni Avatara</a></li>";
            //     echo "<li><a href='#'>Promeni Lozinku</a></li>";
            // }

        ?>
    </ul>

</div>
