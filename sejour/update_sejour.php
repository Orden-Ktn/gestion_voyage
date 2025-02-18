<?php
require('../based.php');

if (!$connection) {
    die("Échec de connexion à la base de données.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_sejour = $_POST["id_sejour"]; // Récupération de l'ID du séjour
    $debut = $_POST["debut"];
    $fin = $_POST["fin"];

    $sql = "UPDATE sejour SET debut=?, fin=? WHERE id_sejour=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $debut, $fin, $id_sejour); 

    if ($stmt->execute()) {
        header('Location: all_sejour.php'); 
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
