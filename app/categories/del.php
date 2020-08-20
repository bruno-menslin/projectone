<?php    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM categorias WHERE id = :id";
    
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $result = $stm_sql -> execute();

    $msg = ($result) ? "Categoria excluída com sucesso!" : "Falha ao excluir categoria!";
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="main.php?folder=categories/&file=frmins.php">Voltar</a>