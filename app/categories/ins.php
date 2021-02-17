<?php    
    include "../../security/database/connection.php";
    
    $id = null;
    $name = $_POST['name'];
    $description = ($_POST['description'] != '') ? $_POST['description'] : null;
    
    $msg = '';

    if ($name == '') {
        $msg = "Preencha o campo nome.";
    } else {
        
        $sql = "SELECT * FROM categories WHERE name = :name"; //verificar se o name da categoria ja existe no banco
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':name', $name);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            
            $sql = "INSERT INTO categories VALUES (:id, :name, :description)";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> bindParam(':name', $name);
            $stm_sql -> bindParam(':description', $description);
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