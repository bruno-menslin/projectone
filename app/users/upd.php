<?php    
    include "../../security/database/connection.php";

    $id = $_POST['id'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $msg = '';

    if ($email == '') {
        $msg = "Preencha o campo e-mail.";
    } else if ($username == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($password == '') {
        $msg = "Preencha o campo senha.";
    } else {
        // verificar se o email inserido já existe no banco
        $sql = "SELECT * FROM users WHERE email = :email AND id <> :id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':email', $email);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            // verificar se o usuário inserido já existe no banco
            $sql = "SELECT * FROM users WHERE username = :username AND id <> :id";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':username', $username);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> execute();

            if ($stm_sql -> rowCount() == 0) {
                // atualizar o cadastro do usuário no banco
                $sql = "UPDATE users SET email = :email, username = :username, password = :password WHERE id = :id";
                $stm_sql = $db_connection -> prepare($sql);
                $stm_sql -> bindParam(':email', $email);
                $stm_sql -> bindParam(':username', $username);
                $stm_sql -> bindParam(':password', md5($password));
                $stm_sql -> bindParam(':id', $id);
                $result = $stm_sql -> execute();

                if ($result) {
                    $msg = "Atualização efetuada com sucesso!";
                } else {
                    $msg = "Falha ao atualizar!";
                }
            } else {
                $msg = "Este usuário já está cadastrado no banco de dados.";
            }
        } else {
            $msg = "Este e-mail já está cadastrado no banco de dados.";
        }
    }
    echo $msg;
?>