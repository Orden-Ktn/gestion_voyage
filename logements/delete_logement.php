<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_voyage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];

    $sql = "DELETE FROM logement WHERE nom=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nom);

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
