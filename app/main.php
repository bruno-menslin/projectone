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
        <title>PROJECT ONE</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/main.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a id="navbar-logo" class="navbar-brand" href="main.php">PROJECT ONE</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php?folder=users/&file=users.php">Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="main.php?folder=categories/&file=categories.php">Categorias<!--<span class="sr-only">(Página atual)</span>--></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="main.php?folder=products/&file=frmins.php">Produtos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../security/authentication/logout.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="container-fluid mt-3">
            <div class="row">
                <?php
                    if (isset($_GET['folder']) && isset($_GET['file'])) {
                        if (@!include $_GET['folder'] . $_GET['file']) { // '@' suprime erros
                            include "404.php";
                        }
                    } else {
                ?>
                        <div class="col-md-12 mt-3">
                            <h1>Bem vindo <?php echo $_SESSION['usuario']; ?>!</h1>
                            <h6><?php echo $_SESSION['idsessao']; ?></h6>
                        </div>
                <?php
                    }
                ?>                
            </div>            
        </div>

        <div class="modal fade" id="messages-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messages-modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="messages-modal-body" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirm-modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="confirm-modal-body" class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button id="confirm-modal-btn-confirm" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="form-modal-title" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-modal-form" action="#"></form>
                        <div id="form-modal-alert" class="alert" role="alert"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="form-modal-close" class="btn btn-secondary btn-close-form-modal" type="button" data-dismiss="modal">Fechar</button>
                        <button id="form-modal-submit" class="btn btn-primary" type="submit" form="form-modal-form"></button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../assets/js/bootstrap.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/<?php echo str_replace("/", "", $_GET['folder']); ?>.js"></script>
    </body>
</html>