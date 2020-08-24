<?php    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM categorias WHERE id = :id";
    
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $result = $stm_sql -> execute();

    $msg = ($result) ? "Categoria excluída com sucesso!" : "Falha ao excluir categoria!";

    header("Location: main.php?folder=categories/&file=frmins.php&mensagem=" . $msg);
?>