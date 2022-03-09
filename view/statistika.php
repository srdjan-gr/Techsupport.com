<?php
    session_start();
    require_once('../obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }

    nisteUlogovani();
    nisteUlogovaniAdmin();
    statistika($db);

    $poruka="";
    $logPoruka="";
?>

<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    
    <title>TechSupport | Statistika</title>
</head>

<body>
<div class="color-overlay">

    <?php require_once('../_header.php')?>
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>

    <!-- Main -->
    <div class="main-dashboard">
        <div class="container">
            <div class="single-card" >
                <?php require_once('dashmenu.php')?>
                
                <div class="small-card">
                    <h2>Statistika - LOG</h2>
                    <form action="statistika.php" method="POST">
                        <input type="date" name="datum"><br><br>
                        <select name="log" id="log">
                            <option value="0">Odaberite LOG fajl</option>
                            <option value="logovanja.log">Logovanje .log</option>
                            <option value="komentari.log">Komentari .log</option>
                            <option value="proizvodi.log">Proizvodi .log</option>
                        </select>
                        <button class="btn-login">Pogledaj Log</button>
                    </form>   

                    <div class="message"> <?= $poruka?> </div>
                    <a href="#"></a>
                </div>
                <!-- <div><?php $logIzvestaj?></div> -->
            </div>
        </div>
    </div>

    <section>
        <div class="height">
            <div class="container">
                <div class="content-dash">
                    <div class="content-dash-1">
                         <?php statistikaLog()?>
                    </div>
                 </div>
            </div>
        </div>
    </section>
    <!-- Main -->

   <?php require_once('../_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</div>   
</body>

</html>