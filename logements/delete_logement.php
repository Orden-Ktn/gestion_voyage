<?php
require('../based.php');

if (!$connection) {
    die("Échec de connexion à la base de données.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];

    $sql = "DELETE FROM logement WHERE nom=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $nom);

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
