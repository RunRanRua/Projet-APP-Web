<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Events-IT</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/FAQ.css">
</head>
<body>
<!-- === Header Part === -->
<div class="header">
    <!-- logo -->
    <div class="logo">
        <a href="#"><img src="..\images\logo100px.png"></a>
    </div>
=======
<?php
$servername = "localhost"; // L'adresse du serveur de base de données
$username = "root"; // Le nom d'utilisateur pour se connecter à la base de données
$password = "root"; // Le mot de passe pour se connecter à la base de données
$dbname = "mydb3"; // Le nom de la base de données
>>>>>>> parent of fad8858 (formulaire marche bien avec BDD)

    <!-- navigation -->
    <div class="nav">
        <ul>
            <li><a href="#"><b>ACCUEIL</b></a></li>
            <li><a href="#"><b>EVENEMENT</b></a></li>
            <li><a href="#"class = "active"><b>FAQ</b></a></li>
            <li><a href="#"><b>FORUM</b></a></li>
            <li><a href="#"><b>A PROPOS</b></a></li>
        </ul>
    </div>

<<<<<<< HEAD
    <!-- search barre -->
    <div class="search">
        <a href="#"><img src="..\images\loop.png"></a>
        <input type="text" placeholder="RECHERCHE">
    </div>

    <!-- user -->
    <div class="user">
        <a href="#"><img src="..\images\signup.png"></a>
        <a href="#"><img src="..\images\login2.png"></a>
    </div>
</div>


<section class="faq-section" action="FAQ.php" method="post">
    <h1>DES QUESTIONS ?</h1>
    <div class="search-container">
        <input type="search" id="search-input" placeholder="Rechercher un concert">
        <a href="#" id="search-icon-link">
            <img src="..\images\loop_gray.png" alt="Rechercher" id="search-icon">
        </a>
    </div>



    <button class="open-button" onclick="openForm()"><strong>Ajouter une question</strong></button>
    
    <div class="login-popup">
        <div class="form-popup" id="popupForm">
            <form class="form-container" action="FAQ.php" method="post">
                <h2>Ajoutez votre question</h2>
                <label for="Question">
                    <strong>Question</strong>
                </label>
                <input type="text" id="Question" name="Question" placeholder="Votre question" />
                <label for="Reponse">
                    <strong>Réponse</strong>
                </label>
                <input type="text" id="Reponse" name="Reponse" placeholder="Votre réponse" />

                <button type="button" class="btn" onclick="addFAQSection(document.getElementById('Question').value, document.getElementById('Reponse').value);">Ajouter</button>  
                <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
            </form>    
        </div>
    </div>


    <script>
    function openForm() {
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }


    function addFAQSection(questionText, answerText) {
        // Get the FAQ list element
        const faqList = document.querySelector('.faq-list');

        // Create the new FAQ item element
        const faqItem = document.createElement('div');
        faqItem.classList.add('faq-item');

        // Create the question button
        const questionButton = document.createElement('button');
        questionButton.classList.add('faq-question');
        questionButton.textContent = questionText + ' ';

        // Add the toggle functionality (assuming you have a toggleAnswer function)
        questionButton.setAttribute('onclick', `toggleAnswer('answer${faqList.children.length + 1}')`);

        // Add the arrow icon
        const arrowSpan = document.createElement('span');
        arrowSpan.classList.add('arrow');
        arrowSpan.textContent = '&#9660;'; // Pb with the arrow
        // Append the arrow to the button
        questionButton.appendChild(arrowSpan);

        // Create the answer element
        const answerElement = document.createElement('div');
        answerElement.classList.add('faq-answer');
        answerElement.setAttribute('id', `answer${faqList.children.length + 1}`);
        answerElement.textContent = answerText;

        // Append the question button and answer to the FAQ item
        faqItem.appendChild(questionButton);
        faqItem.appendChild(answerElement);

        // Append the new FAQ item to the list
        faqList.appendChild(faqItem);
    }
    </script>














    <div class="faq-container">
        <h2 class="faq-title">Question recurrentes</h2>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer1')">Question I <span class="arrow">&#9660;</span></button>
                <div id="answer1" class="faq-answer">Réponse à la question I.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer2')">Question II <span class="arrow">&#9660;</span></button>
                <div id="answer2" class="faq-answer">Réponse à la question II.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer3')">Question III <span class="arrow">&#9660;</span></button>
                <div id="answer3" class="faq-answer">Réponse à la question III.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer4')">Question IV <span class="arrow">&#9660;</span></button>
                <div id="answer4" class="faq-answer">Réponse à la question IV.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer5')">Question V <span class="arrow">&#9660;</span></button>
                <div id="answer5" class="faq-answer">Réponse à la question V.</div>
            </div>
        </div>
    </div>


</section>

<!-- === Footer Part === -->
<div class="footer">

    <!-- logo -->
    <div class="logo">
        <h1>
            <a href="#">logo</a>
        </h1>
    </div>

    <div class="annotation">
        <li><a href="#"><b>© 2024 Events-IT. Tous droits réservés.</b></a></li>
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
                <input type="text" placeholder="Question">
            </div>
            <div class="sociaux">
                <a href="#"><img src="..\images\reseausociauxv2Insta22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2FB22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2Tik22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2Twitt22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxvYT22x22.png" ></a>
            </div>
        </ul4>

    </div>
</div>
</body>
<script src="../JS/script.js"></script>
</html>
=======
// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
}
?>
>>>>>>> parent of fad8858 (formulaire marche bien avec BDD)
