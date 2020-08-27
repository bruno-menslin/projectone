<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script href="assets/js/bootstrap.js"></script>
    </head>
    <body>        
        <header>
            <nav class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="/docs/4.5/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                    Project One
                </a>
            </nav>
        </header>
        <div class="container-fluid mt-3">        
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form name="auth" action="security/authentication/login.php" method="POST">
                        <div class="form-group">
                            <label for="idusuario">Usuário</label>
                            <input type="text" class="form-control" id="idusuario" name="usuario">
                        </div>
                        <div class="form-group">
                            <label for="idsenha">Senha</label>
                            <input type="password" class="form-control" id="idsenha" name="senha">
                        </div>
                        <button type="submit" class="btn btn-success">Entrar</button>
                    </form>

                    <?php if (isset($_GET['mensagem'])) { ?>
                        <div class="alert alert-danger sm-margin-top" role="alert">
                            <?php echo "! " . $_GET['mensagem']; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>