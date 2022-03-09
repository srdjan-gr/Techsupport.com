<?php
    include_once ('obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="sr">

<head>
    <?php require_once('_head.php')?>
    <title>TechSupport | Home</title>
</head>

<body>
    <?php require_once('_header.php')?>
    <?php require_once('_kategorije.php')?>

    <!-- Main -->
    <div class="main">
        <div class="wrapper container">
  













        
        </div>
    </div>
    <!-- Main -->

   <?php require_once('_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>