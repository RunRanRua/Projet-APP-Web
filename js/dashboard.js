const calendar = document.querySelector(".calendar-container .days"),
      dateDisplay = document.querySelector(".calendar-container .date"),
      prev = document.querySelector(".prev"),
      next = document.querySelector(".next"),
      todayBtn = document.querySelector(".today-btn"),
      gotoBtn = document.querySelector(".goto-btn"),
      dateInput = document.querySelector(".date-input");

let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

const months = [
    "Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
    "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"
];
const daysOfWeek = ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"];

function updateCalendar() {
    calendar.innerHTML = '';  // Clear existing calendar
    dateDisplay.innerText = `${months[currentMonth]} ${currentYear}`;

    const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // Fill in the blanks for days of previous month
    for (let i = 0; i < firstDayOfMonth.getDay(); i++) {
        const div = document.createElement('div');
        div.classList.add('day', 'prev-date');
        calendar.appendChild(div);
    }

    // Fill in the current month's days
    for (let i = 1; i <= daysInMonth; i++) {
        const div = document.createElement('div');
        div.classList.add('day');
        div.innerText = i;
        div.addEventListener('click', () => loadData(currentYear, currentMonth, i));
        calendar.appendChild(div);
    }

    // Fill in the blanks for days of next month
    const totalCells = 42;  // Typical calendar size
    const currentCells = firstDayOfMonth.getDay() + daysInMonth;
    for (let i = currentCells; i < totalCells; i++) {
        const div = document.createElement('div');
        div.classList.add('day', 'next-date');
        calendar.appendChild(div);
    }
}

function loadData(year, month, day) {
    console.log(`Fetching data for ${year}-${month + 1}-${day}`);
    fetch(`../php/data_endpoint.php?date=${year}-${month + 1}-${day}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            updateChart(data);
        })
        .catch(error => {
            console.error('Error loading data:', error);
        });
}

// Initialize and update Chart.js chart
let myChart;
function initChart() {
    const ctx = document.getElementById('chart').getContext('2d');
    myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Température °C',
                data: [],
                borderWidth: 1,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function updateChart(data) {
    if (!data || !data.times || !data.levels) {
        console.error('Invalid data format:', data);
        return;
    }

    myChart.data.labels = data.times;
    myChart.data.datasets.forEach((dataset) => {
        dataset.data = data.levels;
    });
    myChart.update();

    // Afficher la moyenne, le maximum et le minimum du niveau sonore
    const displayText = `Moyenne : ${data.average.toFixed(2)} °C, ` +
                        `Max : ${data.max} °C, Min : ${data.min} °C`;
    document.getElementById('data-display').innerText = displayText;
}

document.addEventListener('DOMContentLoaded', function() {
    updateCalendar();
    initChart();
});

prev.addEventListener('click', () => {
    if (currentMonth === 0) {
        currentMonth = 11;
        currentYear -= 1;
    } else {
        currentMonth -= 1;
    }
    updateCalendar();
});

next.addEventListener('click', () => {
    if (currentMonth === 11) {
        currentMonth = 0;
        currentYear += 1;
    } else {
        currentMonth += 1;
    }
    updateCalendar();
});

todayBtn.addEventListener('click', () => {
    const today = new Date();
    currentMonth = today.getMonth();
    currentYear = today.getFullYear();
    updateCalendar();
});

gotoBtn.addEventListener('click', () => {
    const [month, year] = dateInput.value.split('/');
    if (month > 0 && month <= 12) {
        currentMonth = month - 1;
        currentYear = parseInt(year);
        updateCalendar();
    } else {
        alert('Invalid date');
    }
});
