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
        <h1>Inscription</h1>
        <form method="POST" action="registration_database.php" enctype="multipart/form-data">
            User: <input type="text" id="nom" name="nom_user" required class="form-control" /><br>
            Password: <input type="password" id="password" name="password_user" required class="form-control" /><br>
            Password Validation: <input type="password" id="password_validation" name="password_validation_user" required class="form-control" /><br>
            Email: <input type="email" id="email" name="email_user" required class="form-control" /><br>
            
            <div class="form-group">
                <label for="photo">Choisissez une image :</label>
                <input type="file" class="form-control" id="photo" name="photo_user" accept="image/*" required onchange="previewImage(event)">
            </div>
            <img id="preview" src="#" alt="Aperçu de l'image" class="img-fluid">
            
            <button type="submit" class="btn btn-primary mt-3">S'inscrire</button>
            <button type="reset" class="btn btn-secondary mt-3">Effacer</button>
        </form>
    </div>
</body>
</html>





