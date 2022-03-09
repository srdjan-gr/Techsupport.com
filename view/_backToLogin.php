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
    <!-- Main -->
    <div class="main">
  
        <div class="container">
            <div class="back-to-login">

                <?php
                    if(login()){

                        if($_SESSION['status']!='Admin'){
                            $poruka="Za dodavanje novog korisnika morate biti ulogovani kao Admin!!!";
                        }
                    }
                    else 
                        $poruka="Za pristup stranici morate biti ulogovani!!!";
                ?>

                <h1> <?=$poruka?> </h1>
                <a href='login.php'>Ulogujte se</a> 
            </div>
        </div> 
    </div>
    <!-- Main -->





    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</div>
</body>

</html>