<?php
include 'dbconfig.php';

$q = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "SELECT titre, contenu FROM posts WHERE titre LIKE ? OR contenu LIKE ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(["%$q%", "%$q%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $post) {
    echo '<div class="post">';
    echo '<h3 class="topic">'.htmlspecialchars($post['titre']).'</h3>';
    echo '<p class="content">'.nl2br(htmlspecialchars($post['contenu'])).'</p>';
    echo '</div>';
}
?>
