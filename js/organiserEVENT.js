// Get elements
let date = document.getElementById('concertDate');
let hourSelect = document.getElementById('hour-select');
let minuteSelect = document.getElementById('minute-select');
let hourSelect_end = document.getElementById('hour-select-end');
let minuteSelect_end = document.getElementById('minute-select-end');

// other variables
let disabledTime = {}
let availablePeriod;

// get disabledTime data
function getData(day){
    return fetch('../php/organiserEVENT_getData.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ choosenDay: day })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('network error ' + response.statusText);
        }
        return response.json();
    })
    .catch(error => {
        console.error('error when getting data:', error);
    });
}


// initialise Date
function initialiseDate(){
// today's date
let today = new Date();

// min date : next week
let minDate = new Date();
minDate.setDate(today.getDate() + 7);

// maxdate : 1 year after
let maxDate = new Date();
maxDate.setFullYear(today.getFullYear() + 1);

// format
let minDateFormatted = minDate.toISOString().split('T')[0];
let maxDateFormatted = maxDate.toISOString().split('T')[0];

// setting
document.getElementById('concertDate').setAttribute('min', minDateFormatted);
document.getElementById('concertDate').setAttribute('max', maxDateFormatted);
}
  
// get disabledTime 
function getDisabledTime(data){
    if (data.length == 0){
        return {};
    }
    
    let schedule = [];
    let finalSchedule = {};

    // pre-process
    for(let i = 0; i<data.length;i++){
        timestamp = data[i];
        schedule.push(timestamp["Debut_heure"])
        schedule.push(timestamp["Fin_heure"]);
    }
    
    for(let i =0; i<schedule.length;i+=2){
        start_time = schedule[i].split(":");
        end_time = schedule[i+1].split(":");
        
        finalSchedule[ parseInt(start_time[0]) ] =  (parseInt(start_time[1]) ==0) ? [0, 30] :[30];
        finalSchedule[ parseInt(end_time[0]) ] =  (parseInt(end_time[1]) ==30) ? [0, 30] :[0];

        for(let hour = parseInt(start_time[0])+1; hour< parseInt(end_time[0]); hour++){
            finalSchedule[hour] = [0,30];
        }
    }
    return finalSchedule;
}

// reset
function resetEnd_H(){
    options = hourSelect_end.options;
    for(let i = 0; i<options.length;i++){
        options[i].disabled = true;
    }
}
function resetEnd_M(){
    options = minuteSelect_end.options;
    for(let i = 0; i<options.length;i++){
        options[i].disabled = true;
    }
}
  
// listener to unblock select
date.addEventListener('change', function() {
    if(date.value != null){
        hourSelect.disabled = false;
        hourSelect.value = "--";

        minuteSelect.disabled = true;
        minuteSelect.value = "--";
        hourSelect_end.disabled = true;
        hourSelect_end.value = "--";
        resetEnd_H();
        minuteSelect_end.disabled= true;
        minuteSelect_end.value = "--";
        resetEnd_M();

        getData(date.value)
                        .then(data =>{
                            disabledTime = getDisabledTime(data);
                        })
                        .catch(error => {
                            console.error("getting data Error: ", error)
                        });
    }
});
hourSelect.addEventListener('change', function() {  
    if (hourSelect.value != "--") {
        minuteSelect.disabled = false;
        minuteSelect.value = "--";

        hourSelect_end.disabled = true;
        hourSelect_end.value = "--";
        resetEnd_H();
        minuteSelect_end.disabled= true;
        minuteSelect_end.value = "--";
        resetEnd_M();
    }
});
minuteSelect.addEventListener('change', function(){
    if (minuteSelect.value !== "--"){
        hourSelect_end.disabled=false;
        hourSelect_end.value ="--";
        resetEnd_H();

        minuteSelect_end.disabled= true;
        minuteSelect_end.value = "--";
        resetEnd_M();
    }
});
hourSelect_end.addEventListener('change', function(){
    if (hourSelect_end.value !== "--"){
        minuteSelect_end.disabled=false;
        minuteSelect_end.value ="--";
        resetEnd_M();
    }
});




// update Hour and Minutes
function updateDisabledH() {
    let options = hourSelect.options;
    let disbaledHours = Object.keys(disabledTime);

    // disable all disbled Hours
    for(let i=0;i<options.length-1; i++){
        let hour = parseInt(options[i].value);
        options[i].disabled = disabledTime[hour]!==undefined && disabledTime[hour].length ===2;
    }
}

function updateDisabledM(){
    let options = minuteSelect.options;
    let chosenHour = parseInt(hourSelect.value); 
    let disabledMinutes = disabledTime[chosenHour];

    if(disabledMinutes !==undefined){
        options[0].disabled = disabledMinutes.includes(0);
        options[1].disabled = disabledMinutes.includes(30);
    }else{
        options[0].disabled = false;
        options[1].disabled = false;
    }
}


function getAvailablePeriod(){
    // start time
    let availablePeriod = {};

    if(parseInt(minuteSelect.value) == 0){
        availablePeriod[parseInt(hourSelect.value)] = parseInt(minuteSelect.value);
    } else{
        availablePeriod[parseInt(hourSelect.value) +1] = 0;
    }

    
    for(let hour = parseInt(hourSelect.value); hour< 22; hour++){
        for(let min = parseInt(minuteSelect.value)/30; min<2;min++){
            if( disabledTime.hasOwnProperty(hour) && disabledTime[hour].includes(min*30) ){
                availablePeriod[hour] = min*30;
                return availablePeriod;
            }
        }
    }
    availablePeriod[23] = 30;
    return availablePeriod;
}

function updateDisabledH_end(){
    availablePeriod = getAvailablePeriod();
    let period_hour = Object.keys(availablePeriod);
    let options = hourSelect_end.options;

    for(let hour = parseInt(period_hour[0]); hour < parseInt(period_hour[1]); hour++){
        options[hour-5].disabled = false;
    }

    if(!disabledTime.hasOwnProperty(period_hour[1])){
        options[period_hour[1]-5].disabled = false;
    }else{
        options[period_hour[1]-5].disabled = disabledTime[period_hour[1]].length !=2 ? false : true;
    }
}
function updateDisabledM_end(){
    let options = minuteSelect_end.options;
    let select_end_hour = hourSelect_end.value;
    
    if( !disabledTime.hasOwnProperty(parseInt(select_end_hour)) ){
        options[0].disabled = false;
        options[1].disabled = false;
    }else{
        options[0].disabled = disabledTime[parseInt(select_end_hour)].includes(0) ? true:false;
        options[1].disabled = disabledTime[parseInt(select_end_hour)].includes(30) ? true:false;
    }

    if(hourSelect.value == select_end_hour && parseInt(minuteSelect.value) == 0){
        options[0].disabled == true;
        options[0].disabled == false;
        console.log(options[0]);
    }
}