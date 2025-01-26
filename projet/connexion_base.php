<?php
// connexion_database.php
$connexion = mysqli_connect("localhost", "root", "", "projet");

if (!$connexion) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>
