<div>
    <label for="Omschrijving">Omschrijving:</label>
    <input value="<?php echo $_POST['Omschrijving'] ?? '' ?> " type="text" name="Omschrijving" id="Omschrijving">
    <?php if(isset($foutmeldingen['Omschrijving'])): ?>
    <span class="error"><?php echo $foutmeldingen['Omschrijving'] ?></span>
    <?php endif ?>
</div>
<div>
    <label for="Prioriteit">Prioriteit:</label>
    <select name="Prioriteit" id="Prioriteit">
        <?php for($i=0; $i<5; $i++): ?>
        <option <?php if ($_POST['Prioriteit'] == $i) {echo 'selected';} ?> value="<?php echo $i ?>"><?php echo $i ?>
        </option>
        <?php endfor ?>
    </select>
</div>