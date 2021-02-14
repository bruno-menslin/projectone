<?php    
    include "../../security/database/connection.php";

    $id = $_POST['id'];
    $email = $_POST['email'];
    $usuario = $_POST['username'];
    $senha = $_POST['password'];

    $msg = '';

    if ($email == '') {
        $msg = "Preencha o campo e-mail.";
    } else if ($usuario == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($senha == '') {
        $msg = "Preencha o campo senha.";
    } else {
        // verificar se o email inserido já existe no banco
        $sql = "SELECT * FROM usuarios WHERE email = :email AND id <> :id";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':email', $email);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            // verificar se o usuário inserido já existe no banco
            $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND id <> :id";

            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':usuario', $usuario);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> execute();

            if ($stm_sql -> rowCount() == 0) {
                // atualizar o cadastro do usuário no banco
                $sql = "UPDATE usuarios SET email = :email, usuario = :usuario, senha = :senha WHERE id = :id";

                $stm_sql = $db_connection -> prepare($sql);
                $stm_sql -> bindParam(':email', $email);
                $stm_sql -> bindParam(':usuario', $usuario);
                $stm_sql -> bindParam(':senha', md5($senha));
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
            $msg = "Este email já está cadastrado no banco de dados.";
        }
    }
    echo $msg;
?>