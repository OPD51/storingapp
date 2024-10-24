<?php

    session_start();
    if (isset($_SESSION['user_id'])) {
        header("location: ../index.php?msg=Je Moeder Is Een Hoer");
        exit;
    }

    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        header("location: ../register.php?msg=Je Moeder Is Een jigaloo");
        exit;
    }

    $password = $_POST['password'];
    $password_check = $_POST['password_check'];
    if ($password !== $password_check) {
        header("location: ../register.php?msg=Je Moeder Is Een wachtwoord");
        exit;
    }

    require_once 'conn.php';

    $query = "SELECT * FROM users WHERE username = :email";

    $statement = $conn->prepare($query);

    $statement ->execute([
        ":email" => $email
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($statement->rowcount() >0) {
        header("location: ../login.php?msg=je bestaat al wat jammer");
        exit;
    }
    if (empty($password)) {
         header("location: ../register.php?msg=wachtwoord mag niet leeg zijn");
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users(username, password) VALUES (:email, :hash)";
        //3. Prepare
    $statement = $conn ->prepare($query);

    //4. Execute
    $statement ->execute([
        ":email" => $email,
        ":hash"  => $hash
    ]);
    header("location: ../login.php?msg=geren geren");
?>