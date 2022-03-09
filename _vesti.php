<section>
    <div class="news">
        <div class="news-main">
            <img src="img/linux.jpg" alt="">
            <div class="text">
                <label for="">OS</label>
                <a href=""><h1>Linux, uvek u vrhu!</h1></a>
                <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Ex, cumque.</p>
            </div>
        </div>

        <!-- Dinamicki generisane kratke NajNovije vesti iz sekcije VESTI-->
        <div class="news-new">
            <h1>Poslednje vesti - info</h1>

                <?php 
                    for ($i=0; $i<3; $i++) { ?>

                        <div class="news-new-c">
                            <a href=""><h2><?php echo $lastNews[$i]['txt'] ?></h2></a>  
                        </div>

                <?php } ?>

        </div>
        <!-- Dinamicki generisane kratke NajNovije vesti iz sekcije VESTI-->
    </div>

    <!-- Grid - Glavne Vesti iz razlicitih Sekcija -->
    <div class="grid-container">
        <div class="grid">

            <?php
                for ($i=0; $i<10; $i++) { ?>
                    <div class="grid-content">
                        <div class="grid-content-coments">
                            <h3>12</h3>
                            <ion-icon name="chatbox"></ion-icon>
                        </div>
                        <div class="grid-content-text">
                            <label for="">Slika Autora</label>
                            <label for=""><?php echo $category[$i]['txt'] ?></label>
                            <a href="#">
                                <h1><?php echo $newsGrid[$i]['txt'] ?></h1>
                            </a>
                        </div>
                        <img src="img/news/<?php echo $newsGrid[$i]['img'] ?>" alt="">
                    </div>
            <?php } ?>   
                
        </div>
    </div>
    <!--Kraj Grid - Glavne Vesti iz razlicitih Sekcija -->
</section>