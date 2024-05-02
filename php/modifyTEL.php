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

$numero = $conn->real_escape_string($_POST['numero']);

// Check isEmpty
if (empty($numero)){
    echo "Veuillez saisir votre numéro de téléphone.";
    exit;
}

// verify the format
if (!preg_match('/^(06|07)\d{8}$/', $numero)) {
    echo "Saisissez un vrai numéro";
    exit;
}

// Update password in our base ---------------------------------------------------------------------------

$update_sql = "UPDATE Utilisateur SET Numero=? WHERE idUtilisateur=?";
$update_stmt = $conn->prepare($update_sql);
$update_stmt->bind_param("ss", $numero, $_SESSION['user_id']);

if ($update_stmt->execute()) {
    $_SESSION['numero'] = $numero;
    echo "<script>alert('Modification réussie!'); window.location.href='../htmls/profil.php';</script>";
} else {
    echo "<script>alert('On a rencontré un problème !'); window.location.href='../htmls/profil.php';</script>";
}

// ------------------------------------------------------------------------------------------------------------
$stmt->close();
$update_stmt->close();
$conn->close();
?>