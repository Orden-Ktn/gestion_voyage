<?php
session_start();
require('../based.php');

if(isset($_POST['submit'])){
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $sexe = trim($_POST['sexe']);
    $ville = trim($_POST['ville']);
    $region = trim($_POST['region']);

    if(empty($nom) || empty($prenom) || empty($sexe) || empty($ville) || empty($region)){
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Connexion à la base de données
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'gestion_voyage';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if($conn->connect_error){
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO voyageur (nom, prenom, sexe, ville, region) VALUES (?, ?, ?, ?, ?)");
    
    if(!$stmt){
        die("Erreur de préparation : " . $conn->error);
    }

    $stmt->bind_param("sssss", $nom, $prenom, $sexe, $ville, $region);

    if($stmt->execute()){
        header('Location: all_voyageur.php'); 
        exit();
    } else {
        echo "Erreur lors de l'insertion : " . $stmt->error;
    }

    // Fermeture
    $stmt->close();
    $conn->close();
}
?>
