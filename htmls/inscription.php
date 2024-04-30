<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$idPlace = 1;  // Default value for idPlace
$idCommentaire = 1; // Default Comment ID

// Ensure Comment exists
$checkCommentSql = "SELECT idCommentaire FROM Commentaire WHERE idCommentaire = ?";
$checkCommentStmt = $conn->prepare($checkCommentSql);
$checkCommentStmt->bind_param("i", $idCommentaire);
$checkCommentStmt->execute();
$checkCommentStmt->store_result();

if ($checkCommentStmt->num_rows == 0) {
    $insertCommentSql = "INSERT INTO Commentaire (idCommentaire, Date_commentaire, Like_commentaire, Contenu_commentaire) VALUES (?, CURDATE(), 0, 'Default Comment')";
    $insertCommentStmt = $conn->prepare($insertCommentSql);
    $insertCommentStmt->bind_param("i", $idCommentaire);
    $insertCommentStmt->execute();
    $insertCommentStmt->close();
}
$checkCommentStmt->close();

// Retrieve form data
$nom = $conn->real_escape_string($_POST['nom']);
$prenom = $conn->real_escape_string($_POST['prenom']);
$email = $conn->real_escape_string($_POST['email']);
$numero = $conn->real_escape_string($_POST['numero']);
$mdp = $conn->real_escape_string($_POST['mdp']);
$confirm_mdp = $conn->real_escape_string($_POST['confirm_mdp']);

// Check if passwords match
if ($mdp !== $confirm_mdp) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

$hashed_password = password_hash($mdp, PASSWORD_DEFAULT);

// Prepare user insertion
$date_inscription = date("Y-m-d");  // Get current date
$sql = "INSERT INTO Utilisateur (Nom, Prenom, Mail, Numero, Mdp, Date_inscription) VALUES (?, ?, ?, ?, ?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nom, $prenom, $email, $numero, $hashed_password, $date_inscription);

// Execute insertion
if ($nom && $prenom && $email && $numero && $hashed_password && $date_inscription) {
    
    // Extrait du fichier PHP traitant l'inscription
    
    if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie!'); window.location.href='index.php';</script>";
    } else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }
    
    
} else {
    echo "One or more fields are empty, please check your form inputs.";
}

$stmt->close();
$conn->close();
?>
