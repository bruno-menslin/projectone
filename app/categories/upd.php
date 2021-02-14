<?php    
    include "../../security/database/connection.php";
    
    $id = $_POST['id'];
    $nome = $_POST['name'];
    $descricao = ($_POST['description'] != '') ? $_POST['description'] : null;

    $msg = '';

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
            
            if ($result) {
                $msg = "Alteração efetuada com sucesso!";
            } else {
                $msg = "Falha ao alterar!";
            }
        } else {
            $msg = "Esta categoria já está cadastrada no banco de dados.";
        }
    }
    echo $msg;
?>