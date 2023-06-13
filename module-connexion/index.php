<!DOCTYPE html>
<html>
    <head>
    <video autoplay muted loop id="myVideo">
  <source src="https://cdn.pixabay.com/vimeo/828669760/fleur-163869.mp4?width=1280&hash=d23f6c68d20fe8ac3fee37dfdc5760e819f52413" type="video/mp4">
</video>
        <title>Page d'accueil</title>
        <!-- Lien vers une feuille de style CSS externe -->
    <style>
        #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        }
        .content {
        position: fixed;
        top: 0;
        background: rgba(0, 0, 0, 0.5);
        color: #f1f1f1;
        width: 100%;
        }
        a{
            text-decoration: none;
            background-color: black;
            padding: 5px 5px 5px 5px;
            color: white;
        }
    </style>
    </head>
    <body>
        <div class="content">
        <?php
// Affiche un titre de niveau 1
echo "<h1>Bienvenue sur notre site!</h1>";

// Affiche un paragraphe de texte
echo "<p>Ce site vous permet de vous inscrire et de vous connecter pour accéder à des informations exclusives.</p>";

// Affiche un lien vers la page d'inscription
?>

<?php
// Démarre une session
session_start();

// Vérifie si l'utilisateur a cliqué sur le bouton de déconnexion
if (isset($_POST['logout'])) {
    // Supprime les variables de session
    session_unset();

    // Détruit la session
    session_destroy();

    // Redirige l'utilisateur vers la page d'accueil
    header("Location: index.php");
    exit;
}
?>

<!-- Affiche un bouton d'Inscription -->

<a href='inscription.php'>Inscrivez-vous ici</a>
<a href="connexion.php">connexion</a>
        <!-- Contenu de la page -->
        <h1>Page d'accueil</h1>
        <p></p>
        </div>
    </body>
</html>






