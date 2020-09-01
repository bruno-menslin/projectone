<?php
    include "../../security/authentication/validationapp.php";

    $sql = "SELECT id, nome FROM categorias";

    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> execute();

    $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-sm-12 col-lg-6">
    <h2>Cadastro de Produtos</h2>
    <form name="insproduct" action="main.php?folder=products/&file=ins.php" method="POST">
        <div class="form-group">
            <label for="idcategoria">Categoria</label>
            <select class="form-control" id="idcategoria" name="categoria_id">
                <option value="">Selecione</option>
                <?php
                    foreach ($categories as $category) {
                ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['nome']; ?></option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idmodelo">Modelo</label>
            <input type="text" class="form-control" id="idmodelo" name="modelo">
        </div>
        <div class="form-group">
            <label for="idvalor">Valor</label>
            <input type="text" class="form-control" id="idvalor" name="valor">
        </div>
        <div class="form-group">
            <label for="iddescricao">Descrição</label>
            <textarea class="form-control" id="iddescricao" rows="3" name="descricao"></textarea>
        </div>
        <button type="reset" class="btn btn-warning">Limpar</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php">Voltar</a>
</div>
<div class="col-sm-12 col-lg-6">
    <h2>Produtos Cadastrados</h2>
    <?php
        $sql = "SELECT codigo, modelo, valor, produtos.descricao, categorias_id, categorias.nome FROM produtos INNER JOIN categorias ON produtos.categorias_id = categorias.id";
        
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();

        $products = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($products as $product) {
                        $description = ($product['descricao'] == null) ? "-" : $product['descricao'];
                ?>
                        <tr>
                            <th scope="row"><?php echo $product['codigo']; ?></td>
                            <td><?php echo $product['nome']; ?></td>
                            <td><?php echo $product['modelo']; ?></td>
                            <td><?php echo $product['valor']; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><a href="main.php?folder=products/&file=frmupd.php&codigo=<?php echo $product['codigo']; ?>"><img src="../assets/images/editar.png" height="20px" width="20px"></a></td>
                            <td><a href="main.php?folder=products/&file=del.php&codigo=<?php echo $product['codigo']; ?>" onclick="return valDel('produto', '<?php echo $product['modelo']; ?>')"><img src="../assets/images/excluir.png" height="20px" width="20px"></a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>