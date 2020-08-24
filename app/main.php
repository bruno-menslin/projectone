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
        <a href="main.php" style="text-decoration: none; color: #000; font-size: 32.5px; font-weight: bold;">PROJECT ONE</a>
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
            ?>
                    <div class="aviso">
                        <h1><?php echo $_GET['mensagem']; ?></h1>
                    </div>
            <?php
                }
            ?>
        </div>
        <!-- /conteudo -->
    </body>
</html>