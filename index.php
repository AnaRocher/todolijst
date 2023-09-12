<?php

include './includes/initialize.php';

$query = $pdo->query('SELECT * FROM todo_items WHERE Afgewerkt=0');
$todoitems = $query->fetchAll();

$query = $pdo->query('SELECT * FROM todo_items WHERE Afgewerkt=1');
$completed_items = $query->fetchAll();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo items</title>
    <link rel="stylesheet" href="todolijst.css">
</head>

<body>
    <header>
        <h1>Todo items</h1>
        <p>
            <a href="item_toevoegen.php">Nieuw item toevoegen</a>
        </p>
    </header>

    <?php if (count($todoitems)): ?>
    <ul>
        <?php foreach($todoitems as $item): ?>
        <li>
            <span class="Prioriteit-<?php echo $item['Prioriteit'] ?>"></span>
            <span><?php echo $item['Omschrijving'] ?></span>
            <p>
                <a href="item_details.php?id=<?php echo $item['Id'] ?>">details</a> -
                <a href="item_aanpassen.php?id=<?php echo $item['Id'] ?>">aanpassen</a> -
                <a href="item_verwijderen.php?id=<?php echo $item['Id'] ?>">verwijderen</a>
            </p>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>Er zijn geen todo items te doen!</p>
    <?php endif; ?>

    <section>
        <h2>Afgewerkte items</h2>

        <?php if (count($completed_items)): ?>
        <ul>
            <?php foreach($completed_items as $item): ?>
            <li>
                <span class="Prioriteit-<?php echo $item['Prioriteit'] ?>"></span>
                <span><?php echo $item['Omschrijving'] ?></span>
                <p>
                    <a href="item_details.php?id=<?php echo $item['Id'] ?>">details</a> -
                    <a href="item_aanpassen.php?id=<?php echo $item['Id'] ?>">aanpassen</a> -
                    <a href="item_verwijderen.php?id=<?php echo $item['Id'] ?>">verwijderen</a>
                </p>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>Er zijn geen afgewerkte items.</p>
        <?php endif; ?>
    </section>

</body>

</html>