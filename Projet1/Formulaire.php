<?php
$conn = new mysqli("localhost", "root", "", "commentaires_db");
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// on recupere les données du formulaire
$nom = $_POST['nom'];
$commentaire = $_POST['commentaire'];
$post_id = $_POST['post_id'];

// 3. Requête SQL pour l'insetion
$sql = "INSERT INTO commentaire (nom, commentaire, post_id) VALUES (?, ?, ?)";

// Preparation de la requête
$stmt = $conn->prepare($sql);

// tester si la preparation est reussi
if (!$stmt) {
    die("Erreur dans la préparation : " . $conn->error);
}

// 4. Liaison des paramètres et exécution
$stmt->bind_param("ss", $nom, $commentaire, $post_id);
$stmt->execute();

echo "Commentaire enregistré avec succès.<br>";
echo '<a href="./Home.html">Retour</a>';

// rupture
$stmt->close();
$conn->close();
?>