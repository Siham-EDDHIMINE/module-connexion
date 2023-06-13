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

// Vérifie si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    // Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté en tant qu'admin
    header("Location: connexion.php");
    exit;
}

// Récupère la liste des utilisateurs à partir de la base de données

$conn = new mysqli( 'localhost', 'root', 'Yasmina1501@', 'moduleconnexion');
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM utilisateurs");
$users = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!-- Affiche la liste des utilisateurs -->
<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Mot de passe</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['login']); ?></td>
            <td><?php echo htmlspecialchars($user['prenom']); ?></td>
            <td><?php echo htmlspecialchars($user['nom']); ?></td>
            <td><?php echo htmlspecialchars($user['mot_de_passe']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

