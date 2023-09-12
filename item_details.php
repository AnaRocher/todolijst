<?php

include './includes/initialize.php';

/* if (!isset($_GET['Id'])) {
    header('location: index.php');
    exit;
} */

$query = $pdo->prepare('SELECT * FROM todo_items WHERE id=:id');
$query->execute([
    'id' => $_GET['id']
]);
$item = $query->fetch();

$datum = new DateTime($item['Datum']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item details</title>
    <link rel="stylesheet" href="todolijst.css">
</head>

<body>
    <header>
        <h1>Todo items</h1>

        <p>
            <a href="index.php">Todo items</a>
        </p>
    </header>

    <h2>Todo: <?php echo $item['Omschrijving'] ?></h2>

    <div>
        <p>
            <a href="item_aanpassen.php?id=<?php echo $item['Id'] ?>">aanpassen</a>
            <a href="item_verwijderen.php?id=<?php echo $item['Id'] ?>">verwijderen</a>

        </p>
    </div>

    <p>Aangemaakt op <?php echo $datum->format('d M Y') ?></p>
    <p> <b> Prioriteit <?php echo $item['Prioriteit'] ?> </b><br></p>
    <p> <b>Status</b> <?php echo $item['Afgewerkt'] ? 'Afgewerkt' : 'Nog af te werken' ?></p>
</body>

</html>