<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Events-IT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="#">Accueil</a>
            <a href="#">Événements</a>
            <a href="#">FAQ</a>
            <a href="#">Forum</a>
            <a href="#">À propos</a>
            <a href="#">Connexion</a>
        </nav>
    </header>


    <main>
        <section id="forum-stats" class="card forum-half">  
            <h1>FORUM</h1>
            <div class="stats">
                <button>Nouveau sujet</button>
                <p>Sujet total: </p>
                <p>Nombre total de messages: </p>
            </div>
        </section>
    </main>


    <form action="nouveauSujet.php" method="post">
        Mail : <input type="text" name="mail">
        <button type="submit"></button>
    </form>

    <footer>
        <nav>
            <a href="#">FAQ</a>
            <a href="#">CGU - CGV</a>
            <a href="#">Contact</a>
            <a href="#">Mentions légales</a>
            <a href="#">Confidentialité</a>
        </nav>
        <p>© 2024 Events-IT</p>
    </footer>
</body>
</html>