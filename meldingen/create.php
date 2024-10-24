<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location: ../login.php?msg=je moet nog inloggen");
        exit;
    }
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>
        <form action="../backend/meldingenController.php" method="POST">

            <input type="hidden" name="action" value="create">
        
            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="">- kies een type -</option>
                    <option value="achtbaan">achtbaan</option>
                    <option value="waterattractie">waterattractie</option>
                    <option value="kinderattractie">kinderattractie</option>
                    <option value="draaiend">draaiend</option>
                    <option value="horeca">horeca</option>
                    <option value="show">show</option>
                    <option value="overig">overig</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input">
            </div>
            <div class="form-group">
                <label for="prioriteit">prioriteit:</label>
                <input type="checkbox" name="prioriteit">
                <label for="prioriteit"> ja</label>
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input">
            </div>
            <div class="form-group">
                <label for="overige_info">overige_info</label>
                <textarea name="overige_info" id="" cols="30" rows="10"></textarea>
            </div>
            
            <input type="submit" value="Verstuur melding">

        </form>
    </div>  

</body>

</html>
