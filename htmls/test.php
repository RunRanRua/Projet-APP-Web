<?php
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

        // Enregistrer le fichier localement
        $filePath = 'log_data.txt';
        file_put_contents($filePath, $body);

        // Lire le contenu du fichier
        $fileContent = file_get_contents($filePath);

        // Connexion à la base de données
        $mysqli = new mysqli("localhost", "root", "", "mydb");

        // Séparer les trames tous les 33 caractères
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

                // Afficher les trames entre 10h23 et 29s et 10h23 et 41s
                if ($HH == '10' && $mm == '23' && $ss >= '29' && $ss <= '51') {
                    echo "<br /><br />Trame : $trame<br />";
                    echo "T: $T<br />";
                    echo "OOOO: $OOOO<br />";
                    echo "R: $R<br />";
                    echo "C: $C<br />";
                    echo "NN: $NN<br />";
                    echo "VVVV: $VVVV<br />";
                    echo "AAAA: $AAAA<br />";
                    echo "XX: $XX<br />";
                    echo "YYYY: $YYYY<br />";
                    echo "MM: $MM<br />";
                    echo "DD: $DD<br />";
                    echo "HH: $HH<br />";
                    echo "mm: $mm<br />";
                    echo "ss: $ss<br />";

                    // Afficher la température si la trame commence par '0' et insérer dans la base de données
                    if ($C == '3' && $VVVV[0] == '0') {
                        $D = $VVVV[1];
                        $U = $VVVV[2];
                        $d = $VVVV[3];
                        $temperature = "$D$U.$d";
                        echo "Température: $temperature °C<br />";

                        // Insérer dans la table temperature
                        $date = "$YYYY-$MM-$DD";
                        $heure = "$YYYY-$MM-$DD $HH:$mm:$ss";
                        $idCapteurTemperature = 1; 

                        // Vérifier l'existence d'un doublon
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
                }
            }
        }
        $mysqli->close();
    }
}
curl_close($ch);
?>
