let gallery=document.querySelector('#gallery');
let imgBig = document.querySelector('#images-big');
let imgSmall = document.querySelector('#images-small');
let overlay = document.querySelector('.imgOverlay');
let popup = document.getElementById('popup');
let selectedImage = document.getElementById('selectedImage');
let popupClose = document.getElementById('popupClose');
let buttonsDiv = document.getElementById('buttonsDiv');
// let backButton = document.getElementById('backButton');
// let forwardButton = document.getElementById('forwardButton');

// Dodavanje Glavne slike iz niza
let glavna=document.createElement('img');
glavna.src=slike[0];
glavna.className='glavnaSlika';
glavna.alt='Velika slika proizvoda'+slike[0];
imgBig.appendChild(glavna);

let trenutna=0;

// Dodavanje Malih slika iz niza
for(i=0; i<slike.length; i++){
    // console.log(slike);
    malaSlika=document.createElement('img');
    malaSlika.src=slike[i];
    malaSlika.alt='Mala slika proizvoda'+slike[i];
    malaSlika.onclick=function(){

    // Menjanje Velike slike klikom ns malu
    glavna.src=this.src;

    }

    imgSmall.appendChild(malaSlika);
}

function promenaSLike(){
    trenutna++;
    if(trenutna==slike.length) trenutna=0;
    glavna.src=slike[trenutna];
}

// Prikaz Overleja preko velike slike kada mis predje preko nje
function dosoMis(){
    overlay.style=`
        opacity: .98;
    `;
}

function otisoMis(){
    overlay.style=`
        opacity: 0;
    `;
}


// Prikaz velike slike kao MODAL kada se klikne na nju
// Dodavanje novog elementa SLike dinamiucki u DIV POPUP iz HTML-a
let modalSlika = document.createElement('img');
modalSlika.src=slike[0];
modalSlika.className = 'modalSlika';
popup.appendChild(modalSlika);

let modalBackBtn = document.createElement('ion-icon');
modalBackBtn.name = 'chevron-back-circle-outline';
modalBackBtn.className = 'arrowIcon';
buttonsDiv.appendChild(modalBackBtn);

let modalForwarBtn = document.createElement('ion-icon');
modalForwarBtn.name = 'chevron-forward-circle-outline';
modalForwarBtn.className = 'arrowIcon';
buttonsDiv.appendChild(modalForwarBtn);




function menjanjeModalSlikeNapred(){

    
    if(trenutna > slike.length-1) trenutna=0;
    if(trenutna < 0) trenutna=slike.length - 1;
    modalSlika.src=slike[trenutna];
  
}

modalForwarBtn.addEventListener('click', () => {
    trenutna++
    menjanjeModalSlikeNapred();
})

modalBackBtn.addEventListener('click', () => {
    trenutna--
    menjanjeModalSlikeNapred();
})


// Prikaz POPUP Modala sa sliku proizvoda kada se klikne na veliku sliku
overlay.addEventListener('click', () => {

    popup.style=`
        transform: translateY(0%);
    `;     
})

popupClose.addEventListener('click', () => {

    popup.style=`
        transform: translateY(-100%);
    `;
})





