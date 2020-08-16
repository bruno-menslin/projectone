<?php include "../../security/authentication/validation.php";?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
    </head>
    <body>
        <?php
            include "../../security/database/connection.php";
            $id = $_GET['id'];
            $sql = "SELECT nome, descricao FROM categorias WHERE id = :id";
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> execute();
            $category = $stm_sql -> fetch(PDO::FETCH_ASSOC);
        ?>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="../users/frmins.php">Usuários</a></li>
            <li><a href="frmins.php">Categorias</a></li>
            <li><a href="../products/frmins.php">Produtos</a></li>
            <li><a href="../../security/authentication/logout.php">Sair</a></li>
        </ul>
        <h2>Alteração de Categoria</h2>
        <form action="upd.php" method="post" name="updcategory">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <label for="nome">Nome</label>            
            <input type="text" name="nome" id="nome" value="<?php echo $category['nome']; ?>">
            <label for="descricao">Descrição</label>            
            <input type="text" name="descricao" id="descricao" value="<?php echo $category['descricao']; ?>">
            <button type="reset">Limpar</button>
            <button type="submit">Enviar</button>
        </form>
        <a href="frmins.php">Voltar</a>
    </body>
</html>