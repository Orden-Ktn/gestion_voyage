<?php
require('../based.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_voyageur'])) {
        $id_voyageur = intval($_POST['id_voyageur']); // Sécurisation de l'entrée

        $sql = "DELETE FROM voyageur WHERE id_voyageur = ?";
        $stmt = mysqli_prepare($connection, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_voyageur);
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode(["success" => true, "message" => "Voyageur supprimé avec succès."]);
            } else {
                echo json_encode(["success" => false, "message" => "Erreur lors de la suppression."]);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(["success" => false, "message" => "Requête incorrecte."]);
        }

        mysqli_close($connection);
    } else {
        echo json_encode(["success" => false, "message" => "ID manquant."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée."]);
}
?>
