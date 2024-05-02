const boutonOuvrir = document.getElementById('monBouton');
const popUp = document.getElementById('maPop-up');
const boutonFermer = document.getElementById('fermerPop-up');

boutonOuvrir.addEventListener('click', () => {
    popUp.classList.remove('cacher');
});

boutonFermer.addEventListener('click', () => {
    popUp.classList.add('cacher');
});