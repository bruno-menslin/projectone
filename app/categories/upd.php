<?php    
    include "../../security/database/connection.php";
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = ($_POST['description'] != '') ? $_POST['description'] : null;

    $msg = '';

    if ($name == '') {
        $msg = "Preencha o campo nome.";
    } else {
        
        $sql = "SELECT * FROM categories WHERE name = :name AND id <> :id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':name', $name);
        $stm_sql -> bindParam(':id', $id);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            
            $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':name', $name);
            $stm_sql -> bindParam(':description', $description);
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