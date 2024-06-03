
// Initialise isSortedAsc à l'extérieur de l'écouteur DOMContentLoaded pour éviter toute réinitialisation
let isSortedAsc = true;

document.addEventListener('DOMContentLoaded', () => {
    const sortButton = document.getElementById('sortButton');
    updateButtonText(); // Initialise le texte du bouton basé sur l'état de tri actuel

    sortButton.addEventListener('click', () => {
        sortCardsByDate(isSortedAsc);
        isSortedAsc = !isSortedAsc; // Inverse l'état de tri après le tri
        updateButtonText(); // Met à jour le texte du bouton après avoir changé l'état de tri
    });
});

function sortCardsByDate(ascending) {
    const cardsContainer = document.querySelector('.cards-grid');
    const cards = Array.from(cardsContainer.children);
    
    // Définition de getDateString à l'intérieur de sortCardsByDate
    function getDateString(card) {
        const dateText = card.querySelector('.contento p').textContent.trim();
        const match = dateText.match(/\b(\d{2})\/(\d{2})\/(\d{4})\b/);
        return match ? `${match[3]}${match[2]}${match[1]}` : '';
    }

    // Tri des cartes
    cards.sort((a, b) => {
        const dateA = getDateString(a);
        const dateB = getDateString(b);
        return ascending ? dateA.localeCompare(dateB) : dateB.localeCompare(dateA);
    });

    // Réinsertion des cartes dans l'ordre trié
    cardsContainer.innerHTML = '';
    cards.forEach(card => cardsContainer.appendChild(card.cloneNode(true)));
}

function updateButtonText() {
    const sortButton = document.getElementById('sortButton');
    sortButton.textContent = isSortedAsc ? "Trier du plus ancien au plus récent" : "Trier du plus récent au plus ancien";
}


// click action
const cards = document.querySelectorAll(".card");
for(let i =0; i<cards.length;i++){
    cards[i].addEventListener('click',function () {


        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/set_session.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Session updated successfully');
            }
        };
        xhr.send('concert_id=' + cards[i].id);



        window.location.href = '../htmls/reserverPlace.php';
    })
}
console.log("executed");
console.log(cards);