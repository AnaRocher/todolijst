<?php

$pdo = new PDO('mysql:host=localhost:8889;dbname=todo_applicatie', 'root', 'root');

$foutmeldingen = [];

if ($_POST) {
    if (empty($_POST['Omschrijving'])) {
        $foutmeldingen['Omschrijving'] = 'Omschrijving is verplicht';
    } else if (strlen($_POST['Omschrijving']) > 255) {
        $foutmeldingen['Omschrijving'] = 'Omschrijving mag maximum 255 tekens zijn';
    }

    if (empty($foutmeldingen)){
        $query = $pdo->prepare("UPDATE todo_items SET Omschrijving=:Omschrijving, Prioriteit=:Prioriteit, Afgwerkt=:Afgewerkt WHERE Id=:Id");
        $query->execute([
            'Id' => $_GET['Id'],
            'Omschrijving' => $_POST['Omschrijving'],
            'Prioriteit' => $_POST['Prioriteit'],
            'Afgewerkt' => $_POST['Afgewerkt'] ?? 0
        ]);
        header('location: item_details.php?Id='.$_GET['Id']);
        exit;
    }
} else {
    $query = $pdo->prepare('SELECT * FROM todo_items WHERE Id=:Id');
    $query->execute([
        'Id' => $_GET['Id']
    ]);
    $_POST = $query->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item aanpassen</title>
    <link rel="stylesheet" href="todolijst.css">
</head>

<body>
    <header>
        <h1>Todo items</h1>

        <p>
            <a href="index.php">Todo items</a>
        </p>
    </header>

    <h2>Item aanpassen</h2>

    <form method="post">
        <div>
            <label for="omschrijving">Omschrijving</label>
            <input value="<?php echo $_POST['Omschrijving'] ?? '' ?>" type="text" name="omschrijving" id="omschrijving">
            <?php if(isset($foutmeldingen['Omschrijving'])): ?>
            <span class="error"><?php echo $foutmeldingen['Omschrijving'] ?></span>
            <?php endif ?>
        </div>
        <div>
            <label for="prioriteit">Prioriteit:</label>
            <select name="prioriteit" id="prioriteit">
                <?php for($i=0; $i<5; $i++): ?>
                <option <?php if (isset($_POST['Prioriteit']) && $_POST['Prioriteit'] == $i) {echo 'selected';} ?>
                    value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
        </div>
        <div>
            <label>
                <input <?php if(isset($_POST['Afgewerkt']) && $_POST['Afgewerkt'] == 1) {echo 'checked';} ?> value="1"
                    type="checkbox" name="Afgewerkt" id="Afgewerkt"> Item is afgewerkt
            </label>
        </div>
        <div>
            <input type="submit" value="Aanpassen">
        </div>
    </form>
</body>

</html>