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
    
    <title>TechSupport | Dodavanje Kategorije</title>
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
                    <div class="small-card-header">
                        <h2>Dodavanje Kategorije</h2>
                    </div>
                    
                    <form action="addcategory.php" method="POST" enctype="multipart/form-data">
        
                        <input type="text" name="imeKategorije" placeholder="Ime Kategorije...">
  
                        <label for="file-input" class="file-input" >Slika kategorije...</label>
                        <input type="file" id="file-input" name="slikaKategorije">
                    
                        <div class="big-card-footer ">
                            <button class="btn-login ">Dodaj kategoriju</button>
                        </div>
                        
                        <?php dodavanjeKategorije();?>

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