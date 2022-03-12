<?php
    include_once ('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>

<?php
 if(isset($_POST['termin'])) 
 $upit="SELECT * FROM pogledproizvodi WHERE naslov LIKE ('%{$_POST['termin']}%') OR tekst LIKE('%{$_POST['termin']}%')";

?>

<form class="search container" action="shop.php" method="POST" >
    <button><ion-icon name="search" size=""></ion-icon></button> 
    <input type="text" name="termin" placeholder="Pretraži...">
</form>
