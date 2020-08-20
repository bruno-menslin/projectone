<?php    
    $codigo = $_GET['codigo'];

    $sql = "DELETE FROM produtos WHERE codigo = :codigo";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':codigo', $codigo);
    $result = $stm_sql -> execute();

    $msg = ($result) ? "Produto excluído com sucesso!" : "Falha ao excluir o produto!"; 
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="main.php?folder=products/&file=frmins.php">Voltar</a>