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
        
                    <form action="login.php" method="POST" onsubmit="return proveriFormu()">
                        <input type="text" name="email" id="email" placeholder="Email...">
                        <br>
                        <input type="password" name="lozinka" id="lozinka" placeholder="Lozinka...">
                        <div class="checkbox">
                            <input type="checkbox" name="pamcenje">
                            <p>Zapamti me</p>
                        </div>
                        
                        <div class="message">
                            <div class="message-content" id="messageContent">  <?php loginForm();?>   </div> 
                        </div>
                        
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
    <script src="../js/script.js"></script>
</div>  
</body>

</html>