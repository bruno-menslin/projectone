<?php
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];

    $sql = "SELECT nome, descricao FROM categorias WHERE id = :id";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $stm_sql -> execute();

    $category = $stm_sql -> fetch(PDO::FETCH_ASSOC);
?>
<div class="col-sm-12 col-lg-6">
    <h2>Alteração de Categoria</h2>
    <form name="updcategory" action="main.php?folder=categories/&file=upd.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label for="idnome">Nome</label>
            <input type="text" class="form-control" id="idnome" name="nome" value="<?php echo $category['nome']; ?>">
        </div>
        <div class="form-group">
            <label for="iddescricao">Descrição</label>
            <input type="text" class="form-control" id="iddescricao" name="descricao" value="<?php echo $category['descricao']; ?>">
        </div>
        <button type="reset" class="btn btn-warning">Desfazer</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php?folder=categories/&file=frmins.php">Voltar</a>
</div>

