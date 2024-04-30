<?php
session_start();  // Démarre le gestionnaire de session

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $mdp = $conn->real_escape_string($_POST['mdp']);


    $sql = "SELECT idUtilisateur, Nom, Prenom, Mdp, isAdmin FROM Utilisateur WHERE Mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($mdp, $user['Mdp'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['idUtilisateur'];
            $_SESSION['nom'] = $user['Nom'];
            $_SESSION['prenom'] = $user['Prenom'];
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = $user['isAdmin']; // Store admin status in session
    
            // Redirect to home page
            header("Location: index.php");
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
    




    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($mdp, $user['Mdp'])) {
            // Set session variables
            $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
            $_SESSION['nom'] = $user['Nom'];
            $_SESSION['prenom'] = $user['Prenom'];
            $_SESSION['email'] = $email;

            // Redirect to profile page
            header("Location: index.php");
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
    $stmt->close();
}

$conn->close();
?>
