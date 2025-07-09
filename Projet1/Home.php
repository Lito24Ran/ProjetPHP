<?php
$conn = new mysqli("localhost", "root", "", "commentaires_db");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer tous les posts
$sql_posts = "SELECT * FROM posts ORDER BY id DESC";
$result_posts = $conn->query($sql_posts);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Page commentaire</title>
    <link rel="stylesheet" href="Home.css" />
  </head>

  <body>
    <h1>Com's e</h1>
    <div class="container">
      <div class="post">
        Ito zany sary nampidirin'i Lito sady manao test ihany hoe ahoana izy ato
        zala , mety ve?
      </div>
      <img src="./image/imagePersonne.jpg" alt="image personne" />

      <div class="post_action">
        <div>
          <span class="jadore">J'adore</span>
        </div>
        <div class="commes">
          <a href="./form.php?post_id=1"
            ><img src="./image/coms.png" alt="commenter" class="coms"
          /></a>
        </div>
        <?php
  $post_id = 1; // id fixé manuellement ici
  $stmt = $conn->prepare("SELECT nom, commentaire FROM commentaires WHERE post_id = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("i", $post_id);
  $stmt->execute();
  $result_comment = $stmt->get_result();

  if ($result_comment->num_rows > 0):
      $comment = $result_comment->fetch_assoc();
  ?>
  <div class="comment">
        <strong><?php echo htmlspecialchars($comment['nom']); ?>:</strong>
        <?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?>
  </div>
  <?php
  endif;
  $stmt->close();
  ?>
      </div>
    </div>
    <div class="container">
      <div class="post">
        ary Lito kay efa manao bol any an-dafy , de tsy akikozikozy a 
      </div>
      <img src="./image/huijsen.png" alt="image personne" />

      <div class="post_action">
        <div>
          <span class="jadore">J'adore</span>
        </div>
        <div class="commes">
          <a href="./form.php?post_id=2"
            ><img src="./image/coms.png" alt="commenter" class="coms"
          /></a>
        </div>

      </div>
                <!-- Affichage dynamique des commentaires pour post_id = 1 -->
  <?php
  $post_id = 2; // id fixé manuellement ici
  $stmt = $conn->prepare("SELECT nom, commentaire FROM commentaires WHERE post_id = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("i", $post_id);
  $stmt->execute();
  $result_comment = $stmt->get_result();

  if ($result_comment->num_rows > 0):
      $comment = $result_comment->fetch_assoc();
  ?>
  <div class="comment">
        <strong><?php echo htmlspecialchars($comment['nom']); ?>:</strong>
        <?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?>
  </div>
  <?php
  endif;
  $stmt->close();
  ?>

    </div>
    <div class="container">
      <div class="post">
        Je vous presente la femme de ma vie <3 </div>
      <img
        src="./image/nana"
        alt="Cette photo n'est pas disponible sur votre pays"
      />

      <div class="post_action">
        <div>
          <span class="jadore">J'adore</span>
        </div>
        <div class="commes">
          <a href="./form.php?post_id=3"
            ><img src="./image/coms.png" alt="commenter" class="coms"
          /></a>
        </div>
      </div>
      <?php
  $post_id = 3; // id fixé manuellement ici
  $stmt = $conn->prepare("SELECT nom, commentaire FROM commentaires WHERE post_id = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("i", $post_id);
  $stmt->execute();
  $result_comment = $stmt->get_result();

  if ($result_comment->num_rows > 0):
      $comment = $result_comment->fetch_assoc();
  ?>
  <div class="comment">
        <strong><?php echo htmlspecialchars($comment['nom']); ?>:</strong>
        <?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?>
  </div>
  <?php
  endif;
  $stmt->close();
  ?>
    </div>
    <?php $conn->close(); ?>
  </body>
  <footer>
    zay fotsiny aloha 
  </footer>
</html>
