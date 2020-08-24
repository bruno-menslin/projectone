<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One - Menu</title>
        <script src="../assets/js/main.js"></script>
    </head>
    <body>
        <?php
            include "../security/authentication/validation.php"; //sessao já é inicializada no validation.php
            include "../security/database/connection.php";
        ?>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="main.php?folder=users/&file=frmins.php">Usuários</a></li>
            <li><a href="main.php?folder=categories/&file=frmins.php">Categorias</a></li>
            <li><a href="main.php?folder=products/&file=frmins.php">Produtos</a></li>
            <li><a href="../security/authentication/logout.php">Sair</a></li>
        </ul>
        <!-- conteudo -->
        <div>
            <?php
                if (isset($_GET['folder']) && isset($_GET['file'])) {
                    if (@!include $_GET['folder'] . $_GET['file']) { // '@' suprime erros
                        // echo "404 NOT FOUND";
                        include "404.php";
                    }
                } else {
                    echo "Bem vindo " . $_SESSION['usuario'] . " - " . $_SESSION['idsessao'];
                }
                if (isset($_GET['mensagem'])) {
                    echo "<br>" . $_GET['mensagem'];
                }
            ?>
        </div>
        <!-- /conteudo -->
    </body>
</html>