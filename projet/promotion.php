<?php
include 'connexion_base.php';

// Récupérer tous les produits depuis la base de données
$query = "SELECT id_produit, lib_produit, quantite_stock, prix_produit, photo_produit, prix_promo 
          FROM produit WHERE prix_promo IS NOT NULL";
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
    <title>Promotions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>Promotions Spéciales</h1>
        <p>Profitez des meilleures offres du moment !</p>
    </header>
    
    <main class="promotions">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php 
        $prix_promo = $row['prix_promo'];

        // Calculer prix promo si non défini
        if (empty($prix_promo)) {
            $prix_promo = $row['prix_produit'] / 2;

            // Optionnel : mise à jour en base de données
            $update_query = "UPDATE produit SET prix_promo = ? WHERE id_produit = ?";
            $update_stmt = mysqli_prepare($connexion, $update_query);
            mysqli_stmt_bind_param($update_stmt, "di", $prix_promo, $row['id_produit']);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);
        }
        ?>
        <section class="promo-item">
            <img src="images1/<?= htmlspecialchars($row['photo_produit']) ?>" 
                 alt="Photo du produit <?= htmlspecialchars($row['lib_produit']) ?>">
            <h2><?= htmlspecialchars($row['lib_produit']) ?></h2>
            <p class="old-price"><?= number_format($row['prix_produit'], 2) ?>&nbsp;€</p>
            <p class="new-price"><?= number_format($prix_promo, 2) ?>&nbsp;€</p>
            <button class="btn">Acheter maintenant</button>
        </section>
    <?php endwhile; ?>
</main>

    
    <footer class="footer">
        <p>&copy; 2025 Votre Boutique. Tous droits réservés.</p>
    </footer>
</body>
</html>
