<?php 

$pdo = new PDO('mysql:host=localhost:8889;dbname=todo_applicatie', 'root', 'root');

$foutmeldingen = [];

if ($_POST) {
    if (empty($_POST['Omschrijving'])) {
        $foutmeldingen['Omschrijving'] = "Omschrijving is verplicht";
    } else if (strlen($_POST['Omschrijving']) > 255) {
        $foutmeldingen['Omschrijving'] = "Omschrijving mag maximum 255 tekens zijn";
    }
    if (empty($foutmeldingen)) {
        $query = $pdo->prepare("INSERT INTO todo_items (Omschrijving, Prioriteit) VALUES (:Omschrijving, :Prioriteit");
        $query->execute([
            'Omschrijving' => $_POST['Omschrijving'],
            'Prioriteit' => $_POST['Prioriteit']
        ]);

        header('location: index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item toevoegen</title>
    <link rel="stylesheet" href="todolijst.css">
</head>

<body>

    <header>
        <h1>Todo Items</h1>

        <p>
            <a href="index.php">Todo items</a>
        </p>
    </header>

    <h2>Item toevoegen</h2>

    <form method="post">
        <?php include 'includes/item_form.php' ?>
        <div>
            <label for="Omschrijving">Omschrijving:</label>
            <input value="<?php echo $_POST ['Omschrijving'] ?? '' ?>" type="text" name="Omschrijving"
                id="Omschrijving">
            <?php if(isset($foutmeldingen['Omschrijving'])): ?>
            <span class="error"><?php echo $foutmeldingen['Omschrijving'] ?></span>
            <?php endif ?>
        </div>
        <div>
            <label for="Prioriteit">Prioriteit</label>
            <select name="Prioriteit" id="Prioriteit">
                <?php for($i=0; $i<5; $i++): ?>
                <option <?php if (isset($_POST['Prioriteit']) && $_POST['Prioriteit'] == $i) {
                    echo 'selected';} ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
        </div>
        <div>
            <input type="submit" value="Toevoegen">
        </div>
    </form>

</body>

</html>