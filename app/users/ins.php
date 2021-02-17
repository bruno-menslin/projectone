<?php
    include "../../security/database/connection.php";
    
    $id = null; // bindParam só aceita variáveis
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $permission = 0;
    $active = 0;

    $msg = '';

    if ($email == '') {
        $msg = "Preencha o campo e-mail.";
    } else if ($username == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($password == '') {
        $msg = "Preencha o campo senha.";
    } else {
        // verificar se o email inserido já existe no banco
        $sql = "SELECT * FROM users WHERE email = :email";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':email', $email);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            // verificar se o usuário inserido já existe no banco
            $sql = "SELECT * FROM users WHERE username = :username"; // variável que armazena a sintaxe sql (apenas uma string). Usar parâmetro para evitar sql injection

            $stm_sql = $db_connection -> prepare($sql); // transformar a sintaxe (string) em instrução, para atribuir valor ao parâmetro com bindParam

            $stm_sql -> bindParam(':username', $username); // atribuir valor ao parâmetro :username da intrução

            $stm_sql -> execute(); // executar a instrução 

            if ($stm_sql -> rowCount() == 0) {  // rowCount() retorna a quantidade de linhas encontradas na pesquisa

                // cadastrar usuário no banco
                $sql = "INSERT INTO users VALUES (:id, :username, :password, :email, :permission, :active)"; // variável que armazena a sintaxe sql (apenas uma string). Usar parâmetros para evitar sql injection

                $stm_sql = $db_connection -> prepare($sql); // transformar a sintaxe (string) em instrução, para atribuir valores aos parâmetros com bindParam

                $stm_sql -> bindParam(':id', $id);
                $stm_sql -> bindParam(':username', $username);
                $stm_sql -> bindParam(':password', md5($password));
                $stm_sql -> bindParam(':email', $email);
                $stm_sql -> bindParam(':permission', $permission);
                $stm_sql -> bindParam(':active', $active);

                $result = $stm_sql -> execute(); // executar a instrução e armazenar o resultado (true | false), na variável $result

                if ($result) {  // verificar se a intrução foi executada com sucesso
                    $msg = "Cadastro efetuado com sucesso!";
                } else {
                    $msg = "Falha ao cadastrar!";
                }
            } else {
                $msg = "Este usuário já está cadastrado no banco de dados.";
            }
        } else {
            $msg = "Este email já está cadastrado no banco de dados.";
        }
    }
    echo $msg;
?>