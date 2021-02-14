<?php   
    include "../../security/database/connection.php";
    
    $id = $_POST['id'];
    $msg = '';

    $sql = "SELECT modelo FROM produtos WHERE categorias_id = :id";
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $stm_sql -> execute();

    if ($stm_sql -> rowCount() == 0) {
        
        $sql = "DELETE FROM categorias WHERE id = :id";
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