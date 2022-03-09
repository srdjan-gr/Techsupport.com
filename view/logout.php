<?php
  require_once('../obaveznifajlovi.php');
// Unistavanje Sesije kada se izlogujemo
session_start();
Log::upisi("../logs/".date("Y-m-d")."_logovanja.log", "Uspešna odjava za korisnika '{$_SESSION['korisnik']}'");
session_unset();
session_destroy();

// Unistavanje Cooki kada se izlogujemo
setcookie("id", "", time()-1, "/");
setcookie("korisnik", "", time()-1, "/");
setcookie("status", "", time()-1, "/");

header("Location:shop.php")

?>