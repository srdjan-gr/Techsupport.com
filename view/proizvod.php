<?php
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
    <?php require_once('korisnik.php')?>
    <?php require_once('_shopkategorije.php')?>

    <!-- Main -->
    <div class="main">
        <div class="wrapper container">

            <?php
                if(isset($_GET['id']))
                {
                    $upit="SELECT * FROM pogledproizvodi WHERE obrisan=0 AND id={$_GET['id']}";
                    $rezultat=$db->query($upit);
                    while($red=$db->fetch_assoc($rezultat))
                    {
                        echo "<div class='card-proizvod'>";
                            echo "<div><a href='index2.php?autor={$red['autor']}'>{$red['ime']} {$red['prezime']}</a></div>";
                            echo "<h2>{$red['naslov']}</h2>";
                            echo "<div>{$red['tekst']}</div><br>";
                            /*$tmp=explode(" ", $red['tekst']);
                            $niz=array_slice($tmp, 0, 10);
                            echo "<div>".implode(" ", $niz).".....</div>";*/
                            echo "<div><a href='index2.php?kategorija={$red['kategorija']}'>{$red['naziv']}</a> | ".date("d.m.Y H:i",strtotime($red['vreme']))."</div>";
                        echo "</div>";
                    }
                }
                else
                    echo poruka("Niste odabrali proizvod !!!", 2);
            ?>

        </div>
    </div>
    <!-- Main -->

   <?php require_once('../_footer.php')?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</div>
</body>

</html>