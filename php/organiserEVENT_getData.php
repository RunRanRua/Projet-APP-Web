<?php
header('Content-Type: aplication/json');

// Server Access  ------------------------------------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error ]));
}

// get POST data
$data = json_decode(file_get_contents('php://input'),true);

// check if received data
if (isset($data['choosenDay'])){
    $choosenDay = $data['choosenDay'];
    $disabledTime = [];

    // prepare sql
    $sql = "SELECT Debut_heure,Fin_heure FROM concert WHERE Date_concert = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $choosenDay);
    $stmt->execute();
    $result = $stmt->get_result();

    // get data from db
    while($row = $result->fetch_assoc()){
        $disabledTime[] = $row;
    }
    echo json_encode($disabledTime);

    $stmt->close();
}else{
    echo json_encode(["error" => "invalid request"]);
}
$conn->close();
?>