<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'head.php'; ?>
</head>

<body>

    <?php require_once 'header.php'; ?>
    
    <div class="container home">

            <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <h2>registreer je voor het aanmelden</h2>
        <form action="backend/registerController.php" method="POST">

            <div class="form-group">
                <label for="username">username</label>
                <input type="text" name="username">
            </div>

            <div class="form-group">
                <label for="password">password</label>
                <input type="password" name="password">
            </div>
             <div class="form-group">
                <label for="password">password check</label>
                <input type="password" name="password_check">
            </div>
            <input type="submit" value="sign in">

        </form>

    </div>

</body>

</html>


