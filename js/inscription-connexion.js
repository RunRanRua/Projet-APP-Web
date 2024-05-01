// button signUp
var signBTN = document.getElementById("signBTN");
// button connexion
var loginBTN = document.getElementById("loginBTN");


// page d'inscription
var inscription = document.querySelector('.inscription');
// page de connexion
var connexion = document.querySelector('.connexion');


// fond
var bg = document.querySelector('.bg');

var isOpen = false;


function inscriptionClick(event){
    bg.style.display='block';
    inscription.style.display="block";
    isOpen = true;
}


function connexionClick(event){
    bg.style.display='block';
    connexion.style.display="block";
    isOpen = true;
}


window.onclick = function(event){
    if (event.target !== signBTN && 
        event.target !== loginBTN && 
        event.target !== inscription &&
        event.target !== connexion && 
        !inscription.contains(event.target) &&
        !connexion.contains(event.target)
    ){
        bg.style.display='none';
        inscription.style.display="none";
        connexion.style.display="none";
        isOpen = false;
    }
}