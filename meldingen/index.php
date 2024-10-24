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
    <title>StoringApp / Meldingen</title>
    <?php require_once '../head.php'; ?>
</head>

<body>

    <?php require_once '../header.php'; ?>
    
    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <?php
            require_once '../backend/conn.php';
            if (empty($_GET['type'])) {
            $query = "SELECT * FROM meldingen";
            $statement = $conn ->prepare($query);
            $statement ->execute();
            }
            else {
                $type = $_GET['type'];
                $query = "SELECT * FROM meldingen WHERE type = :type";
                $statement = $conn ->prepare($query);
                $statement ->execute([
                    ":type" => $type
                ]);
            }
            $meldingen = $statement-> fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="filter">
            <p>Aantal meldingen: <?php echo count($meldingen) ?></p>
            <form action="" method="get">
                <select name="type" id="type">
                    <option value="">- kies een type om te filteren -</option>
                    <option value="achtbaan">achtbaan</option>
                    <option value="waterattractie">waterattractie</option>
                    <option value="kinderattractie">kinderattractie</option>
                    <option value="draaiend">draaiend</option>
                    <option value="horeca">horeca</option>
                    <option value="show">show</option>
                    <option value="overig">overig</option>
                </select>
                <input type="submit" value="filter">
            </form>
        </div>

        <table>
            <tr>
            <th>Attractie</th>
            <th>Type</th>
            <th>Capaciteit</th>
            <th>Prioriteit</th>
            <th>Melder</th>
            <th>Gemeld op</th>
            <th>Overige info</th>
            <th>Aanpassen</th>
        </tr>
        
               <?php foreach($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie'] ?></td>
                    <td><?php echo $melding['type'] ?></td>
                    <td><?php echo $melding['capaciteit'] ?></td>
                    <td><?php if($melding['prioriteit']) {echo "ja";}
                    else echo "nee"?></td>
                    <td><?php echo $melding['melder'] ?></td>
                    <td><?php echo $melding['gemeld_op'] ?></td>
                    <td><?php echo $melding['overige_info'] ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id'];?>">Aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>


    </div>  

</body>

</html>
