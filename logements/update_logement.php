<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_voyage";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $capacite = $_POST["capacite"];
    $type = $_POST["type"];
    $lieu = $_POST["lieu"];
    $disponibilite = $_POST["disponibilite"];

    $sql = "UPDATE logement SET capacite=?, type=?, lieu=?, disponibilite=? WHERE nom=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $capacite, $type, $lieu, $disponibilite, $nom);

    if ($stmt->execute()) {
        header('Location: all_logements.php'); 
        exit();
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
