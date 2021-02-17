<?php    
    include "../../security/database/connection.php";
    
    $code = $_POST['code'];
    $msg = '';

    $sql = "DELETE FROM products WHERE code = :code";
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':code', $code);
    $result = $stm_sql -> execute();

    if ($result) {
        $msg = "Produto excluído com sucesso!";
    } else {
        $msg = "Falha ao excluir o produto!";
    }
    echo $msg;
?>