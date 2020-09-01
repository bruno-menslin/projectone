<?php    
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];
    
    $link = "main.php?folder=users/&file=frmins.php";
    $msg = '';
    $status = "success";

    $sql = "DELETE FROM usuarios WHERE id = :id";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $result = $stm_sql -> execute();

    if ($result) {
        $msg = "Usuário excluído com sucesso!";
    } else {
        $msg = "Falha ao excluir usuário!";
        $status = "danger";
    }
    header("Location: " . $link . "&mensagem=" . $msg . "&status=" . $status);
?>