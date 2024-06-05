function getData() {
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
    .then(data => {
        if (!data || data.length === 0) {
            return;
        }
        // Generate each ticket
        const info = data[0];

        // Ensure all fields are set, otherwise use default values
        const titre = info.Titre || 'N/A';
        const imagePath = info.ImagePath || 'default.jpg';
        const etat = info.Etat || 'N/A';
        const nomArtiste = info.nom_artiste || 'N/A';
        const categorie = info.Categorie || 'N/A';
        const dateConcert = info.Date_concert || 'N/A';
        const debutHeure = info.Debut_heure || 'N/A';
        const finHeure = info.Fin_heure || 'N/A';
        const duree = info.Duree || 'N/A';
        const description = info.Description || 'N/A';

        // Left part
        const left = document.querySelector('.left');
        left.innerHTML = `
            <h1>Intitulé : ${titre}</h1>
            <img src="../images/${imagePath}" alt="Concert Image">
            <ul class="eventInfo">
                <li><b>Etat : </b> ${etat}</li>
                <li><b>artiste : </b> ${nomArtiste}</li>
                <li><b>Catégorie : </b> ${categorie}</li>
                <li><b>Date:</b> ${dateConcert}</li>
                <li><b>Heure:</b> ${debutHeure} - ${finHeure}</li>
                <li><b>Durée:</b> ${duree}h</li>
                <li><b>Description : </b><br/>${description}</li>
            </ul>
        `;

        // Right part (disabled places)
        if (data[1] && data[1].length > 0) {
            for (let i = 0; i < data[1].length; i++) {
                const place = data[1][i].place;
                const placeID = (place.charCodeAt(0) - 65) * 6 + parseInt(place[1]);

                let disabledPlace = document.getElementById(placeID);
                if (disabledPlace) {
                    disabledPlace.style.backgroundColor = 'pink';
                    disabledPlace.disabled = true;
                }
            }
        }
    })
    .catch(error => {
        console.error("getting data Error: ", error);
    });
}
