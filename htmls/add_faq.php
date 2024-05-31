<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydb4";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $question = $_POST['Question'];
        $answer = $_POST['Reponse'];

        $stmt = $conn->prepare("INSERT INTO faq (Titre, Contenu) VALUES (:question, :answer)");
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        $stmt->execute();

        echo json_encode(['success' => true]);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
