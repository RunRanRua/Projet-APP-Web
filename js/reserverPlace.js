function resetBTN() {
    const BTN = document.getElementById('resetBTN');
    BTN.addEventListener("click",function () {
        for(let i =1;i<37;i++){
            let place = document.getElementById(i);
            if(place.checked){
                place.removeAttribute("name");
                place.removeAttribute("value");
            }
        }      
    })
}

function generatePlaces(){
    // numero row
    document.write(`
        <div class="numero"></div>
    `)
    for(let i = 1; i<=6;i++){
        document.write(`
        <div class="numero">${i}</div>  
        `)
    }

    // generate global places
    let id = 1;
    for(let r=0;r<6;r++){
        document.write(`
        <div class="numero">${String.fromCharCode(65 + r)}</div>  
        `);
        for(let c=0;c<6;c++){
            document.write(`
                <input type="checkbox" class="place" id="${id}">  
             `);
             const place = document.getElementById(id);
             place.addEventListener('change',function() {
                if (place.checked){
                    place.name = "checkedPlace[]";
                    
                    let numero_2 = place.id % 6 == 0 ? 6 : place.id % 6;
                    let numero_1 = numero_2 == 6? String.fromCharCode(65 + parseInt(place.id/6)-1 ) : String.fromCharCode(65 + parseInt(place.id/6) );
                    place.value = numero_1 + numero_2;
                }else{
                    place.removeAttribute("name");
                    place.removeAttribute("value");
                }
             })

             id++;
        }    
    }

    // disabled places
    

}

function getData(){
    return fetch('../php/eventDescripton_getData.php', {
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

function generateEventInfo() {
    getData()
    .then(data =>{
        if(data.length == 0){
            return {};
        }
        // generate each ticket
        const info = data[0];

        // left part
        const left = document.querySelector('.left');
        left.innerHTML=`
            <h1>Intitulé : ${info["Titre"]}</h1>
            <img src="../images/${info["ImagePath"]}">
            <ul class="eventInfo">
                <li><b>Etat : </b> ${info["Etat"]}</li>
                <li><b>artiste : </b> ${info["nom_artiste"]}</li>
                <li><b>Catégorie : </b> ${info["Categorie"]}</li>
                <li><b>Date:</b> ${info["Date_concert"]}</li>
                <li><b>Heure:</b> ${info["Debut_heure"]} - ${info["Fin_heure"]}</li>
                <li><b>Durée:</b> ${info["Duree"]}h</li>
                <li> <b>Description : </b>
                <br/>
                ${info["Description"]}
                </li>
            </ul>
        `;

        // right part
        for(let i =0; i<data[1].length; i++){
            const place = data[1][i]["place"];
            const placeID = (place.charCodeAt(0) - 65)*6 + parseInt(place[1]);
            
            let disabledPlace = document.getElementById(placeID);
            disabledPlace.style.backgroundColor = 'pink';
            disabledPlace.disabled = true;
        }



    })
    .catch(error => {
        console.error("getting data Error: ", error)
    });
}


