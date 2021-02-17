<?php   
    include "../../security/database/connection.php";
    
    $id = $_POST['id'];
    $msg = '';

    $sql = "SELECT model FROM products WHERE categories_id = :id";
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $stm_sql -> execute();

    if ($stm_sql -> rowCount() == 0) {
        
        $sql = "DELETE FROM categories WHERE id = :id";
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':id', $id);
        $result = $stm_sql -> execute();

        if ($result) {
            $msg = "Categoria excluída com sucesso!";
        } else {
            $msg = "Falha ao excluir categoria!";
        }
    } else {
        $msg = "Existem produtos vinculados à esta categoria.";
    }
    echo $msg;
?>