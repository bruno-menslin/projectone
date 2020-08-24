<?php    
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : null;

    $msg = '';
    $link = "main.php?folder=categories/&file=frmupd.php&id=" . $id;

    if ($nome == '') {
        $msg = "Preencha o campo nome.";
    } else {

        $sql = "SELECT * FROM categorias WHERE nome = :nome AND id <> :id";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':nome', $nome);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            $sql = "UPDATE categorias SET nome = :nome, descricao = :descricao WHERE id = :id";

            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':nome', $nome);
            $stm_sql -> bindParam(':descricao', $descricao);
            $stm_sql -> bindParam(':id', $id);

            $result = $stm_sql -> execute();
            
            $msg = ($result) ? "Alteração efetuada com sucesso!" : "Falha ao alterar!";

            $link = "main.php?folder=categories/&file=frmins.php";
        } else {
            $msg = "Esta categoria já está cadastrada no banco de dados.";
        }
    }
    header("Location: " . $link . "&mensagem=" . $msg);
?>