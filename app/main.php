<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One - Menu</title>
    </head>
    <body>
        <?php
            include "../security/authentication/validation.php"; //sessao já é inicializada no validation.php
            echo "Bem vindo " . $_SESSION['usuario'];
            echo " - " . $_SESSION['idsessao'];
        ?>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="users/frmins.php">Usuários</a></li>
            <li><a href="categories/frmins.php">Categorias</a></li>
            <li><a href="products/frmins.php">Produtos</a></li>
            <li><a href="../security/authentication/logout.php">Sair</a></li>
        </ul>
    </body>
</html>