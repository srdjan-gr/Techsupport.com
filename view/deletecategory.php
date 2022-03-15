<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }

    nisteUlogovani();

    ulogovanDashboard();

    statistika($db);

    // brisanjeKorisnika();

    $poruka="";
?>

<!DOCTYPE html>
<html lang="sr">

<head>
 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    
    <title>TechSupport | Brisanje Korisnika</title>
</head>

<body>
<div class="color-overlay">
    <?php require_once('../_header.php')?>
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>

    <!-- Main -->
    <div class="main">
        <div class="container">
            <div class="single-card" >
                <?php require_once('dashmenu.php')?>
                
                <div class="small-card">
                    <h2>Brisanje Kategorije</h2>

                    <?= brisanjeKategorije();?>
                    <form action="deletecategory.php" method="POST">

                        <select name="idKategorije" id="idKategorije">
                            <option value="0">Odaberite Kategoriju za brisanje...</option>
                            <?php
                                $upit="SELECT * FROM shop_kategorije WHERE obrisan=0 ORDER BY id ASC";
                                $rezultat=mysqli_query($db=konekcija(), $upit);  

                                while($red=mysqli_fetch_assoc($rezultat)){
                                echo "<option value='{$red['id']}'> {$red['id']}: {$red['naziv']} </option>" ;
                                }
                            ?>
                        </select>

                        <button class="btn-login">Obriši Kategoriju</button>

                    </form>
                    <a href="#"></a>
                </div>
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