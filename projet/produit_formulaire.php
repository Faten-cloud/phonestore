<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #preview {
            display: none;
            margin-top: 10px;
            max-width: 200px;
            max-height: 200px;
        }
    </style>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Ajout Produit</h1>
        <form method="POST" action="insertion_produit.php" enctype="multipart/form-data">
            id : <input type="text" id="id_produit" name="id_produit" required class="form-control" /><br>
            Libellé : <input type="text" id="libelle_produit" name="libelle_produit" required class="form-control" /><br>
            Quantité : <input type="text" id="quantite_stock" name="quantite_stock" required class="form-control" /><br>
            Prix : <input type="text" id="prix_produit" name="prix_produit" required class="form-control" /><br>
            
            <div class="form-group">
                <label for="photo">Choisissez une image :</label>
                <input type="file" class="form-control" id="photo" name="photo_produit" accept="image/*" required onchange="previewImage(event)">
            </div>
            <img id="preview" src="#" alt="Aperçu de l'image" class="img-fluid">
            
            <button type="submit" class="btn btn-primary mt-3">Valider</button>
            <button type="reset" class="btn btn-secondary mt-3">Effacer</button>
        </form>
    </div>
</body>
</html>





