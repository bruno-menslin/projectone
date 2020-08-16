<?php include "../../security/authentication/validation.php";?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
        <script src="../../assets/js/main.js"></script>
    </head>
    <body>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="../users/frmins.php">Usuários</a></li>
            <li><a href="../categories/frmins.php">Categorias</a></li>
            <li><a href="frmins.php">Produtos</a></li>
            <li><a href="../../security/authentication/logout.php">Sair</a></li>
        </ul>
        <h2>Cadastro de Produto</h2>
        <?php
            include '../../security/database/connection.php';
            $sql = "SELECT id, nome FROM categorias";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> execute();
            $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
        ?>
        <form name="insproduct" action="ins.php" method="post">
            <label for="categoria">Categoria</label>
            <select name="categoria_id" id="categoria">
                <option value="">Selecione uma Categoria</option>
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
                    <th>ID Categoria</th>
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
                            <td><?php echo $product['categorias_id']; ?></td>
                            <td><a href="frmupd.php?codigo=<?php echo $product['codigo']; ?>">A</a></td>
                            <td><a href="del.php?codigo=<?php echo $product['codigo']; ?>" onclick="return valDel('produto', '<?php echo $product['modelo']; ?>')">X</a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <a href="../main.php">Voltar</a> 
    </body>
</html>