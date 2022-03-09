<?php
    // session_start();
    require_once('obaveznifajlovi.php');
    $db= new Baza();
    if(!$db->connect()){
        echo "Neuspela konekcija na bazu";
        exit();
    }

    statistika($db);
?>

<!-- Nav start -->
<nav>
    <div class="nav-main">

        <a href="index.php"><h1 class="logo-txt" >TechSupport<span class="highlight" >.com</span></h1></a>
        
        <div class="middle">
            <ul>
                <span class="desc">
                    <ion-icon name="headset-outline"></ion-icon>
                    <li> <a href="#">Podcast</a></li>
                </span>
                <span class="desc">
                    <ion-icon name="videocam-outline"></ion-icon>
                    <li> <a href="#">Video</a></li>
                </span>
                <span class="desc">
                    <ion-icon name="phone-portrait-outline"></ion-icon>
                    <li> <a href="#">Aplikacije</a></li>
                </span>
                <span class="desc">
                    <ion-icon name="tv-outline"></ion-icon>
                    <li> <a href="#">Tv</a></li>
                </span>
                <span class="desc">
                    <li> <a href="#" class="ml-15">Blog</a></li>
                    <li> <a href="#" class="ml-15">English</a></li>
                </span>
               
            </ul>
        </div>

        <div class="shop">
            <li> <a href="shop.php" class="highlight">SHOP</a></li>
            <!-- <li> <a href="login.php" class="">Login</a></li> -->
            <?php
                if(login())
                {
                    echo "<li> <a href='logout.php' class=''>Logout</a></li>";
                }
                else
                    echo "<li> <a href='login.php' class=''>Login</a></li>";

            ?>
            <ion-icon name="menu-outline" class="menu"></ion-icon>

        

        </div>

      
    </div>
</nav>
<!-- Nav end -->