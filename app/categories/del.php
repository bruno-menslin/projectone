<?php   
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];
    
    $link = "main.php?folder=categories/&file=frmins.php";
    $msg = '';
    $status = "success";
    
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
    header("Location: " . $link . "&mensagem=" . $msg . "&status=" . $status);
?>