<?php
$conn = new mysqli("localhost", "root", "", "commentaires_db");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// on recupere les données du formulaire
$nom = $_POST['nom'];
$commentaire = $_POST['commentaire'];
$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

// 3. Requête SQL pour l'insetion
$sql = "INSERT INTO commentaires (nom, commentaire, post_id) VALUES (?, ?, ?)";

// Preparation de la requête
$stmt = $conn->prepare($sql);

// tester si la preparation est reussi
if (!$stmt) {
    die("Erreur dans la préparation : " . $conn->error);
}

// 4. Liaison des paramètres et exécution
$stmt->bind_param("ssi", $nom, $commentaire, $post_id);
if ($stmt->execute()) {
echo "Commentaire enregistré avec succès.<br>";
echo '<a href="./Home.php">Retour</a>';
} else {
    echo "Erreur lors de l'enregistrement : " . $stmt->error;
}

// rupture
$stmt->close();
$conn->close();
?>