<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplois du temps</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Emplois du temps</h1>
    <?php
    // Connexion à la base de données
    $servername = "10.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "proj_physique";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Récupération des salles depuis la base de données
    $sql_salles = "SELECT DISTINCT numero_salle FROM salle";
    $result_salles = $conn->query($sql_salles);

    if ($result_salles->num_rows > 0) {
        $salles_array = array();
        while($row_salles = $result_salles->fetch_assoc()) {
            $salles_array[] = $row_salles["numero_salle"];
        }

        // Création du tableau pour afficher les emplois du temps
        echo "<table>";
        echo "<tr><th>Horaire</th>";

        // Liste des salles
        foreach ($salles_array as $salle) {
            echo "<th>$salle</th>";
        }
        echo "</tr>";

        // Horaires à afficher
        $horaires = array("08:30", "09:30", "10:30", "11:40", "12:30", "13:00", "13:45", "14:45", "15:55", "16:55", "17:50");

        // Remplissage du tableau avec les horaires et les salles
        foreach ($horaires as $horaire) {
            echo "<tr>";
            echo "<td>$horaire</td>";

            foreach ($salles_array as $salle) {
                echo "<td></td>"; // Cellule vide pour chaque salle
            }

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucune salle trouvée dans la base de données.";
    }

    $conn->close();
    ?>
</body>
</html>
