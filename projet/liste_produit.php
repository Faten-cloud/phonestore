<?php
include 'connexion_base.php';

// Récupérer tous les produits depuis la base de données
$query = "SELECT id_produit, lib_produit, quantite_stock, prix_produit, photo_produit FROM produit";
$result = mysqli_query($connexion, $query);

// Vérifier si la requête a réussi
if (!$result) {
    die("Erreur dans la requête : " . mysqli_error($connexion));
}
?>
<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .custom-thead {
        background-color: #ff7f7f; /* Rouge clair */
        color: white; /* Couleur du texte pour un bon contraste */
    }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0" style="color: red;">Liste des Produits</h2>
            <a href="produit_formulaire.php" class="btn btn-success">Ajout Produit</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="custom-thead">
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Quantité en Stock</th>
                    <th>Prix</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_produit']); ?></td>
                        <td><?php echo htmlspecialchars($row['lib_produit']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantite_stock']); ?></td>
                        <td><?php echo htmlspecialchars($row['prix_produit']); ?> €</td>
                        <td>
                            <?php if (!empty($row['photo_produit'])) : ?>
                                <img src="image_produits/<?php echo htmlspecialchars($row['photo_produit']); ?>" alt="Photo du produit" width="100">
                            <?php else : ?>
                                <span>Aucune image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="modifier_produit.php?id=<?php echo $row['id_produit']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_produit.php?id=<?php echo $row['id_produit']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Fermer la connexion à la base de données -->
    <?php mysqli_close($connexion); ?>
</body>
</html>