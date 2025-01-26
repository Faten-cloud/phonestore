<?php
// Démarrer la session
session_start();
// echo "Bienvenue, " . $_SESSION['user_name'] ;
// echo "L'ID de la session est : " . session_id();

// Connexion à la base de données
// $connexion = mysqli_connect("localhost", "souhail", "", "esps");

// // Vérifier la connexion
// if ($connexion) {
//     echo "<p>Connexion réussie</p>";
// } else {
//     echo "<p>Erreur de connexion : " . mysqli_connect_error() . "</p>";
//     exit(); // Stopper l'exécution si la connexion échoue
// }
include 'connexion_base.php';
// Vérifier si les données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $user_name = $_POST['user_name'];
    $user_password =  $_POST['user_password'];

    // $user_name = mysqli_real_escape_string($connexion, $_POST['user_name']);
    // $user_password = mysqli_real_escape_string($connexion, $_POST['user_password']);

    // Requête pour récupérer le mot de passe de l'utilisateur
    $req = "SELECT user_password,user_photo FROM users WHERE user_name = '$user_name'";
    $result = mysqli_query($connexion, $req);

    // Vérifier si la requête a retourné un résultat
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['user_password'];
        
        $photo=$row['user_photo'];

        $hashed_password = $row['user_password'];
       
        // Vérifier si le mot de passe est correct
        if (password_verify($user_password, $hashed_password)){




        // Vérifier si le mot de passe est correct
        // if ($user_password === $password) {
            // Stocker les informations de connexion dans la session
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['avatar']=$photo;

            // Rediriger vers la page loisir.html
            header("Location: liste_produit_carte.php");
            exit();
        } 
        
        else {
            echo "<script>alert('Informations d\'identification incorrectes.'); 
            window.location.href='login_database.html';</script>";
        }
        
        
        
        
        
        
    } else {
        // Afficher un message d'erreur
        echo "<script>alert('Nom d\'utilisateur incorrect.');
        window.location.href='login_database.html';</script>";
        // header("Location: login_database.html");
    }
} else {
    // Afficher un message d'erreur
    echo "<script>alert('Aucune donnée n\'a été soumise.');
    window.location.href='login_database.html';</script>";
    // header("Location: login_database.html");
}

// Fermer la connexion
mysqli_close($connexion);
?>
