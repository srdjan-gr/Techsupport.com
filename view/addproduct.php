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

    $poruka="";
?>

<!DOCTYPE html>
<html lang="sr">

<head>
 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    
    <title>TechSupport | Dodavanje Korisnika</title>
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
                
                <div class="big-card">
                    <div class="big-card-header">
                        <h2>Dodavanje Proizvoda</h2>
                    </div>
                    
                    <form action="addproduct.php" method="POST" enctype="multipart/form-data">
        
                        <input type="text" name="naslov" placeholder="Ime Proizvoda...">
                        <!-- <input type="text" name="prezime" placeholder="Prezime korisnika...">
                        <input type="email" name="email" placeholder="Email korisnika..."> -->
                        <textarea name="tekst" id="" cols="30" rows="6" placeholder="Opis proizvoda..."></textarea>
                        <input type="text" name="cena" placeholder="Cena proizvoda...">
                        
                        <select name="kategorija" id="kategorija">
                            <option value="0">Izaberite kategoriju proizvoda...</option>
                            <?php
                                $upit="SELECT * FROM shop_kategorije ORDER BY naziv ASC";
                                $rezultat=mysqli_query($db=konekcija(), $upit);

                                while($red=mysqli_fetch_assoc($rezultat)){
                                    echo "<option value=' {$red['id']} '> {$red['naziv']} </option>";
                                }

                            ?>
                        </select>

                        <label for="file-input" class="file-input" >Slika proizvoda...</label>
                        <input type="file" name="slike[]" multiple id="file-input" >
                    
                        <div class="big-card-footer">
                            <button class="btn">Dodaj proizvod</button>
                        </div>
                        
                        <?php dodavanjeProizvoda();?>

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