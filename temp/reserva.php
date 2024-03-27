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
    // Nombre de salles
    $nombre_de_salles = 5;

    // horaire de début
    $horaire_debut = strtotime("08:30");

    // horaire de fin
    $horaire_fin = strtotime("17:30");

    // Connexion à la base de données
    $servername = "10.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "proj_physique";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    // Création du tableau pour afficher les emplois du temps
    echo "<table>";
    echo "<tr><th>horaire</th>";
    
    // Liste des salles
    for ($i = 1; $i <= $nombre_de_salles; $i++) {
        echo "<th>Salle $i</th>";
    }
    echo "</tr>";

    // Remplissage du tableau avec les horaires et les salles
    $current_time = $horaire_debut;
    while ($current_time <= $horaire_fin) {
        echo "<tr>";
        echo "<td>" . date("H:i", $current_time) . "</td>";

        // Récupération des données depuis la base de données pour chaque salle
        for ($i = 1; $i <= $nombre_de_salles; $i++) {
            $sql = "SELECT COUNT(*) FROM reservation WHERE horaire = '" . date("H:i", $current_time) . "' AND salle = 'Salle $i'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $count = $row["COUNT(*)"];
            echo "<td>$count</td>";
        }

        echo "</tr>";
        $current_time += 1800; // Ajoute 30 minutes
    }
    echo "</table>";

    $conn->close();
    ?>
</body>
</html>
