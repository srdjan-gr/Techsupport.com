<?php
    require_once 'obaveznifajlovi.php';
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

    <?php require_once('_hero.php')?> 

    <!-- Main -->
    <div class="main">
        <div class="wrapper container">
            <?php require_once('_vesti.php')?>


            <?php require_once('_reklame.php')?>
        </div>
    </div>
  
    <!-- Main -->

   <?php require_once('_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>