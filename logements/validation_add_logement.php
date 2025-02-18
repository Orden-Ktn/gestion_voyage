<?php
session_start();
require('../based.php');

if(isset($_POST['submit'])){
    $nom = trim($_POST['nom']);
    $capacite = trim($_POST['capacite']);
    $type = trim($_POST['type']);
    $lieu = trim($_POST['lieu']);
    $disponibilite = trim($_POST['disponibilite']);

    if(empty($nom) || empty($capacite) || empty($type) || empty($lieu) || empty($disponibilite) || empty($_FILES['photo']['name'])){
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'gestion_voyage';

    // Connexion à la base de données (ajout de la connexion)
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if($conn->connect_error){
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $targetDir = "../uploads/";
    if(!file_exists($targetDir)){
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["photo"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if(!in_array($fileType, $allowedTypes)){
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        exit();
    }

    if(move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)){
        // Insertion des données
        $stmt = $conn->prepare("INSERT INTO logement (nom, capacite, type, lieu, disponibilite, photo) VALUES (?, ?, ?, ?, ?, ?)");
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
