<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("location: ../login.php?msg=je moet nog inloggen");
        exit;
    }
?>
<?php

if($_POST['action'] == 'create'){


    //Variabelen vullen
    $attractie = $_POST['attractie'];
    if(empty($attractie)){
        $errors[] = "vul de attractie-naam in";
    }
    $type = $_POST['type'];
    if(empty($type)){
        $errors[] = "vul de type in";
    }
    $capaciteit = $_POST['capaciteit']; 
    if(!is_numeric($capaciteit)){
        $errors[] = "vul voor capaciteit een geldig getal in";
    }
    if(isset($_POST['prioriteit'])){
        $prioriteit = 1;
    }
    else{
        $prioriteit = 0;
    }

    $melder = $_POST['melder'];
    if(empty($melder)){
        $errors[] = "vul je naam in";
    }
    $overige_info = $_POST['overige_info'];

    if(isset($errors)){
        var_dump($errors);
        die();
        }
    



    //1. Verbinding
    require_once 'conn.php';

    //2. Query
    $query = "INSERT INTO meldingen(attractie, type, capaciteit, prioriteit, melder, overige_info) VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)"; 

    //3. Prepare
    $statement = $conn ->prepare($query);

    //4. Execute
    $statement ->execute([
        ":attractie"    => $attractie,
        ":type"         => $type,
        ":capaciteit"   => $capaciteit,
        ":prioriteit"   => $prioriteit,
        ":melder"       => $melder,
        ":overige_info" => $overige_info
    ]);
    $msg = "melding verzonden";
    header("location: ../meldingen/index.php?msg=$msg" );
}

if ($_POST['action'] == 'update'){


     $id = $_POST['id'];
    $capaciteit = $_POST['capaciteit']; 
    if(!is_numeric($capaciteit)){
        $errors[] = "vul voor capaciteit een geldig getal in";
    }
    if(isset($_POST['prioriteit'])){
        $prioriteit = 1;
    }
    else{
        $prioriteit = 0;
    }

    $melder = $_POST['melder'];
    if(empty($melder)){
        $errors[] = "vul je naam in";
    }
    $overige_info = $_POST['overige_info'];



    require_once 'conn.php';

    $query = "UPDATE meldingen SET capaciteit = :capaciteit, prioriteit = :prioriteit, melder = :melder, overige_info = :overige_info WHERE id = :id";

    $statement = $conn -> prepare($query);

    $statement ->execute([
        ":capaciteit"   => $capaciteit,
        ":prioriteit"   => $prioriteit,
        ":melder"       => $melder,
        ":overige_info" => $overige_info,
        ":id"           => $id
    ]);
    $msg = "melding opgeslagen";
    header("location: ../meldingen/index.php?msg=$msg" );
}

if($_POST['action'] == 'delete')
{
     $id = $_POST['id'];

    require_once 'conn.php';

    $query = "DELETE FROM meldingen WHERE id = :id";

    $statement = $conn -> prepare($query);

    $statement ->execute([
        ":id"           => $id
    ]);
    $msg = "melding verwijdert";
    header("location: ../meldingen/index.php?msg=$msg" );
}


?>