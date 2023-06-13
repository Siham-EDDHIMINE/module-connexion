<?php
// Démarre une session
session_start();

// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupère les données du formulaire
    $login = $_POST['login'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifie si les informations d'identification sont correctes
    // Remplacez les valeurs d'hôte, d'utilisateur, de mot de passe et de nom de base de données par vos propres valeurs
    $conn = new mysqli( 'localhost', 'root', 'Yasmina1501@', 'moduleconnexion');
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login=? AND password=?");
    $stmt->bind_param("ss", $login, $mot_de_passe);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Crée une variable de session pour indiquer que l'utilisateur est connecté
        $_SESSION['login'] = $login;

        // Redirige l'utilisateur vers la page d'accueil
        header("Location: profile.php");
        exit;
    } else {
        // Affiche un message d'erreur si les informations d'identification sont incorrectes
        echo "<p>Informations d'identification incorrectes. Veuillez réessayer.</p>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Titre de la page</title>
        <!-- Lien vers une feuille de style CSS externe -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
       <!-- Affiche le formulaire de connexion -->
<form method="post" action="connexion.php">
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" required><br>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>
    <input type="submit" name="submit" value="Se connecter">
</form>

    </body>
</html>


