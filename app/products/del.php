<?php    
    $codigo = $_GET['codigo'];

    $sql = "DELETE FROM produtos WHERE codigo = :codigo";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':codigo', $codigo);
    $result = $stm_sql -> execute();

    $msg = ($result) ? "Produto excluído com sucesso!" : "Falha ao excluir o produto!"; 

    header("Location: main.php?folder=products/&file=frmins.php&mensagem=" . $msg);
?>