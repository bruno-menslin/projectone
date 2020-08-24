<?php    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM usuarios WHERE id = :id";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $result = $stm_sql -> execute();

    $msg = ($result) ? "&mensagem=Usuário excluído com sucesso!" : "&mensagem=Falha ao excluir usuário!";

    header("Location: main.php?folder=users/&file=frmins.php" . $msg);
?>