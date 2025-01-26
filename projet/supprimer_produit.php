<?php
include 'connexion_base.php';

// Vérifier si l'ID du produit est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête SQL pour supprimer le produit
    $req = "DELETE FROM produit WHERE id_produit = ?";
    $stmt = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($stmt, "s", $id);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Produit supprimé avec succès !'); window.location.href='liste_produit.php';</script>";
    } else {
        // En cas d'erreur, afficher un message
        $error_message = mysqli_error($connexion);
        echo "<script>alert('Erreur lors de la suppression : $error_message'); window.location.href='liste_produit.php';</script>";
    }

    // Fermer la déclaration et la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($connexion);
} else {
    // Si l'ID n'est pas présent, rediriger vers la liste des produits
    echo "<script>alert('ID du produit manquant !'); window.location.href='liste_produit.php';</script>";
}
?>
