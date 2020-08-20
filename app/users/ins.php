<?php
    // receber os valores
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $senha_criptografada = md5($senha);

    $msg = '';

    // validar os campos
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
                
                $id = null; // bindParam só aceita variáveis
                $permissao = 0;
                $ativo = 0;

                $stm_sql -> bindParam(':id', $id);
                $stm_sql -> bindParam(':usuario', $usuario);
                $stm_sql -> bindParam(':senha', $senha_criptografada);
                $stm_sql -> bindParam(':email', $email);
                $stm_sql -> bindParam(':permissao', $permissao);
                $stm_sql -> bindParam(':ativo', $ativo);

                $result = $stm_sql -> execute(); // executar a instrução e armazenar o resultado (true | false), na variável $result

                $msg = ($result) ? "Cadastro efetuado com sucesso!" : "Falha ao cadastrar!"; // verificar se a intrução foi executada com sucesso
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