<?php    
    include "../../security/database/connection.php";
    
    $codigo = $_POST['code'];
    $msg = '';

    $sql = "DELETE FROM produtos WHERE codigo = :codigo";
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':codigo', $codigo);
    $result = $stm_sql -> execute();

    if ($result) {
        $msg = "Produto excluído com sucesso!";
    } else {
        $msg = "Falha ao excluir o produto!";
    }
    echo $msg;
?>