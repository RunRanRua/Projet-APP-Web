<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Server Access  ------------------------------------------------------------------------------------

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


// Retrieve form data ------------------------------------------------------------------------------------

$mdp = $conn->real_escape_string($_POST['mdp']);
$new_mdp = $conn->real_escape_string($_POST['new_mdp']);
$confirm_mdp = $conn->real_escape_string($_POST['confirm_mdp']);


// Check isEmpty
if (empty($new_mdp) || empty($mdp) || empty($confirm_mdp)){
    echo "Veuillez remplir les cases";
    exit;
}

// Check old password in our base ---------------------------------------------------------------------------------
$sql = "SELECT * FROM Utilisateur WHERE Mail = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["email"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(!password_verify($mdp, $user["Mdp"])){
    echo "votre ancien mot de passe incorrect.";
    exit;
}

// Check new password ---------------------------------------------------------------------------------
if (!preg_match('/^[a-zA-Z0-9]{6,22}$/', $new_mdp)) {
    echo "Vérifiez la taille de votre nouveau mot de passe :(6-22)";
    exit;
}
    # Check if passwords match
if ($new_mdp !== $confirm_mdp) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

// Update password in our base ---------------------------------------------------------------------------
$hashed_password = password_hash($new_mdp, PASSWORD_DEFAULT);

$update_sql = "UPDATE Utilisateur SET Mdp=? WHERE idUtilisateur=?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ss", $hashed_password, $_SESSION['user_id']);

if ($update_stmt->execute()) {
    echo "<script>alert('Modification réussie!'); window.location.href='../htmls/profil.php';</script>";
} else {
    echo "<script>alert('On a rencontré un problème !'); window.location.href='../htmls/profil.php';</script>";
}

// ------------------------------------------------------------------------------------------------------------

$stmt->close();
$update_stmt->close();
$conn->close();
?>