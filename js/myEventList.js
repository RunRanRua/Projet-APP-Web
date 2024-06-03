
generateList();

function toggleList(dt){
    if(dt.classList.contains('active')){
        dt.classList.remove("active");
    }else{
        dt.classList.add("active");
    }
}


// get disabledTime data
function getData(){
    return fetch('../php/myList_getData.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({})
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


function generateList(){
    getData()
    .then(data =>{
        if(data.length == 0){
            return {};
        }
        // generate each ticket
        for (let i =0;i<data.length;i++){
            info = data[i];
            
            // add inongoing list
            if(info["Etat"] == "A venir"){
                // create new dd element (ticket)
                let newOngoingDD = prepareNewDD(info,"ongoingTickets");
                
                // find the position to insert
                let allOngoingDD = document.querySelectorAll('.ongoingTickets');
    
                if (allOngoingDD.length != 0){
                    let lastOngoingDD = allOngoingDD[allOngoingDD.length -1 ];
                    // insert
                    lastOngoingDD.insertAdjacentElement('afterend',newOngoingDD);
                }else{
                    let OngoingDT = document.querySelector('dt');
                    OngoingDT.insertAdjacentElement('afterend',newOngoingDD);
                }
            }else if (info["Etat"] == "En cours") {
                // create new dd element (ticket)
                let newUpcomingDD = prepareNewDD(info,"upcomingTickets");
                
                // find the position to insert
                let allUpcomingDD = document.querySelectorAll('.upcomingTickets');
    
                if (allUpcomingDD.length != 0){
                    let lastUpcomingDD = allUpcomingDD[allUpcomingDD.length -1 ];
                    // insert
                    lastUpcomingDD.insertAdjacentElement('afterend',newUpcomingDD);
                }else{
                    let UpcomingDTs = document.querySelectorAll('dt');
                    UpcomingDTs[1].insertAdjacentElement('afterend',newUpcomingDD);
                }
            }else{
                // create new dd element (ticket)
                let newPastDD = prepareNewDD(info,"pastTickets");
                
                // find the position to insert
                let allPastDD = document.querySelectorAll('.pastTickets');
    
                if (allPastDD.length != 0){
                    let lastPastDD = allPastDD[allPastDD.length -1 ];
                    // insert
                    lastPastDD.insertAdjacentElement('afterend',newPastDD);
                }else{
                    let PastDTs = document.querySelectorAll('dt');
                    PastDTs[2].insertAdjacentElement('afterend',newPastDD);
                }
            }
        }

    })
    .catch(error => {
        console.error("getting data Error: ", error)
    });
}


function prepareNewDD(info, ticketclass){
    let date_achat_billet = info['Date_achat_billet'];
    let date_concert = info['Date_concert'];
    let debut_heure = info['Debut_heure'];
    let duree = info['Duree'];
    let fin_heure = info['Fin_heure'];
    let img_path = info['ImagePath'];
    let place = info['place'];
    let titre = info['Titre'];
    let artiste = info['nom_artiste'];


    let newOngoingDD = document.createElement('dd');
    newOngoingDD.className = ticketclass;
    newOngoingDD.innerHTML = `
        <div class="ticketInfo">
            <h2>${titre}</h2>
            <p>${place}</p>
            <ul>
                <li><b>${artiste}</b></li>
                <li><b>Date:</b> ${date_concert}</li>
                <li><b>Heure:</b> ${debut_heure} - ${fin_heure}</li>
                <li><b>Durée:</b> ${duree}h</li>
                <li>Date d'achat: ${date_achat_billet}</li>
            </ul>
        </div>
        <img src="../images/${img_path}" />
    `;

    return(newOngoingDD)
}

