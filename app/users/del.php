<?php    
    include "../../security/database/connection.php";
    
    $id = $_POST['id'];
    $msg = '';

    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $result = $stm_sql -> execute();

    if ($result) {
        $msg = "Usuário excluído com sucesso!";
    } else {
        $msg = "Falha ao excluir usuário!";
    }
    echo $msg;
?>