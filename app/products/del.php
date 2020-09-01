<?php    
    include "../../security/authentication/validationapp.php";
    
    $codigo = $_GET['codigo'];

    $link = "main.php?folder=products/&file=frmins.php";
    $msg = '';
    $status = "success";

    $sql = "DELETE FROM produtos WHERE codigo = :codigo";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':codigo', $codigo);
    $result = $stm_sql -> execute();

    if ($result) {
        $msg = "Produto excluído com sucesso!";
    } else {
        $msg = "Falha ao excluir o produto!";
        $status = "danger";
    }
    header("Location: " . $link . "&mensagem=" . $msg . "&status=" . $status);
?>