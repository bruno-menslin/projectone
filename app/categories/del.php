<?php   
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];
    
    $link = "main.php?folder=categories/&file=frmins.php";
    $msg = '';
    $status = "success";

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
            $status = "danger";
        }
    } else {
        $msg = "Existem produtos vinculados à esta categoria.";
        $status = "warning";
    }
    header("Location: " . $link . "&mensagem=" . $msg . "&status=" . $status);
?>