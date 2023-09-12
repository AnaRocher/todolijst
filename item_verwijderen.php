<?php 

$pdo = new PDO('mysql:host=localhost:8889;dbname=todo_applicatie', 'root', 'root');

$query = $pdo->prepare("DELETE FROM todo_items WHERE id=:id");
$query->execute([
    'id' => $GET['id']
]);

header('location: index.php');
exit;

?>