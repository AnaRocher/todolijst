<?php

if (empty($_POST['Omschrijving'])) {
    $foutmeldingen['Omschrijving'] = 'Omschrijving is verplicht';
} else if (strlen($_POST['Omschrijving']) > 255) {
    $foutmeldingen['Omschrijving'] = 'Omschrijving mag maximum 255 tekens zijn';
}

?>