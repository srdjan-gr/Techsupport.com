// Promena slika za proizvod







// Provera forme za logovanje
function proveriFormu(){

  let email = document.querySelector('#email');  
  let lozinka = document.querySelector('#lozinka'); 
  let message = document.querySelector('#messageContent'); 

  if(email.value==''){

    message.style.display=''; 
    message.innerHTML='Niste uneli email!!!';
    setTimeout(skloniPoruku, 2000);
    // email.focus();
    return false;
  }

  if(lozinka.value==''){

    message.style.display='';   
    message.innerHTML='Niste uneli lozinku!!!';
    setTimeout(skloniPoruku, 2000);
    // lozinka.focus();
    return false;
  }
  return true;

}

function skloniPoruku(){
    document.querySelector('#messageContent').style.display='none';
}

// Proizvod.php -Prikaz forme za Komentare za pojedniacni proizvod
function prikaziFormu(){

    // let forma = document.querySelector('#komentari-sadrzaj-komentari');
    let forma = document.querySelector('#komentari-sadrzaj-forma');

    if(forma==''){
        forma.style=`
            transform: translateY(-100%);
        `;
    }else{
        forma.style=`
            transform: translateY(0%);
        `;
    }

}

function proveriKomenatar(){
    let message = document.querySelector('#messageContent');
    let komentar = document.querySelector('#komentar');
    let ime = document.querySelector('#ime');


    if(ime.value==''){
        message.style.display=''; 
        message.innerHTML='Ime je obavezano!!!';
        return false;
    }

    if(komentar.value==''){
        message.style.display='';
        message.innerHTML='Komentar je obavezan!!!';
        return false;
    }
    return true;
}

