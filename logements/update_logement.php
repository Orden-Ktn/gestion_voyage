<?php
require('../based.php');

if (!$connection) {
    die("Échec de connexion à la base de données.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $capacite = $_POST["capacite"];
    $type = $_POST["type"];
    $lieu = $_POST["lieu"];
    $disponibilite = $_POST["disponibilite"];

    $sql = "UPDATE logement SET capacite=?, type=?, lieu=?, disponibilite=? WHERE nom=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $capacite, $type, $lieu, $disponibilite, $nom);

    if ($stmt->execute()) {
        header('Location: all_logements.php'); 
        exit();
    } else {
        echo "error";
    }

    $stmt->close();
}

$connection->close();
?>
