// fond
var bg = document.querySelector('.bg');


// buttons
var mdpBTN = document.getElementById("modifyMDP");
var numeroBTN = document.getElementById("modifyTEL");
var deleteBTN = document.getElementById("deleteUser");

// page pour modifier mot de passe
var modifyMDP = document.querySelector('.modifyMDP');
var modifyTEL = document.querySelector('.modifyTEL');
var deleteUser = document.querySelector('.deleteUser');

// button clicked
function MDPonClick(event){
    bg.style.display='block';
    modifyMDP.style.display="block";
}
function TELonClick(event){
    bg.style.display='block';
    modifyTEL.style.display="block";
}
function deleteOnClick(event){
    bg.style.display='block';
    deleteUser.style.display="block";
}

window.onclick = function(event){
    if (event.target !== mdpBTN && 
        event.target !== modifyMDP &&
        !modifyMDP.contains(event.target) &&
        
        event.target !== numeroBTN && 
        event.target !== modifyTEL &&
        !modifyTEL.contains(event.target) &&

        event.target !== deleteBTN && 
        event.target !== deleteUser &&
        !deleteUser.contains(event.target)
    ){
        bg.style.display='none';
        modifyMDP.style.display="none";
        modifyTEL.style.display="none";
        deleteUser.style.display="none";
    }
}