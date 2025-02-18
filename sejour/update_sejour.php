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
    $id_sejour = $_POST["id_sejour"]; // Récupération de l'ID du séjour
    $debut = $_POST["debut"];
    $fin = $_POST["fin"];

    $sql = "UPDATE sejour SET debut=?, fin=? WHERE id_sejour=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $debut, $fin, $id_sejour); 

    if ($stmt->execute()) {
        header('Location: all_sejour.php'); 
        exit();
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
