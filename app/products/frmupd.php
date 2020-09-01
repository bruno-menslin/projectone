<?php
    include "../../security/authentication/validationapp.php";

    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM produtos WHERE codigo = :codigo";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':codigo', $codigo);
    $stm_sql -> execute();
    $product = $stm_sql -> fetch(PDO::FETCH_ASSOC);        
    
    $sql = "SELECT id, nome FROM categorias";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> execute();
    $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-sm-12 col-lg-6">
    <h2>Alteração de Produto</h2>
    <form name="updproduct" action="main.php?folder=products/&file=upd.php" method="POST">
        <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
        <div class="form-group">
            <label for="idcategoria">Categoria</label>
            <select class="form-control" id="idcategoria" name="categoria_id">
                <option value="">Selecione</option>
                <?php
                    foreach ($categories as $category) {
                        $selected = ($category['id'] == $product['categorias_id']) ? "selected" : "";
                ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>><?php echo $category['nome']; ?></option>';
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idmodelo">Modelo</label>
            <input type="text" class="form-control" id="idmodelo" name="modelo" value="<?php echo $product['modelo']; ?>">
        </div>
        <div class="form-group">
            <label for="idvalor">Valor</label>
            <input type="text" class="form-control" id="idvalor" name="valor" value="<?php echo $product['valor']; ?>">
        </div>
        <div class="form-group">
            <label for="iddescricao">Descrição</label>
            <textarea class="form-control" id="iddescricao" rows="3" name="descricao"><?php echo $product['descricao']; ?></textarea>
        </div>
        <button type="reset" class="btn btn-warning">Desfazer</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php?folder=products/&file=frmins.php">Voltar</a>
</div>