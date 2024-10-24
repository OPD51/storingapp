<?php
    session_start();


    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'conn.php';

    $query = "SELECT * FROM users WHERE username = :username";

    $statement = $conn->prepare($query);

    $statement ->execute([
        ":username" => $username
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if($statement -> rowCount() < 1)
    {
        // $msg = "je bent in ieder geval geen meercellig organisme";
    // header("location: ../login.php?msg=$msg" );
    header("location: ../login.php?msg=Error: je bent in ieder geval geen meercellig organisme");
    die;
    }

    if(!password_verify($password, $user['password']))
    {
    header("location: ../login.php?msg=Error: wachtwoord is kut en niet based");

    die;
    }

    $_SESSION['user_id'] = $user['id'];

    header("location: ../meldingen/index.php?msg=welkom $username");
    
?>