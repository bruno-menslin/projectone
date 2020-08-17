<?php
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $senha_criptografada = md5($senha);

    $msg = '';

    if ($usuario == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($senha == '') {
        $msg = "Preencha o campo senha.";
    } else {
        include "../database/connection.php";

        $sql = "SELECT usuario, senha FROM usuarios WHERE usuario = :usuario AND senha = :senha";
        
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':usuario', $usuario);
        $stm_sql -> bindParam(':senha', $senha_criptografada);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 1) {
            // header("Location: ../../app/main.php");
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha_criptografada; // todas as senhas em texto claro para criptografada
            $_SESSION['idsessao'] = session_id();

            header("Location: ../../app/main.php");
        } else {
            $msg = "Usuário ou senha incorretos.";
        }
    }
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="../../index.php">Voltar</a>