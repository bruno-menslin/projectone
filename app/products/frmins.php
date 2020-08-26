<?php
    include "../../security/authentication/validationapp.php";

    $sql = "SELECT id, nome FROM categorias";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> execute();

    $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Cadastro de Produto</h2>
<form name="insproduct" action="main.php?folder=products/&file=ins.php" method="post">
    <label for="categoria">Categoria</label>
    <select name="categoria_id" id="categoria">
        <option value="">Selecione</option>
        <?php
            foreach ($categories as $category) {
        ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['nome']; ?></option>
        <?php 
            }
        ?>
    </select>
    <label for="modelo">Modelo</label>
    <input type="text" name="modelo" id="modelo">
    <label for="valor">Valor</label>
    <input type="text" name="valor" id="valor">
    <label for="descricao">Descrição</label>
    <textarea name="descricao" id="descricao"></textarea>
    <button type="reset">Limpar</button>
    <button type="submit">Enviar</button>
</form>
<h2>Produtos Cadastrados</h2>
<?php
    $sql = "SELECT codigo, modelo, valor, produtos.descricao, categorias_id, categorias.nome FROM produtos INNER JOIN categorias ON produtos.categorias_id = categorias.id";
    
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> execute();

    $products = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
?>
<table border=1>
    <thead>
        <tr>
            <th>Código</th>
            <th>Categoria</th>
            <th>Modelo</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Alterar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($products as $product) {
                $descricao = ($product['descricao'] == null) ? "-" : $product['descricao'];
        ?>
                <tr>
                    <td><?php echo $product['codigo']; ?></td>
                    <td><?php echo $product['nome']; ?></td>
                    <td><?php echo $product['modelo']; ?></td>
                    <td><?php echo $product['valor']; ?></td>
                    <td><?php echo $descricao; ?></td>
                    <td><a href="main.php?folder=products/&file=frmupd.php&codigo=<?php echo $product['codigo']; ?>">A</a></td>
                    <td><a href="main.php?folder=products/&file=del.php&codigo=<?php echo $product['codigo']; ?>" onclick="return valDel('produto', '<?php echo $product['modelo']; ?>')">X</a></td>
                </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<a href="main.php">Voltar</a> 