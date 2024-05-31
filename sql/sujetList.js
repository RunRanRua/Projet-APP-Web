function getData(){
    return fetch('../php/listerSujet.php', {
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
            // each subject
            info = data[i];
            
            // obtain list obj in HTML



        }
    })
    .catch(error => {
        console.error("getting data Error: ", error)
    });
}