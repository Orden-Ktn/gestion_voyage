<?php
session_start();
require('../based.php'); // Inclusion du fichier de connexion

if (!$connection) {
    die("Échec de connexion à la base de données.");
}

if (isset($_POST['submit'])) {
    $nom = trim($_POST['nom']);
    $capacite = trim($_POST['capacite']);
    $type = trim($_POST['type']);
    $lieu = trim($_POST['lieu']);
    $disponibilite = trim($_POST['disponibilite']);

    // Vérification des champs vides
    if (empty($nom) || empty($capacite) || empty($type) || empty($lieu) || empty($disponibilite) || empty($_FILES['photo']['name'])) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Gestion de l'upload d'image
    $targetDir = "../uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Vérification du type de fichier
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        exit();
    }

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
        // Insertion des données
        $stmt = $connection->prepare("INSERT INTO logement (nom, capacite, type, lieu, disponibilite, photo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissss", $nom, $capacite, $type, $lieu, $disponibilite, $targetFilePath);
        
        if($stmt->execute()){
            header('Location: all_logements.php'); 
            exit();
        } else {
            echo "Erreur lors de l'insertion : " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }

    $conn->close();
}
?>
