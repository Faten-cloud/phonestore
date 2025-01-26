<?php
include 'connexion_base.php';

// Vérifier si l'ID du produit est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations du produit à modifier
    $query = "SELECT * FROM produit WHERE id_produit = ?";
    $stmt = mysqli_prepare($connexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $lib = $row['lib_produit'];
        $quantite = $row['quantite_stock'];
        $prix = $row['prix_produit'];
        $photo = $row['photo_produit'];
        $prix_promo = $row['prix_promo'];

    } else {
        echo "<script>alert('Produit introuvable !'); window.location.href='liste_produit.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID du produit manquant !'); window.location.href='liste_produit.php';</script>";
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lib = $_POST['libelle_produit'];
    $quantite = $_POST['quantite_stock'];
    $prix = $_POST['prix_produit'];

    // Gestion du fichier photo
    if (!empty($_FILES['photo_produit']['name'])) {
        $photo = $_FILES['photo_produit']['name'];
        $photo_tmp = $_FILES['photo_produit']['tmp_name'];
        move_uploaded_file($photo_tmp, "image_produits/" . $photo);
    }

    // Mettre à jour les informations du produit
    $update_query = "UPDATE produit SET lib_produit = ?, quantite_stock = ?, prix_produit = ?, photo_produit = ? WHERE id_produit = ?";
    $update_stmt = mysqli_prepare($connexion, $update_query);
    mysqli_stmt_bind_param($update_stmt, "sssss", $lib, $quantite, $prix, $photo, $id);

    if (mysqli_stmt_execute($update_stmt)) {
        echo "<script>alert('Produit modifié avec succès !'); window.location.href='liste_produit.php';</script>";
    } else {
        $error_message = mysqli_error($connexion);
        echo "<script>alert('Erreur lors de la modification : $error_message');</script>";
    }

    // Fermer la déclaration
    mysqli_stmt_close($update_stmt);
}

// Fermer la connexion
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modifier le Produit</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="libelle_produit">Libellé</label>
                <input type="text" class="form-control" id="libelle_produit" name="libelle_produit" value="<?php echo htmlspecialchars($lib); ?>" required>
            </div>

            <div class="form-group">
                <label for="quantite_stock">Quantité en Stock</label>
                <input type="number" class="form-control" id="quantite_stock" name="quantite_stock" value="<?php echo htmlspecialchars($quantite); ?>" required>
            </div>

            <div class="form-group">
                <label for="prix_produit">Prix</label>
                <input type="text" class="form-control" id="prix_produit" name="prix_produit" value="<?php echo htmlspecialchars($prix); ?>" required>
            </div>

            <div class="form-group">
                <label for="photo_produit">Photo du Produit</label>
                <input type="file" class="form-control-file" id="photo_produit" name="photo_produit">
                <?php if (!empty($photo)) : ?>
                    <p>Photo actuelle :</p>
                    <img src="image_produits/<?php echo htmlspecialchars($photo); ?>" alt="Photo du produit" width="100">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="liste_produit.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
