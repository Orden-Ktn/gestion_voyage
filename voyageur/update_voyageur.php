<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_voyage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Échec de connexion : " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $ville = $_POST['ville'];
    $region = $_POST['region'];

    $sql = "UPDATE voyageur SET nom='$nom', prenom='$prenom', sexe='$sexe', ville='$ville', region='$region' WHERE id_voyageur='$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: all_voyageur.php'); 
        exit();
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
