<?php
    include "../../security/authentication/validationapp.php";
    
    $id = null;
    $nome = $_POST['nome'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : null;
    
    $link = "main.php?folder=categories/&file=frmins.php";
    $msg = '';
    $status = "danger";

    if ($nome == '') {
        $msg = "Preencha o campo nome.";
    } else {
        $sql = "SELECT * FROM categorias WHERE nome = :nome";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':nome', $nome);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            $sql = "INSERT INTO categorias VALUES (:id, :nome, :descricao)";

            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> bindParam(':nome', $nome);
            $stm_sql -> bindParam(':descricao', $descricao);
            
            $result = $stm_sql -> execute();

            if ($result) {
                $msg = "Cadastro efetuado com sucesso!";
                $status = "success";
            } else {
                $msg = "Falha ao cadastrar!";
            }
        } else {
            $msg = "Esta categoria já está cadastrada no banco de dados.";
            $status = "warning";
        }
    }
    header("Location: " . $link . "&mensagem=" . $msg . "&status=" . $status);
?>