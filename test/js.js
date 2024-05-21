var joursReserves = {
    "2024-05-10": ["09:00", "10:00", "11:00"],
    "2024-05-15": ["12:00", "13:00", "14:00"],
    "2024-05-20": ["15:00", "16:00", "17:00"]
  };


  var scheduleTable = document.getElementById("schedule").getElementsByTagName('tbody')[0];
  // Sélection de l'élément du formulaire
  var eventDateInput = document.getElementById("eventDate");
  var eventTimeInput = document.getElementById("eventTime");

// Sélection de l'élément du calendrier et de l'input caché
var calendarBody = document.querySelector("#calendar tbody");
var eventDateInput = document.getElementById("eventDate");
var currentMonthElement = document.getElementById("currentMonth");
var prevMonthButton = document.getElementById("prevMonth");
var nextMonthButton = document.getElementById("nextMonth");

var scheduleList = document.getElementById("schedule");



// Date actuellement affichée dans le calendrier
var currentDateDisplayed = new Date();

// Fonction pour générer le calendrier
function generateCalendar() {
    // Effacer le contenu du calendrier
    calendarBody.innerHTML = '';
    
    var currentDate = new Date(currentDateDisplayed);
    currentDate.setDate(1);
    var endDate = new Date(currentDate);
    endDate.setMonth(currentDate.getMonth() + 1);
    endDate.setDate(0);
    
    var row = null;
    var date = new Date(currentDate);
    while (date <= endDate) {
      if (date.getDay() === 1 || !row) {
        row = document.createElement("tr");
        calendarBody.appendChild(row);
      }
      
      var cell = document.createElement("td");
      cell.textContent = date.getDate();
      cell.dataset.date = date.toISOString().slice(0, 10);
      if (isDateExcluded(date)) {
        cell.classList.add("unavailable");
      } else {
        cell.classList.add("available");
        cell.addEventListener("click", selectDate);
      }
      row.appendChild(cell);
      
      date.setDate(date.getDate() + 1);
    }
    
    // Afficher le mois et l'année actuels
    var options = { month: 'long', year: 'numeric' };
    currentMonthElement.textContent = currentDateDisplayed.toLocaleDateString('fr-FR', options);
}

function generateSchedule(selectedDate) {
    // Effacer le contenu du tableau des horaires
    scheduleTable.innerHTML = '';
  
    // Récupérer les heures réservées pour la date sélectionnée
    var heuresReservees = joursReserves[selectedDate] || [];
  
    // Ajouter toutes les heures au tableau des horaires
    heuresDisponibles.forEach(function(heure) {
      var row = document.createElement("tr");
      var cell = document.createElement("td");
      cell.textContent = heure;
      cell.dataset.heure = heure;
      // Vérifier si l'heure est disponible ou réservée
      if (heuresReservees.includes(heure)) {
        cell.classList.add("unavailable");
      } else {
        cell.classList.add("available");
        cell.addEventListener("click", selectHour);
      }
      row.appendChild(cell);
      scheduleTable.appendChild(row);
    });
}

function isDateReserved(date) {
    var dateString = date.toISOString().slice(0, 10);
    return dateString in joursReserves;
  }
  
// Fonction pour vérifier si une date est dans la liste des jours exclus
function isDateExcluded(date) {
  var dateString = date.toISOString().slice(0, 10);
  return joursReserves.includes(dateString);
}

// Fonction pour sélectionner une date
function selectDate(event) {
    var selectedCell = document.querySelector("#calendar td.selected");
    if (selectedCell) {
      selectedCell.classList.remove("selected");
    }
    event.target.classList.add("selected");
    eventDateInput.value = event.target.dataset.date;
    // Générer les horaires disponibles pour la date sélectionnée
    generateSchedule(event.target.dataset.date);
  }


  

prevMonthButton.addEventListener("click", function() {
    currentDateDisplayed.setMonth(currentDateDisplayed.getMonth() - 1);
    generateCalendar();
  });
  
  // Fonction pour passer au mois suivant
  nextMonthButton.addEventListener("click", function() {
    currentDateDisplayed.setMonth(currentDateDisplayed.getMonth() + 1);
    generateCalendar();
  });

// Générer le calendrier au chargement de la page
generateCalendar();