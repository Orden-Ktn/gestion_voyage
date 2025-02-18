<?php
require('../based.php');

if (!$connection) {
    die("Échec de connexion à la base de données.");
}

if (isset($_POST['id'])) {
    $id = trim($_POST['id']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $sexe = trim($_POST['sexe']);
    $ville = trim($_POST['ville']);
    $region = trim($_POST['region']);

    // Vérification des champs vides
    if (empty($id) || empty($nom) || empty($prenom) || empty($sexe) || empty($ville) || empty($region)) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }


    $sql = "UPDATE voyageur SET nom=?, prenom=?, sexe=?, ville=?, region=? WHERE id_voyageur=?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssi", $nom, $prenom, $sexe, $ville, $region, $id);
        
        if ($stmt->execute()) {
            header('Location: all_voyageur.php'); 
            exit();
        } else {
            echo "Erreur lors de la mise à jour : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $connection->error;
    }
}

$connection->close();
?>
