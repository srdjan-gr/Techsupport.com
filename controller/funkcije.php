<?php

// Funkcija - Konekcija na bazu sa proverom gresaka
function konekcija(){
    $db=@mysqli_connect("localhost:3309", "root", "", "ita_techsupport");

    if(!$db){
        echo "Greska prilikom konekcije na bazu <br>";
        echo mysqli_connect_error()."<br>";
        echo mysqli_connect_errno();
        return false;
    }
    mysqli_query($db, "SET NAMES utf8");
    return $db;
}

// Funkcija proverava da li je String manji od 3 karaktera
// Funkcija koja proverava da li string sadrzi nedozovljene karaktere iz niza Nedozvoljeni
function validanString($str){
    if(strlen($str)<3) return false;

    $nedozvoljeni=array("="," ","/","%","(",")","[","]","'",'"',);
    foreach($nedozvoljeni as $v)
        if(strpos($str, $v)!==false) return false;
    return true; 
}

// Funkcija Poruka
// Boji poruku odgovarajucom bojom
// Zahteva Dva ulazna parametra, prvi string sa nasom porukom, drugi broj poruke
function poruka($str, $opcija){
    if($opcija==0) $boja="#e74c3c";
    if($opcija==1) $boja="#18bc9c";
    if($opcija==2) $boja="#3498db";

    return "<div class='poruka' style='background-color:$boja;'>$str</div>";
}

// Funkcija koja upisuje u tabelu Statistika podatke koje mozemo da koristimo za statistiki
// Moze da se prosiri jos raznim upitima 
function statistika ($db, $tekst=NULL){
    $upit = "INSERT INTO statistika (ipadresa, stranica, parametri, tekst) VALUES ('{$_SERVER['REMOTE_ADDR']}', '{$_SERVER['SCRIPT_NAME']}', '{$_SERVER['QUERY_STRING']}', '{$tekst}')";

    mysqli_query($db=konekcija(), $upit);

    if(mysqli_error($db)){
        echo "Doslo je do greske!!! <br>". mysqli_error($db). "<br>";
    }

}

// Funkcija za Statistiku - Log fajlovi
function statistikaLog(){
    if(isset($_POST['datum']) and isset($_POST['log'])){

        $datum=$_POST['datum'];
        $log=$_POST['log'];
        
        if($datum!="" and $log!='0'){

            $imeDatoteke="../logs/".$datum."_".$log;
            if(file_exists($imeDatoteke)){
                echo nl2br(file_get_contents($imeDatoteke));
            }
            else
                echo poruka("Ne postoji ni jedan zapis u '{$imeDatoteke}'", 2);
        }  
        else
            echo poruka("Svi podaci su obavezni.", 2);      
    }
}


// Logovanje - Forma za logovanje sa proverama i pokretanje Sesije za Korisnika
function loginForm(){
    if(isset($_POST['email']) and isset($_POST['lozinka'])){

        $email=$_POST['email'];
        $lozinka=$_POST['lozinka'];

        if($email!="" and $lozinka!=""){

            if(validanString($email) and validanString($lozinka)){

                $upit="SELECT * FROM korisnici WHERE email='{$email}'";
                $rezultat=mysqli_query($db=konekcija(), $upit);

                if(mysqli_num_rows($rezultat)==1){

                    $red=mysqli_fetch_assoc($rezultat);
                    if($red['lozinka']==$lozinka){

                        if($red['aktivan']==1){

                            if($red['status']=='Admin' or $red['status']=='Urednik'){
                                $_SESSION['id']=$red['id'];
                                $_SESSION['korisnik']=$red['ime']. " ".$red['prezime'];
                                $_SESSION['status']=$red['status'];

                                // Upis u log fajl kada se i koji korisnik prijavio - Ulogovao
                                Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Uspešna prijava za korisnika '{$_SESSION['korisnik']}'");

                                // Ako je sve proslo i selektovan je checkbox, pravimo Cookie
                                if(isset($_POST['pamcenje'])){
                                    setcookie("id", $_SESSION['id'], time()+3600, "/");
                                    setcookie("korisnik", $_SESSION['korisnik'], time()+3600, "/");
                                    setcookie("status", $_SESSION['status'], time()+3600, "/");
                                }

                                header("Location:dashboard.php");
                            }
                            else if($red['status']=='Korisnik'){
                                $_SESSION['id']=$red['id'];
                                $_SESSION['korisnik']=$red['ime']. " ".$red['prezime'];
                                $_SESSION['status']=$red['status'];

                                // Ako je sve proslo i selektovan je checkbox, pravimo Cookie
                                if(isset($_POST['pamcenje'])){
                                    setcookie("id", $_SESSION['id'], time()+3600, "/");
                                    setcookie("korisnik", $_SESSION['korisnik'], time()+3600, "/");
                                    setcookie("status", $_SESSION['status'], time()+3600, "/");
                                }

                                header("Location:shop.php");
                            }
                        }
                        else{
                            echo poruka("Korisnik '{$email}' nije aktivan iz razloga '{$red['komentar']}'", 0);
                            echo poruka("<a href='#' style='text-decoration: underline;'>Kontaktirajte Administratora</a>", 2);
                            Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Pokušaj prijave neaktivnog korisnika: '{$red['email']}'");
                        }     
                    }
                    else{
                        echo poruka("Neispravna lozinka za korisnika <br> '{$email}'", 0);
                        Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Pogrešna lozinka za korisnika: '{$red['email']}'");
                    }  
                }
                else{
                    echo poruka("Korisnik sa email adresom <br> '{$email}' ne postoji.", 2);
                    Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Pokušaj logovanja neregistrovanog korisnika: '{$email}'");
                }
            }
            else{
                echo poruka("Email ili Lozinka sadrže <br> nedozvoljene karaktere!!!", 0);
                echo poruka("/, ?, <, >, ...", 0);
                Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Podaci sadrže nedozvoljene karaktere: '{$email}' '{$lozinka}' {$_SERVER['REMOTE_ADDR']} ");
            }  
        }
        else
            echo poruka("Svi podaci su obavezni.", 2);
    }
}

// Provera da li postoje Promenljive sesije (Korisnik prijavljen ili ne)
// Provera da li postoje Cookie
function login(){
    if(isset($_SESSION['id']) and isset($_SESSION['korisnik']) and isset($_SESSION['status'])){
        return true;
    }
    else if(isset($_COOKIE['id']) and isset($_COOKIE['korisnik']) and isset($_COOKIE['status'])){

        // ovaje deo moze da bude samo return:true ALI
        // Ovo znaci - Ako ne postoje Sesije a postoje Kolacici znace se da je korisnik ulogovan, i     prikazace se korisnik na cijem racunaru su pronadjeni Kolacici. Zato je Sesija=Kolacic
        $_SESSION['id']=$_COOKIE['id'];
        $_SESSION['korisnik']=$_COOKIE['korisnik'];
        $_SESSION['status']=$_COOKIE['status'];

        return true;
    }
    else{
        return false;
    }
}

// Funkcija koja proverava da li je korisnik ulogovan
// Ako jeste, salje ga na stranu iz linka ako nije izbacuje poruku da mora da se uloguje 
function nisteUlogovani(){

    if(!login()){
        // echo poruka("Morate biti ulogovani da biste videli ovu stranicu", 0) ;
        // echo "<br>";
        // echo "<a href='login.php'>Prijavite se</a>"; 
        header("Location:_backToLogin");
        echo exit();
    }
}

// Funkcija koja proverava da li je korisnik Admin, da bi mogao da pristupi nekim delovima sajta koji su samo za Admin-a
function nisteUlogovaniAdmin(){
    if($_SESSION['status']!='Admin'){
        // echo poruka("Morate biti ulogovani kao 'Administrator' da biste dodali novog korisnika", 0) ;
        // echo "<br>";
        // echo "<a href='login.php'>Prijavite se</a> <br>"; 
        // echo "<a href='shop.php'>SHOP</a>"; 
        header("Location:_backToLogin");
        echo exit();
    }
}


// Funkcija koja proverava da li je korisnik Admin ili Urednik za pristup Dashboardu
function ulogovanDashboard(){
    if($_SESSION['status']!=='Admin' and $_SESSION['status']!=='Urednik'){
 
        header("Location:_backToLogin");
        echo exit();
    }   
}


// Funkcija za dodavanje novog korisnika - Novog korisnika moze da doda samo admin
function dodavanjeKorisnika(){

    if(isset($_POST['ime']) and isset($_POST['prezime']) and isset($_POST['email']) and isset($_POST['lozinka']) and isset($_POST['status'])){

        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $email=$_POST['email'];
        $komentar=$_POST['komentar'];
        $lozinka=$_POST['lozinka'];
        $status=$_POST['status'];

        // Fali provera Nedozvoljeni Karatketi

        if($ime!="" and $prezime!="" and $email!="" and $lozinka!="" and $status!="0"){

            if(validanString($email) and validanString($lozinka) and validanString($prezime) and validanString($ime)){

                $upit="SELECT * FROM korisnici WHERE email='{$email}'";
                $rezultat=mysqli_query($db=konekcija(), $upit);
    
                if(mysqli_num_rows($rezultat)==0){
    
                    $upit= "INSERT INTO korisnici (ime, prezime, email, lozinka, komentar, status) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$lozinka}', '{$komentar}', '{$status}')"; 
    
                    mysqli_query($db=konekcija(), $upit);
        
                    if(!mysqli_error($db)){
        
                        if($_FILES['avatar']['name']!=""){
        
                            $ime=$_FILES['avatar']['name'];
                            $tmp_ime=$_FILES['avatar']['tmp_name'];
                            $greska=$_FILES['avatar']['error'];
                            $velicina=$_FILES['avatar']['size'];
                            
                            if($greska==0){
        
                                if($velicina<1220000){
        
                                    // Dozvoljene extenzije
                                    $dozvoljene=array("jpg", "jpeg", "png");
                                    if(in_array(pathinfo($ime, PATHINFO_EXTENSION), $dozvoljene)){
        
                                        $slika=getimagesize($tmp_ime);
                                        if($slika[0]<=400 and $slika[1]<=400){
        
                                            $imeAvatara=mysqli_insert_id($db).".png";
        
                                            if(@move_uploaded_file($_FILES['avatar']['tmp_name'], "../img/avatars/{$imeAvatara}")){
        
                                                echo poruka("Korisnik je uspešno kreiran sa profilnom slikom.", 1);
                                                Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno kreiran korisnik: '{$email}', Korisnika kreirao: '{$_SESSION['korisnik']}'");
                                            }
                                            else{
                                                echo poruka("Korisnk kreiran bez profilne slike.", 1);
                                                // Ne radi
                                                echo poruka("Greška!!! Profilna slika nije postavljena.", 0); 
                                                Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno kreiran korisnik bez avatara: '{$email}', Korisnika kreirao: '{$_SESSION['korisnik']}'");
                                            }
                                        }   
                                        else{
                                            echo poruka("Korisnk kreiran bez profilne slike.", 1);
                                            // Ne radi
                                            Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno kreiran korisnik bez avatara - Velika slika: '{$email}', Korisnika kreirao: '{$_SESSION['korisnik']}'");
                                            echo poruka("Maksimalna veličina slike Avatara je 400x400 pixela.", 2);  
                                        }
                                    }
                                    else{
                                        echo poruka("Korisnk kreiran bez profilne slike.", 1);
                                        Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno kreiran korisnik bez avatara - Nepodrzana ekstenzija fajla: '{$email}', Korisnika kreirao: '{$_SESSION['korisnik']}'");
                                        echo poruka("Neodgovarajući tip slike. Dozvoljene extenzije su '.jpg, .jpeg i .png'", 2);
                                       
                                    }    
                                }
                                else
                                    echo poruka("Veličina slike prelazi dozvoljenih 12MB.", 2);
                            }
                            else
                                echo poruka("Greska prilikom uploada slike. <br> Broje greske: {$greska}", 2);
                        } 
                        else
                            echo poruka("Korisnik uspešno dodat <br> bez profilne slike sa ID: " .mysqli_insert_id($db), 1);
                    }
                    else {
                        echo poruka("Neuspelo izvršenje upita.", 0);
                        Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Neuspešno dodavanje korisnika: '{$email}' - '{mysqli_error($db)}' ");
                        // echo poruka(mysqli_error($db), 0);
                    } 
                }
                else
                    echo poruka("Korisnik sa email adresom '{$email}' već postoji.", 0); 
            }
            else{
               echo poruka("Podaci sadrže nedozvoljene karaktere!!!", 0); 
               echo poruka("/ : ; < > ...", 2); 
            }
        }
        else
            echo poruka("Sva polja osim polja 'Komentar' su obavezna za kreiranje korisnika.", 2);
    }
}

// Brisanje korisnika
function brisanjeKorisnika(){

    if(isset($_POST['idKorisnik'])){

        $idKorisnik=$_POST['idKorisnik'];

        if($idKorisnik!=0){

            $upit="UPDATE korisnici SET obrisan=1 WHERE id={$idKorisnik}";
            mysqli_query($db=konekcija(), $upit);

            if(mysqli_error($db)){
                echo poruka("Greška prilikom brisanja korisnika!!!", 0);
                Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Greška prilikom brisanja korisnika!!!: '{$idKorisnik}' - mysqli_error($db) ");
                echo poruka(mysqli_error($db), 0);
            }
            else
                echo poruka("Korisnik je uspešno obrisan.", 1);
                Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno obrisan korisnik: '{$idKorisnik}', Korisnika obrisao: '{$_SESSION['korisnik']}'");
                if(file_exists("../img/avatars/{$idKorisnik}.png")) unlink("../img/avatars/{$idKorisnik}.png");

                // $upit="UPDATE proizvodi SET obrisan=0 WHERE autor={$idKorisnik} ";
                $upit="UPDATE shop_proizvodi SET obrisan=1 WHERE autor={$idKorisnik} ";
                mysqli_query($db=konekcija(), $upit);

                if(mysqli_error($db)){
                    echo poruka("Greška prilikom brisanja Proizvoda za Korisnika!!!", 0);
                    echo poruka(mysqli_error($db), 0);
                }
                else{
                    echo poruka("Svi Proizvodi za korisnika <br> su uspešno obrisani.", 1);
                    Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno obrisani proizvodi zajedno sa korisnikm: '{$idKorisnik}', Korisnika obrisao: '{$_SESSION['korisnik']}'");
                }
                    

        }
        else
            echo poruka("Niste odabrali Korisnika za brisanje.", 2);
    }
}

// Dodavanje proizvoda
function dodavanjeProizvoda(){

    if(isset($_POST['naslov']) and isset($_POST['tekst']) and isset($_POST['cena']) and isset($_POST['kategorija']))
    {
        $naslov=$_POST['naslov'];
        $tekst=$_POST['tekst'];
        $cena=$_POST['cena'];
        $kategorija=$_POST['kategorija'];
        // $slike=$_FILES['slike'];

        if($naslov!="" and $tekst!="" and $cena!="" and $kategorija!="0" ){

            $upit="INSERT INTO shop_proizvodi (naslov, tekst, cena, kategorija, autor) VALUES ('{$naslov}', '{$tekst}', {$cena}, '{$kategorija}', '{$_SESSION['id']}')";
            mysqli_query($db=konekcija(), $upit);
            
            if(!mysqli_error($db))
            {
               echo poruka("Uspešno dodat proizvod.", 1);

                // Dodati u LOG gde je dodat u koju kategoriju, kako se zove i koja je cena stavljena za proizvod
               Log::upisi("../logs/".date("Y-m-d")."_proizvodi.log", "Proizvod '{$naslov}' uspešno dodat od strane: '{$_SESSION['korisnik']}'");

               if(isset($_FILES['slike']['name'][0])){
                    
                   $idProizvoda=mysqli_insert_id($db);

                   for($i=0; $i<count($_FILES['slike']['name']); $i++){

                        $imeSlike=$idProizvoda."-".microtime(true)."_".$_FILES['slike']['name'][$i];

                        // Ovde treba ubaciti proveru za slike
                        if(@move_uploaded_file($_FILES['slike']['tmp_name'][$i], "../img/product_photos/".$imeSlike)){
                       
                        $upit="INSERT INTO shop_proizvodi_slike (idProizvoda, imeSlike) VALUES ('{$idProizvoda}', '{$imeSlike}')";
                        mysqli_query($db=konekcija(), $upit);



                       }
                   }
               }
            }
            else
            {
                echo poruka("Greška prilikom dodavanja proizvoda.", 0);
                echo poruka(mysqli_error($db), 0);
                Log::upisi("../logs/".date("Y-m-d")."_proizvodi.log", "Neuspešpno dodavanje proizvoda '{$naslov}' od strane: '{$_SESSION['korisnik']}'");
            }
        }
        else 
        {
            echo poruka("Svi podaci su neophodni!!!", 2);
            Log::upisi("../logs/".date("Y-m-d")."_proizvodi.log", "Nisu uneti svi podaci za proizvod od strane: '{$_SESSION['korisnik']}'");
        }
    }
}

// Funkcija za Brisanje proizvoda iz baze
function brisanjeProizvoda(){

    if(isset($_POST['idProizvoda'])){

        $idProizvoda=$_POST['idProizvoda'];

        if($idProizvoda!=0){

            $upit="UPDATE shop_proizvodi SET obrisan=1 WHERE id={$idProizvoda}";
            mysqli_query($db=konekcija(), $upit);

            if(mysqli_error($db)){
                echo poruka("Greška prilikom brisanja korisnika!!!", 0);
                Log::upisi("../logs/".date("Y-m-d")."_proizvodi.log", "Greška prilikom brisanja proizvoda!!!: '{$idProizvoda}' - mysqli_error($db) ");
                echo poruka(mysqli_error($db), 0);
            }
            else
                $upit="SELECT * FROM shop_proizvodi WHERE obrisan=1";
                $rezultat=mysqli_query($db=konekcija(), $upit);
                $red=mysqli_fetch_assoc($rezultat);

                echo poruka("Proizvod je uspešno obrisan.", 1);
                Log::upisi("../logs/".date("Y-m-d")."_proizvodi.log", "Uspešno obrisan Proizvod: '{$red['naslov']}', Obrisao: '{$_SESSION['korisnik']}'");
                // if(file_exists("../img/product_photos/{$idProizvoda}.png")) unlink("../img/product_photos/{$idProizvoda}.png");

                // $upit="UPDATE shop_proizvodi SET obrisan=1 WHERE autor={$idProizvoda} ";
                // mysqli_query($db=konekcija(), $upit);

                // if(mysqli_error($db)){
                //     echo poruka("Greška prilikom brisanja Proizvoda za Korisnika!!!", 0);
                //     echo poruka(mysqli_error($db), 0);
                // }
                // else{
                //     echo poruka("Svi Proizvodi za korisnika <br> su uspešno obrisani.", 1);
                //     Log::upisi("../logs/".date("Y-m-d")."_korisnici.log", "Uspešno obrisani proizvodi zajedno sa korisnikm: '{$idKorisnik}', Korisnika obrisao: '{$_SESSION['korisnik']}'");
                // }
                    

        }
        else
            echo poruka("Niste odabrali Proizvod za brisanje.", 2);
    }
}

function dodavanjeKategorije(){

    if(isset($_POST['imeKategorije'])){

        $imeKategorije=$_POST['imeKategorije'];
        // $slikaKategorije=$_POST['slikaKategorije'];

        if($imeKategorije!=""){

            $upit="INSERT INTO shop_kategorije (naziv, autor) VALUES ('{$imeKategorije}', '{$_SESSION['korisnik']}')";
            mysqli_query($db=konekcija(), $upit);

            if(!mysqli_error($db)){

                echo poruka("Uspešno dodata Kategorija: '{$imeKategorije}'.", 1);

                Log::upisi("../logs/".date("Y-m-d")."_kategorije.log", "Kategorija '{$imeKategorije}' uspešno dodata od strane: '{$_SESSION['korisnik']}'");
            }
            else{
                echo poruka("Greška prilikom dodavanja Kategorije.", 0);
                echo poruka(mysqli_error($db), 0);
                Log::upisi("../logs/".date("Y-m-d")."_kategorije.log", "Neuspešpno dodavanje Kategorije '{$imeKategorije}' od strane: '{$_SESSION['korisnik']}'");
            }

            if($_FILES['slikaKategorije']['name']){

                $idKategorije=mysqli_insert_id($db);
                $imeSlike=$idKategorije."-".microtime(true)."_".$_FILES['slikaKategorije']['name'];

                // Ovde treba ubaciti proveru za slike
                if(@move_uploaded_file($_FILES['slikaKategorije']['tmp_name'], "../img/product_category_photos/".$imeSlike)){
                
                $upit="INSERT INTO shop_kategorije_slike (idKategorije, imeSlike) VALUES ('{$idKategorije}', '{$imeSlike}')";
                mysqli_query($db=konekcija(), $upit);



                }
               
           }
        }
        else
            echo poruka ("Svi podaci su neophodni.", 2);
    }
}



function brisanjeKategorije(){

    if(isset($_POST['idKategorije'])){

        $idKategorije=$_POST['idKategorije'];

        if($idKategorije!=0){

            $upit="UPDATE shop_kategorije SET obrisan=1 WHERE id={$idKategorije}";
            mysqli_query($db=konekcija(), $upit);

            if(mysqli_error($db)){
                echo poruka("Greška prilikom brisanja Kategorije!!!", 0);
                Log::upisi("../logs/".date("Y-m-d")."_kategorije.log", "Greška prilikom brisanja proizvoda!!!: '{$idKategorije}' - mysqli_error($db)");
                echo poruka(mysqli_error($db), 0);
            }
            else{
                $upitkategorije="SELECT * FROM shop_kategorije WHERE obrisan=1";
                $rezultatk=mysqli_query($db=konekcija(), $upitkategorije);

                $red=mysqli_fetch_assoc($rezultatk);

                echo poruka("Kategorija je uspešno obrisana.", 1);
                Log::upisi("../logs/".date("Y-m-d")."_kategorije.log", "Uspešno obrisana Kategorija: '{$idKategorije}' - '{$red['naziv']}' , Obrisao: '{$_SESSION['korisnik']}'");
            }
            
                

        }
        else{
            echo poruka("Niste odabrali Kategoriju za brisanje.", 2);
        }
    }
}

