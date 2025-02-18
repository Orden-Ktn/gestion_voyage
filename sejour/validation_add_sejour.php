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

    // Connexion à la base de données
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'gestion_voyage';

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Vérification de la connexion
    if($conn->connect_error){
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Insertion des données dans la table `sejour`
    $stmt = $conn->prepare("INSERT INTO sejour (debut, fin, code_logement, id_voyageur) VALUES (?, ?, ?, ?)");
    
    if(!$stmt){
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("ssss", $debut, $fin, $code_logement, $id_voyageur);

    if($stmt->execute()){
        $stmt_update = $conn->prepare("UPDATE logement SET disponibilite = 'Non' WHERE code = ?");
        
        if($stmt_update){
            $stmt_update->bind_param("s", $code_logement);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            echo "Erreur lors de la mise à jour du logement : " . $conn->error;
        }

        // Redirection après succès
        header('Location: all_sejour.php');
        exit();
    } else {
        echo "Erreur lors de l'insertion : " . $stmt->error;
    }

    // Fermeture des connexions
    $stmt->close();
    $conn->close();
}
?>
