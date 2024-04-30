<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php'; // Assurez-vous que ce fichier contient les fonctions de connexion à votre base de données

// Afficher les erreurs ou messages ici
if (!empty($_SESSION['update_status'])) {
    echo $_SESSION['update_status'];
    unset($_SESSION['update_status']); // Nettoyer le message après l'affichage
}

?>

<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom']); ?>!</h1>
<form action="update_profile.php" method="post">
    <div>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>">
    </div>
    <div>
        <label>Numéro de téléphone:</label>
        <input type="text" name="numero" value="<?php echo htmlspecialchars($_SESSION['numero']); ?>">
    </div>
    <div>
        <label>Nouveau mot de passe (laisser vide pour ne pas changer):</label>
        <input type="password" name="new_password">
    </div>
    <div>
        <label>Confirmer le mot de passe actuel pour appliquer les changements:</label>
        <input type="password" name="current_password" required>
    </div>
    <button type="submit">Mettre à jour</button>
</form>

<a href="logout.php">Déconnexion</a>
