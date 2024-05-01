// button modifier mot de passe
var mdpBTN = document.getElementById("modifyMDP");


// page pour modifier mot de passe
var modifyMDP = document.querySelector('.modifyMDP');







// fond
var bg = document.querySelector('.bg');


function MDPonClick(event){
    bg.style.display='block';
    modifyMDP.style.display="block";
}



window.onclick = function(event){
    if (event.target !== mdpBTN && 
        event.target !== modifyMDP &&
        !modifyMDP.contains(event.target)
    ){
        bg.style.display='none';
        modifyMDP.style.display="none";
    }
}


/* 
       <div class="bg"></div>
        <!-- modify MDP box -->
        <div class="modifyMDP">
                <form action="#" method="post">
                    <div class="title2">Changer le mot de passe</div>
                    <div class="content" >
                        <p class="title">Ancien Mot de passe</p>
                        <p class="input"><input type="password" name="mdp" value=""/></p>

                        <p class="title">Nouveau Mot de passe</p>
                        <p class="input"><input type="password" name="new_mdp" value=""/></p>

                        <p class="title">Confirmerle mot de passe</p>
                        <p class="input"><input type="password" name="confirm_mdp" value=""/></p>

                        <div><Button>Changer</Button></div>
                    </div>
                </form>
            </div>
    </div>

    <script src="../js/profil.js"></script>


*/