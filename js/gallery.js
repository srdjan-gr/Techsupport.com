let galerija=document.querySelector('#gallery');
let imgBig = document.querySelector('.imgBig');
let imgSmall = document.querySelector('.imgSmall');
let prikaziOverlay = document.querySelector('#prikaziOverlay');



// Prikaz Overleja preko velike slike kada mis predje preko nje
let slika = document.querySelector('#slika');
let paragraf = document.querySelector('.prikaziOverlay');

function dosoMis(){

    paragraf.style=`
        opacity: 1;
    `;
}

function otisoMis(){
    paragraf.style=`
    opacity: 0;
    `;
}

