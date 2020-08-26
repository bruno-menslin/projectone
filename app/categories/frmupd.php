<?php
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];

    $sql = "SELECT nome, descricao FROM categorias WHERE id = :id";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $stm_sql -> execute();

    $category = $stm_sql -> fetch(PDO::FETCH_ASSOC);
?>
<h2>Alteração de Categoria</h2>
<form action="main.php?folder=categories/&file=upd.php" method="post" name="updcategory">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <label for="nome">Nome</label>            
    <input type="text" name="nome" id="nome" value="<?php echo $category['nome']; ?>">
    <label for="descricao">Descrição</label>            
    <input type="text" name="descricao" id="descricao" value="<?php echo $category['descricao']; ?>">
    <button type="reset">Desfazer</button>
    <button type="submit">Enviar</button>
</form>
<a href="main.php?folder=categories/&file=frmins.php">Voltar</a>
