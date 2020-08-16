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
            <li><a href="frmins.php">Categorias</a></li>
            <li><a href="../products/frmins.php">Produtos</a></li>
            <li><a href="../../security/authentication/logout.php">Sair</a></li>
        </ul>
        <h2>Cadastro de Categoria</h2>
        <form action="ins.php" method="post" name="inscategory">
            <label for="nome">Nome</label>            
            <input type="text" name="nome" id="nome">
            <label for="descricao">Descrição</label>            
            <input type="text" name="descricao" id="descricao">
            <button type="reset">Limpar</button>
            <button type="submit">Enviar</button>
        </form>
        <h2>Categorias Cadastradas</h2>
        <table border=1>
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                <?php
                    include "../../security/database/connection.php";
                    
                    $sql = "SELECT id, nome, descricao FROM categorias";

                    $stm_sql = $db_connection -> prepare($sql);
                    $stm_sql -> execute();

                    $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);

                    foreach ($categories as $category) {
                        $descricao = ($category['descricao'] == null) ? "-" : $category['descricao'];
                ?>
                        <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td><?php echo $category['nome']; ?></td>
                            <td><?php echo $descricao; ?></td>
                            <td><a href="frmupd.php?id=<?php echo $category['id']; ?>">A</a></td>
                            <td><a href="del.php?id=<?php echo $category['id']; ?>" onclick="return valDel('categoria', '<?php echo $categorie['nome']; ?>')">X</a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <a href="../main.php">Voltar</a>
    </body>
</html>