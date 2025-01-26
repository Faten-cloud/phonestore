<?php
include 'connexion_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id_produit'];
    $lib = $_POST['libelle_produit'];
    $quantite = $_POST['quantite_stock'];
    $prix = $_POST['prix_produit'];
    
    // Gestion du fichier photo
    $photo = $_FILES['photo_produit']['name'];
    $photo_tmp = $_FILES['photo_produit']['tmp_name'];

    // Vérifier si le produit existe déjà par son ID ou libellé
    $check_query = "SELECT * FROM produit WHERE id_produit = ? ";
    $check_stmt = mysqli_prepare($connexion, $check_query);
    mysqli_stmt_bind_param($check_stmt, "s", $id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        // Le produit existe déjà
        echo "<script>alert('Erreur : Le produit avec cet ID ou libellé existe déjà.'); window.location.href='produit_formulaire.php';</script>";
    } else {
        // Insérer le nouveau produit
        $insert_query = "INSERT INTO produit (id_produit, lib_produit, quantite_stock, prix_produit, photo_produit) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $insert_query);
        mysqli_stmt_bind_param($stmt, "sssss", $id, $lib, $quantite, $prix, $photo);

        if (mysqli_stmt_execute($stmt)) {
            // Déplacer le fichier téléchargé dans un répertoire
            move_uploaded_file($photo_tmp, "image_produits/" . $photo);
            echo "Insertion de produit réussie !";
            echo "<script>window.location.href='liste_produit.php';</script>";
        } else {
            // Afficher l'erreur de connexion à la base de données
            $error_message = mysqli_error($connexion);
            echo "<script>alert('Erreur : $error_message'); window.location.href='produit_formulaire.php';</script>";
        }

        // Fermer la déclaration
        mysqli_stmt_close($stmt);
    }

    // Fermer la déclaration de vérification et la connexion
    mysqli_stmt_close($check_stmt);
    mysqli_close($connexion);
}
?>
