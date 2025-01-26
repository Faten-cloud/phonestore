
<?php
include 'connexion_base.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom_user'];
    $password = $_POST['password_user'];
    $password_validation = $_POST['password_validation_user'];
    $email = $_POST['email_user'];
    
    // Gestion du fichier photo
    $photo = $_FILES['photo_user']['name'];
    $photo_tmp = $_FILES['photo_user']['tmp_name'];

    // Vérification des mots de passe
    if ($password !== $password_validation) {
        echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
        echo "<script>window.location.href='registration.php';</script>";
        exit();  // Stop further script execution
    }
    

    // Hachage du mot de passe pour la sécurité
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête d'insertion

    // $req = "SELECT user_password FROM users WHERE user_name = '$nom'";
    // $result = mysqli_query($connexion, $req);



    $req = "INSERT INTO users (user_name, user_password, user_email, user_photo) VALUES (?, ?, ?, ?)";
    // $req = "INSERT INTO users (user_name, user_password, email, photo) VALUES ($nom, $hashed_password, $email, $photo)";
    $stmt = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($stmt, "ssss", $nom, $hashed_password, $email, $photo);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        // Déplacer le fichier téléchargé dans un répertoire
        move_uploaded_file($photo_tmp, $photo);

        // move_uploaded_file($photo_tmp, "uploads/" . $photo); // Assurez-vous que le dossier "uploads" existe
        echo "Inscription réussie !";
        echo "<script>window.location.href='login_database.html'</script>";

    } 
    else {
        // Afficher l'erreur de connexion à la base de données
        $error_message = mysqli_error($connexion);
        echo "<script>alert('Erreur : $error_message'); window.location.href='login_database.html';</script>";
    }

    // Fermer la déclaration et la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($connexion);
}
?>

