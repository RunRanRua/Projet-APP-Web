<!DOCTYPE html>
<html>
<head>
    <title>Affichage des températures</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .data {
            margin: 20px 0;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .data h2 {
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Affichage des températures</h1>
        <form method="POST" action="">
            <label for="start_date">Date de début :</label>
            <input type="date" id="start_date" name="start_date" required>
            
            <label for="start_time">Heure de début (format HH:mm:ss):</label>
            <input type="text" id="start_time" name="start_time" placeholder="Ex: 10:23:29" required>
            
            <label for="end_date">Date de fin :</label>
            <input type="date" id="end_date" name="end_date" required>
            
            <label for="end_time">Heure de fin (format HH:mm:ss):</label>
            <input type="text" id="end_time" name="end_time" placeholder="Ex: 10:23:51" required>
            
            <input type="submit" value="Afficher les trames">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start_date = $_POST["start_date"];
            $start_time = $_POST["start_time"];
            $end_date = $_POST["end_date"];
            $end_time = $_POST["end_time"];

            session_start(); 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://projets-tomcat.isep.fr:8080/appService?ACTION=GETLOG&TEAM=G10d");
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_VERBOSE, TRUE); 

            $data = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Erreur cURL : ' . curl_error($ch);
            } else {
                if (empty($data)) {
                    echo "Aucune donnée reçue.";
                } else {
                    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                    $headers = substr($data, 0, $header_size);
                    $body = substr($data, $header_size);

                    $filePath = 'log_data.txt';
                    file_put_contents($filePath, $body);
                    $fileContent = file_get_contents($filePath);

                    $mysqli = new mysqli("localhost", "root", "", "mydb");

                    $trames = str_split($fileContent, 33);

                    foreach ($trames as $trame) {
                        if (strlen($trame) == 33) {
                            $T = substr($trame, 0, 1);
                            $OOOO = substr($trame, 1, 4);
                            $R = substr($trame, 5, 1);
                            $C = substr($trame, 6, 1);
                            $NN = substr($trame, 7, 2);
                            $VVVV = substr($trame, 9, 4);
                            $AAAA = substr($trame, 13, 4);
                            $XX = substr($trame, 17, 2);
                            $YYYY = substr($trame, 19, 4);
                            $MM = substr($trame, 23, 2);
                            $DD = substr($trame, 25, 2);
                            $HH = substr($trame, 27, 2);
                            $mm = substr($trame, 29, 2);
                            $ss = substr($trame, 31, 2);

                            $current_datetime = "$YYYY-$MM-$DD $HH:$mm:$ss";

                            if ($current_datetime >= "$start_date $start_time" && $current_datetime <= "$end_date $end_time") {
                                echo "<div class='data'>";
                                echo "<h2>Trame : $trame</h2>";
                                echo "Date: $YYYY-$MM-$DD<br />";
                                echo "Heure: $HH:$mm:$ss<br />";

                                if ($C == '3' && $VVVV[0] == '0') {
                                    $D = $VVVV[1];
                                    $U = $VVVV[2];
                                    $d = $VVVV[3];
                                    $temperature = "$D$U.$d";
                                    echo "Température: $temperature °C<br />";

                                    // Vérifier l'existence d'un doublon
                                    $heure = "$YYYY-$MM-$DD $HH:$mm:$ss";
                                    $idCapteurTemperature = 1;
                                    $date = "$YYYY-$MM-$DD";

                                    $checkStmt = $mysqli->prepare("SELECT COUNT(*) FROM temperature WHERE Heure = ?");
                                    $checkStmt->bind_param("s", $heure);
                                    $checkStmt->execute();
                                    $checkStmt->bind_result($count);
                                    $checkStmt->fetch();
                                    $checkStmt->close();

                                    if ($count == 0) {
                                        // Insérer les données si aucun doublon trouvé
                                        $stmt = $mysqli->prepare("INSERT INTO temperature (date, temperature, idCapteurTemperature, Heure) VALUES (?, ?, ?, ?)");
                                        $stmt->bind_param("ssis", $date, $temperature, $idCapteurTemperature, $heure);

                                        if ($stmt->execute()) {
                                            echo "Donnée de température insérée avec succès.<br />";
                                        } else {
                                            echo "Erreur lors de l'insertion de la donnée de température : " . $stmt->error . "<br />";
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "Doublon détecté pour l'heure : $heure. Aucune donnée insérée.<br />";
                                    }
                                }
                                echo "</div>";
                            }
                        }
                    }
                    $mysqli->close();
                }
            }
            curl_close($ch);
        }
        ?>
    </div>
</body>
</html>
