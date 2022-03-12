<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">

    <title>TechSupport | Home</title>
</head>

<body>
<div class="color-overlay">

    <?php require_once('../_header.php')?>
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>
    
    <!-- Main -->
    <div class="main">
        <div class="container">
            <div class="shop-main">
                <?php require_once('shopcards.php')?>  
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