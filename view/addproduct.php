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
                        <h2>Dodavanje Korisnika</h2>
                    </div>
                    
                    <form action="adduser.php" method="POST" enctype="multipart/form-data">
                        <!-- <label style="padding: 0px; margin:0px" for="ime">*</label> -->
                        <input type="text" name="ime" placeholder="Ime korisnika...">
                        <input type="text" name="prezime" placeholder="Prezime korisnika...">
                        <input type="email" name="email" placeholder="Email korisnika...">
                        <textarea name="komentar" id="" cols="30" rows="6" placeholder="Komentar..."></textarea>
                        <input type="password" name="lozinka" placeholder="Lozinka...">
                        
                        <select name="status" id="status">
                            <option value="0">Odaberi Status korisnika...</option>
                            <option value="Urednik">Urednik</option>
                            <option value="Korisnik">Korisnik</option>
                            <option value="Admin">Admin</option>
                        </select>

                        <label for="file-input" class="file-input" >Odaberi sliku Avatara...</label>
                        <input type="file" name="avatar" id="file-input" >
                    
                        <div class="big-card-footer">
                            <button class="btn">Dodaj Korisnika</button>
                        </div>
                        
                        <?php dodavanjeKorisnika();?>

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