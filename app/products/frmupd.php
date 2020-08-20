<h2>Alteração de Produto</h2>
<?php
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
<form name="updproduct" action="main.php?folder=products/&file=upd.php" method="post">
    <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
    <label for="categoria">Categoria</label>
    <select name="categoria_id" id="categoria">
        <option value="">Selecione</option>
        <?php
            foreach ($categories as $category) {
                $selecionado = ($category['id'] == $product['categorias_id']) ? "selected" : "";
        ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $selecionado; ?>><?php echo $category['nome']; ?></option>';
        <?php
            }
        ?>
    </select>
    <label for="modelo">Modelo</label>
    <input type="text" name="modelo" id="modelo" value="<?php echo $product['modelo']; ?>">
    <label for="valor">Valor</label>
    <input type="text" name="valor" id="valor" value="<?php echo $product['valor']; ?>">
    <label for="descricao">Descrição</label>
    <textarea name="descricao" id="descricao"><?php echo $product['descricao']; ?></textarea>
    <button type="reset">Desfazer</button>
    <button type="submit">Enviar</button>
</form>
<a href="main.php?folder=products/&file=frmins.php">Voltar</a>