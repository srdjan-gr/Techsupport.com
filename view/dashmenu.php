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
                echo "<li><a href='adduser.php' data-srp='Dodaj korisnika' data-eng='Add user'>Dodaj Korisnika</a></li>";
                echo "<li><a href='deluser.php'>Obriši Korisnika</a></li>";

                echo "<li><a href='addproduct.php'>Dodaj Proizvod</a></li>";
                echo "<li><a href='deleteproduct.php'>Obriši Proizvod</a></li>";
                echo "<li><a href='addcategory.php'>Dodaj Kategoriju</a></li>";
                echo "<li><a href='deletecategory.php'>Obriši Kategoriju</a></li>";

                echo "<li><a href='#'>Promeni Avatara</a></li>";
                echo "<li><a href='#'>Promeni Lozinku</a></li>";

                echo "<li><a href='statistika.php'>Statistika</a></li>";
                echo "<button onclick='promenijezik(\"eng\")'>Engleski<button> <button onclick='promenijezik(\"srp\")'>Srpski<button>";
                
            }

            if($_SESSION['status']=='Urednik'){

                echo "<h3>Administrator</h3>";
                echo "<hr><br>";
                echo "<li><a href='addproduct.php'>Dodaj Proizvod</a></li>";
                echo "<li><a href='deleteproduct.php'>Obriši Proizvod</a></li>";
                echo "<li><a href='addcategory.php'>Dodaj Kategoriju</a></li>";
                echo "<li><a href='deletecategory.php'>Obriši Kategoriju</a></li>";

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
<script>
    function promenijezik(jezik){
        let a=document.querySelectorAll("a");
        for(i=0;i<a.length;i++)
        if(a[i].getAttribute("data-"+jezik)) a[i].innerHTML=a[i].getAttribute("data-"+jezik);
    }
</script>
