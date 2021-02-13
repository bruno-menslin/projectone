<?php
    include "../../security/database/connection.php";
    include "../../security/authentication/validation.php";
    
    $id = null; // bindParam só aceita variáveis
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $permissao = 0;
    $ativo = 0;

    $msg = '';

    if ($email == '') {
        $msg = "Preencha o campo e-mail.";
    } else if ($usuario == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($senha == '') {
        $msg = "Preencha o campo senha.";
    } else {
        // verificar se o email inserido já existe no banco
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':email', $email);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            // verificar se o usuário inserido já existe no banco
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario"; // variável que armazena a sintaxe sql (apenas uma string). Usar parâmetro para evitar sql injection

            $stm_sql = $db_connection -> prepare($sql); // transformar a sintaxe (string) em instrução, para atribuir valor ao parâmetro com bindParam

            $stm_sql -> bindParam(':usuario', $usuario); // atribuir valor ao parâmetro :usuario da intrução

            $stm_sql -> execute(); // executar a instrução 

            if ($stm_sql -> rowCount() == 0) {  // rowCount() retorna a quantidade de linhas encontradas na pesquisa

                // cadastrar usuário no banco
                $sql = "INSERT INTO usuarios VALUES (:id, :usuario, :senha, :email, :permissao, :ativo)"; // variável que armazena a sintaxe sql (apenas uma string). Usar parâmetros para evitar sql injection

                $stm_sql = $db_connection -> prepare($sql); // transformar a sintaxe (string) em instrução, para atribuir valores aos parâmetros com bindParam

                $stm_sql -> bindParam(':id', $id);
                $stm_sql -> bindParam(':usuario', $usuario);
                $stm_sql -> bindParam(':senha', md5($senha));
                $stm_sql -> bindParam(':email', $email);
                $stm_sql -> bindParam(':permissao', $permissao);
                $stm_sql -> bindParam(':ativo', $ativo);

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