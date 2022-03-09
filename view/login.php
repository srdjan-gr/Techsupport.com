<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }

    statistika($db);
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
    <?php require_once('_shopkategorije.php')?>


    <!-- Main -->
    <div class="main">
        <div class="container">

            <div class="card">
                <div class="login">
                    <div class="login-header">
                        <h2>Login stranica</h2>
                    </div>   
                
                    <!-- <div class="poruka">  </div> -->
                    <form action="login.php" method="POST">
                        <input type="text" name="email" placeholder="Email...">
                        <input type="password" name="lozinka" placeholder="Lozinka...">
                        <div class="checkbox">
                            <input type="checkbox" name="pamcenje">
                            <p>Zapamti me</p>
                        </div>

                         
                        <div class="message">  <?php loginForm(); ?> </div> 
                        <button class="btn-login">Login</button>
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