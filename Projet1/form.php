<?php 
$conn = new mysqli("localhost", "root", "", "commentaires_db");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
if ($post_id <=0) {
  die("Post ID erreur");
}

// Supprimer un commentaire
if (isset($_GET['supprimer'])) {
  $id = intval($_GET['supprimer']);
  $stmt = $conn->prepare("DELETE FROM commentaires WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: form.php?post_id=$post_id");
  exit;
}

// Modifier un commentaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
  $id = intval($_POST['id']);
  $nom = $_POST['nom'];
  $commentaire = $_POST['commentaire'];

  $stmt = $conn->prepare("UPDATE commentaires SET nom=?, commentaire=? WHERE id=?");
  $stmt->bind_param("ssi", $nom, $commentaire, $id);
  $stmt->execute();
  $stmt->close();
  header("Location: form.php?post_id=$post_id");
  exit;
}
//recuper les coms
$stmt = $conn->prepare("SELECT * FROM commentaires WHERE post_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$commentaires = $stmt->get_result();
$stmt->close();

// Si on veut modifier un commentaire spécifique (via GET)
$modifier_id = isset($_GET['modifier_id']) ? intval($_GET['modifier_id']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Home.css" />
    <title>commentaire</title>
  </head>

  <body>
    <h1>Commentaire</h1>
    
    <?php while ($row = $commentaires->fetch_assoc()): ?>
  <div class="comms">

    <?php if ($modifier_id === $row['id']): ?>
      <!-- Formulaire pour modifier ce commentaire -->
      <form method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <label><?= htmlspecialchars($row['nom']) ?></label><br>
        <!-- <input type="text" name="nom" value="<?= htmlspecialchars($row['nom']) ?>" required><br> -->
        <textarea name="commentaire" required><?= htmlspecialchars($row['commentaire']) ?></textarea><br>
        <button type="submit" name="modifier">Enregistrer</button>
        <a href="form.php?post_id=<?= $post_id ?>">Annuler</a>
      </form>
    <?php else: ?>
      <!-- Affichage simple du commentaire -->
      <strong><?= htmlspecialchars($row['nom']) ?></strong> : 
      <?= nl2br(htmlspecialchars($row['commentaire'])) ?>

      <!-- Icône modifier : redirige vers cette même page avec ?modifier_id=xxx -->
      <a href="form.php?post_id=<?= $post_id ?>&modifier_id=<?= $row['id'] ?>" class="icon-button">
        <img src="image/modif.png" alt="Modifier" />
      </a>

      <!-- Icône supprimer -->
      <a href="form.php?post_id=<?= $post_id ?>&supprimer=<?= $row['id'] ?>" 
         onclick="return confirm('Supprimer ce commentaire ?')" class="icon-button">
        <img src="image/delete.png" alt="Supprimer" />
      </a>
    <?php endif; ?>
  </div>
<?php endwhile; ?>

    <form action="./Formulaire.php" method="POST">
      <div>
        <div class="C-contener">
          <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
          <label for="nom">pseudo</label>
          <input
            type="text"
            placeholder="Entrer votre nom"
            name="nom"
            required
          />
          <br />
          <textarea
            type="text"
            placeholder="Entrer votre Commentaire"
            name="commentaire"
            required
          ></textarea>

          <br />
        </div>
        <input type="submit" value="envoyer" />
        <br />
  
        <a href="./Home.php">retour</a>
      </div>
    </form>
    <script>
      // Récupérer post_id depuis l'URL
      const params = new URLSearchParams(window.location.search);
      const postId = params.get("post_id");
      if (postId) {
        document.getElementById("postId").value = postId;
      }
    </script>
  </body>
</html>
