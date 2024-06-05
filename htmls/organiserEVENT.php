<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organiser un évènement</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/organiserEVENT.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>

<body>
    <!-- === Header Part === -->
    <div class="header">
        <!-- logo -->
        <div class="logo">
            <a href="#"><img src="..\images\logo100px.png"></a>
        </div>

        <!-- navigation -->
        <div class="nav">
            <ul>
                <li><a href="index.php" class = "active"><b>ACCUEIL</b></a></li>
                <li><a href="organiserEVENT.php"><b>EVENEMENT</b></a></li>
                <li><a href="FAQ.php"><b>FAQ</b></a></li>
                <li><a href="#"><b>FORUM</b></a></li>
                <li><a href="a_propos.php"><b>A PROPOS</b></a></li>
            </ul>
        </div>
    
        <!-- search barre -->
        <div class="search">
            <a href="#"><img src="..\images\loop.png"></a>
            <input type="text" placeholder="RECHERCHE">
        </div>

        <!-- user -->
        <div class="bg"></div>
        <div class="user">

            <?php if (isset($_SESSION['user_id'])){ ?>
                <?php if ( $_SESSION["is_admin"] ) { ?>
                   <a href="gestion_utilisateurs.php" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
                <?php } else{ ?>
                    <a href="profil.php" > <img src="..\images\user.png" alt="Profil"> </a>
                <?php } ?>
        
                <a href="..\php\logout.php"> <img src="..\images\Logout.png" alt="Déconnexion"> </a>

            <?php }else{ ?>

            <a href="#"><img src="..\images\signup.png" id="signBTN" onclick="inscriptionClick(event)"></a>
            <!-- inscription box -->
            <div class="inscription" id ="inscription">
                <form action="../php/inscription.php" method="post">
                    <div class="title2">Inscription</div>
                    <div class="content" >
                        <p class="title">Nom</p>
                        <p class="input"><input type="text" name="nom"/></p>
                        <p class="title">Prénom</p>
                        <p class="input"><input type="text" name="prenom"/></p>
                        <p class="title">Numéro de téléphone</p>
                        <p class="input"><input type="text" name="numero"/></p>
                        <p class="title">Email</p>
                        <p class="input"><input type="text" name="email"/></p>
                        <p class = title>Vérification</p>
                        <p class="inputVerif"><input class="verifMail" type="text" name="code"/>  <button class="btnMail" name="sendBTN">Envoyer</button></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp"/></p>
                        <p class="title">Confirmation de mot de passe</p>
                        <p class="input"><input type="password" name="confirm_mdp"/></p>
                        <p class="condition"><input type="checkbox" name="condition"> <u>J'ai lu et j'accepte toutes les conditions.</u></p>
                        <div><Button name="submitBTN">S'inscrire</Button></div>
                    </div>
                </form>
            </div>

            <a href="#"><img id="loginBTN" onclick="connexionClick(event)" src="..\images\login2.png"></a>
            <!-- connexion box -->
            <div class="connexion">
                <form action="../php/login.php" method="post">
                    <div class="title2">connexion</div>
                    <div class="content" >
                        <p class="title">Email</p>
                        <p class="input"><input type="text" name="email" value=""/></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp" value=""/></p>
                        <div><Button>Se connecter</Button></div>
                    </div>
                </form>
                
            </div>
            
            <script src="../js/inscription-connexion.js"></script>

            <?php }; ?>
            
        </div>
    </div>
    
    <!-- === mid Part === -->
    <div class="mid">
        <h1>ORGANISER UN ÉVÉNEMENT</h1>
        <dl>
            <dt>Comment procéder?</dt>
            <dd>Veuillez remplir toutes les informations dans le formulaire suivant.
                <br>
                Nous vous repondrons dans un délai d'une semaine ouvrable au plus tard, que vous pouvez vérifier dans votre boîte de réception</dd>
        </dl>
        <form method="post" action="../php/organiserEVENT_formulaire.php">
            <label class="titre">Intitulé</label>
            <input type="text" name = "titre">
            <br/><br/>

            <label class="artiste">Artiste / Groupe</label>
            <input type="text" name = "artiste">
            <br/><br/>

            <label class="categorie">Catégorie</label>
            <input type="text" name = "categorie">
            <br/><br/>

            <label>Date et Heure de l'évènement</label>
            <br/><br/>

            <b>Début: </b>
            <input type="date" name="date" id="concertDate" min="" max="" onclick="initialiseDate()">
            <select name="start_h" id="hour-select" disabled onclick="updateDisabledH()">
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option selected disabled hidden>--</option>
            </select>
            <select name="start_m" id="minute-select" disabled onclick="updateDisabledM()">
                <option>00</option>
                <option>30</option>
                <option selected disabled hidden>--</option>
            </select>

            <b>Fin:</b>
            <select name="end_h" id="hour-select-end" disabled onclick="updateDisabledH_end()">
                <option disabled>05</option>
                <option disabled>06</option>
                <option disabled>07</option>
                <option disabled>08</option>
                <option disabled>09</option>
                <option disabled>10</option>
                <option disabled>11</option>
                <option disabled>12</option>
                <option disabled>13</option>
                <option disabled>14</option>
                <option disabled>15</option>
                <option disabled>16</option>
                <option disabled>17</option>
                <option disabled>18</option>
                <option disabled>19</option>
                <option disabled>20</option>
                <option disabled>21</option>
                <option disabled>22</option>
                <option disabled>23</option>
                <option selected disabled hidden>--</option>
            </select>
            <select name="end_m" id="minute-select-end" disabled onclick="updateDisabledM_end()">
                <option disabled>00</option>
                <option disabled>30</option>
                <option selected disabled hidden>--</option>
            </select>
            <br/><br/>

            <label>Visuel</label>
            <input type="file" name="icon" />
            <br/><br/>

            <label class="description">Description</label>
            <br/><br/>
            <textarea name="description"></textarea>
            <br/><br/>

            <button type="submit">Envoyer</button>
            <button type="reset">Effacer </button>
            <script src="../js/organiserEVENT.js"></script>
        </form>

    </div>

    <!-- === Footer Part === -->
    <div class="footer">

        <!-- logo -->
        <div class="logo">
            <h1>
                <a href="#">logo</a>
            </h1>
        </div>

        <div class="annotation">
            <li><a href="#"><b>©️ 2024 Events-IT. Tous droits réservés.</b></a></li>
        </div>

        <!-- navigation -->
        <div class="nav">
       
            <ul1>
                <li><a href="#"><b>FAQ</b></a></li>
                <li><a href="#"><b>FORUM</b></a></li>
                <li><a href="#"><b>CONTACT</b></a></li>
            </ul1>

            <ul2>
                <li><a href="#"><b>CGU - CGV</b></a></li>
                <li><a href="#"><b>MENTIONS LÉGALES</b></a></li>
                <li><a href="#"><b>POLITIQUE DE CONFIDENTIALITÉ</b></a></li>
            </ul2>

            <ul3>
                <li><a href="#" class="title"><b>ADRESSE</b></a></li>
                <li class="li2"><a href="#" class="supp">28 Rue Notre Dame des Champs, 75006 Paris, France</a></li>
                <li class="li2"><a href="#" class="supp">events-it@events-it.com </a></li>
                <li class="li2"><a href="#" class="supp">01 23 45 67 89 </a></li>
            </ul3>

            <ul4>
                <li><a href="#" class="title"><b>NEWSLETTER</b></a></li>
                <div class="search">
                    <a href="#"><img src="..\images\sendv6.png" ></a>
                    <input type="text" placeholder="EMAIL">
                </div>
                <div class="sociaux">
                    <a href="#"><img src="..\images\reseausociauxv2Insta22x22.png" ></a>
                    <a href="#"><img src="..\images\reseausociauxv2FB22x22.png" ></a>
                    <a href="#"><img src="..\images\reseausociauxv2Tik22x22.png" ></a>
                    <a href="#"><img src="..\images\reseausociauxv2Twitt22x22.png" ></a>
                    <a href="#"><img src="..\images/reseausociauxvYT22x22.png" ></a>
                </div>
            </ul4>
 
        </div>
    </div>

</body>
</html>