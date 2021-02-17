<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    $msg = '';

    if ($username == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($password == '') {
        $msg = "Preencha o campo senha.";
    } else {
        include "../database/connection.php";

        $sql = "SELECT username, password FROM users WHERE username = :username AND password = :password";
        
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':username', $username);
        $stm_sql -> bindParam(':password', md5($password));
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 1) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = md5($password);
            $_SESSION['id'] = session_id();

            $msg = "app/main.php";
        } else {
            $msg = "Usuário ou senha incorretos.";
        }
    }
    echo $msg;
?>