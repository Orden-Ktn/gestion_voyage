<?php
session_start();
require('../based.php');

if(isset($_POST['submit'])){
    // Récupération des données avec sécurité
    $debut = trim($_POST['debut']);
    $fin = trim($_POST['fin']);
    $code_logement = trim($_POST['code_logement']);
    $id_voyageur = trim($_POST['id_voyageur']);

    // Vérification des champs vides
    if(empty($debut) || empty($fin) || empty($code_logement) || empty($id_voyageur)){
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    if (!$connection) {
        die("Erreur de connexion à la base de données.");
    }

    $stmt = $connection->prepare("INSERT INTO sejour (debut, fin, code_logement, id_voyageur) VALUES (?, ?, ?, ?)");
    
    if(!$stmt){
        die("Erreur de préparation de la requête : " . $connection->error);
    }

    $stmt->bind_param("ssss", $debut, $fin, $code_logement, $id_voyageur);

    if($stmt->execute()){
        $stmt_update = $connection->prepare("UPDATE logement SET disponibilite = 'Non' WHERE code = ?");
        
        if($stmt_update){
            $stmt_update->bind_param("s", $code_logement);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            echo "Erreur lors de la mise à jour du logement : " . $connection->error;
        }

        // Redirection après succès
        header('Location: all_sejour.php');
        exit();
    } else {
        echo "Erreur lors de l'insertion : " . $stmt->error;
    }

    // Fermeture des connexions
    $stmt->close();
    $connection->close();
}
?>
