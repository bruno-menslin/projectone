<?php    
    $id = $_POST['id'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $senha_criptografada = md5($senha);

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
                $stm_sql -> bindParam(':senha', $senha_criptografada);
                $stm_sql -> bindParam(':id', $id);
                
                $result = $stm_sql -> execute();

                $msg = ($result) ? "Alteração efetuada com sucesso!" : "Falha ao alterar!";
            } else {
                $msg = "Este usuário já está cadastrado no banco de dados.";
            }
        } else {
            $msg = "Este email já está cadastrado no banco de dados.";
        }
    }
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="main.php?folder=users/&file=frmins.php">Voltar</a>