<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
        <!-- Lien vers une feuille de style CSS externe -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- Contenu de la page -->
        <h1>Inscription</h1>
        <p></p>
    </body>
</html>



<?php
// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupère les données du formulaire
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmation = $_POST['confirmation'];

    // Vérifie si les mots de passe correspondent
    if ($mot_de_passe == $confirmation) {
        // Insère les données dans la base de données
        // Remplacez les valeurs d'hôte, d'utilisateur, de mot de passe et de nom de base de données par vos propres valeurs
     $conn = new mysqli( 'localhost', 'root', 'Yasmina1501@', 'moduleconnexion');
        if ($conn->connect_error) {
            die("Erreur de connexion: " . $conn->connect_error);
        }
        $stmt = $conn->prepare("INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $login, $prenom, $nom, $confirmation);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // Redirige l'utilisateur vers la page de connexion
        header("Location: connexion.php");
        exit;
    } else {
        // Affiche un message d'erreur si les mots de passe ne correspondent pas
        echo "<p>Les mots de passe ne correspondent pas. Veuillez réessayer.</p>";
    }
}
?>

<!-- Affiche le formulaire d'inscription -->
<form method="post" action="inscription.php">
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" required><br>
    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" id="prenom" required><br>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" required><br>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" required><br>
    <label for="confirmation">Confirmation du mot de passe:</label>
    <input type="password" name="confirmation" id="confirmation" required><br>
    <input type="submit" name="submit" value="S'inscrire">
</form>
