<?php 
    require_once('../obaveznifajlovi.php');
    $db=new Baza;
    if(!$db->connect()) {
        echo "Neuspela konekcija na bazu";
        exit();
    } 

    $slika="";
?>

<div class="session-nav">
    <div class="container">
        <div class="user-session">
            <div class="session-info">
                <?php
                    if(isset($_SESSION['id']) and isset($_SESSION['korisnik']) and isset($_SESSION['status']))
                    {

                        $upit="SELECT * FROM korisnici WHERE obrisan=0";
                        $rezultat=mysqli_query($db=konekcija(), $upit);
                        // $red=mysqli_fetch_assoc($rezultat);

                        while($red=mysqli_fetch_assoc($rezultat)){
                                // var_dump($red);
                            if(file_exists("../img/avatars/{$red['id']}.png")){
                                $imeSlike="{$red['id']}.png";
                            }
                            else{
                                $imeSlike="_default.png";
                            }
                        }
                    
                        echo "<h2>{$_SESSION['korisnik']}</h2>"; 
                        echo "<h3>{$_SESSION['status']}</h3>"; 
                        $slika= "<img src='../img/avatars/{$imeSlike}' alt=''>";
                        
                    }
                    // var_dump($imeSlike);
                ?>
            </div>

            <?= $slika ?>
        </div>
    </div>
</div>
