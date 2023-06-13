<!DOCTYPE html>
<html>
    <head>
        <title>Titre de la page</title>
        <!-- Lien vers une feuille de style CSS externe -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- Contenu de la page -->
        <h1>Titre de la page</h1>
        <p>Contenu de la page</p>
    </body>
</html>



<?php

// Démarre une session
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit;
}

// Récupère les informations de l'utilisateur à partir de la base de données
// Remplacez les valeurs d'hôte, d'utilisateur, de mot de passe et de nom de base de données par vos propres valeurs
$conn = new mysqli( 'localhost', 'root', 'Yasmina1501@', 'moduleconnexion');

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
$stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login=?");
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("Erreur: utilisateur introuvable");
}
$stmt->close();
$conn->close();

// Vérifie si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupère les données du formulaire
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Met à jour les informations de l'utilisateur dans la base de données
    // Remplacez les valeurs d'hôte, d'utilisateur, de mot de passe et de nom de base de données par vos propres valeurs
    $conn = new mysqli( 'localhost', 'root', 'Yasmina1501@', 'moduleconnexion');
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("UPDATE utilisateurs SET login=?, prenom=?, nom=?, password=? WHERE login=?");
    $stmt->bind_param("sssss", $login, $prenom, $nom, $mot_de_passe, $_SESSION['login']);
    $stmt->execute();
    

    // Met à jour la variable de session avec le nouveau login
    $_SESSION['login'] = $login;

    // Affiche un message indiquant que les informations ont été mises à jour
    echo "<p>Vos informations ont été mises à jour.</p>";
}
?>

<!-- Affiche le formulaire de modification du profil -->
<form method="post">
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" value="<?php echo htmlspecialchars($user['login']); ?>" required><br>
    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" id="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" required><br>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required><br>
    <label for="mot_de_passe">Mot de passe:</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" value="<?php echo htmlspecialchars($user['password']); ?>" required><br>
    <input type="submit" name="submit" value="Mettre à jour">
</form>
