<?php
    include "../security/authentication/validation.php"; //sessao já é inicializada no validation.php
    include "../security/database/connection.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Bruno Menslin">
        <title>Project One - Menu</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/main.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script href="../assets/js/bootstrap.js"></script>
        <script src="../assets/js/main.js"></script>
    </head>
    <body>
        <header>            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="main.php">Project One</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php?folder=users/&file=frmins.php">Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="main.php?folder=categories/&file=frmins.php">Categorias<!--<span class="sr-only">(Página atual)</span>--></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="main.php?folder=products/&file=frmins.php">Produtos</a>
                        </li>                        
                    </ul>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../security/authentication/logout.php">Sair</a>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <?php
                        if (isset($_GET['mensagem']) && isset($_GET['status'])) {
                    ?>
                            <div class="alert alert-<?php echo $_GET['status']; ?>" role="alert">
                                <?php echo $_GET['mensagem']; ?>
                            </div>
                    <?php
                        }
                    ?>
                </div>                
            </div>

            <div class="row">
                <?php
                    if (isset($_GET['folder']) && isset($_GET['file'])) {
                        if (@!include $_GET['folder'] . $_GET['file']) { // '@' suprime erros
                            // echo "404 NOT FOUND";
                            include "404.php";
                        }
                    } else {
                        echo "Bem vindo " . $_SESSION['usuario'] . " - " . $_SESSION['idsessao'];
                    }
                ?>                    
            </div>            
        </div>
    </body>
</html>