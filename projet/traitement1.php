<html>
  <head>
     <title>Résultat du formulaire</title>
  </head>

<body>
<?php 
// Cette page reçoit et traite les informations générées par ex1.html
echo "Votre nom est : {$_GET['nom']}. <br> \n";
echo "Votre prénom est :".$_GET['prenom'].'<br>';
echo "Votre adresse e-mail est : {$_GET['email']}. <br> \n";
echo "Voici ce que vous avez dit :  {$_GET['commentr']}. <br> \n";
?>
</body>
</html>
