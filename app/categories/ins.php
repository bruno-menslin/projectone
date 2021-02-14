<?php    
    include "../../security/database/connection.php";
    
    $id = null;
    $nome = $_POST['name'];
    $descricao = ($_POST['description'] != '') ? $_POST['description'] : null;
    
    $msg = '';

    if ($nome == '') {
        $msg = "Preencha o campo nome.";
    } else {
        
        $sql = "SELECT * FROM categorias WHERE nome = :nome"; //verificar se o nome da categoria ja existe no banco
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
            } else {
                $msg = "Falha ao cadastrar!";
            }
        } else {
            $msg = "Esta categoria já está cadastrada no banco de dados.";
        }
    }
    echo $msg;
?>