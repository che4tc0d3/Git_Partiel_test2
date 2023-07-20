<?php

// Connexion à la base de données (remplacez les valeurs par vos informations de connexion)
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_données";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Ajout d'un nouvel article
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date("Y-m-d"); // Date du jour

    // Requête d'insertion
    $sql = "INSERT INTO articles (title, content, date) VALUES ('$title', '$content', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "Nouvel article ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'article : " . $conn->error;
    }
}

// Récupération de tous les articles
$sql = "SELECT * FROM articles";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des articles</title>
</head>

<body>
    <h1>Gestion des articles</h1>

    <!-- Formulaire d'ajout d'un nouvel article -->
    <h2>Ajouter un nouvel article</h2>
    <form method="post" action="">
        <label for="title">Titre :</label>
        <input type="text" name="title" required><br>
        <label for="content">Contenu :</label><br>
        <textarea name="content" rows="4" cols="50" required></textarea><br>
        <input type="submit" name="submit" value="Ajouter">
    </form>

    <!-- Affichage des articles existants -->
    <h2>Articles existants</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>Date : " . $row['date'] . "</p>";
            echo "<p>" . $row['content'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "Aucun article trouvé.";
    }
    ?>

</body>

</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
