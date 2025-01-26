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
    <title>Liste des Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Liste des Articles</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <?php if (!empty($row['photo_produit'])) : ?>
                            <img src="images1/<?php echo htmlspecialchars($row['photo_produit']); ?>" class="card-img-top" alt="Photo du produit">
                        <?php else : ?>
                            <img src="images1/default.png" class="card-img-top" alt="Photo par défaut">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['lib_produit']); ?></h5>
                            <p class="card-text">
                                Quantité en stock : <strong><?php echo htmlspecialchars($row['quantite_stock']); ?></strong><br>
                                Prix : <strong><?php echo htmlspecialchars($row['prix_produit']); ?> €</strong>
                            </p>
                            <a href="modifier_produit.php?id=<?php echo htmlspecialchars($row['id_produit']); ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer_produit.php?id=<?php echo htmlspecialchars($row['id_produit']); ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php mysqli_close($connexion); ?>
</body>
</html>
