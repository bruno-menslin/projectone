<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    </head>
    <body class="d-flex align-items-center min-vh-100">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="div-form-title col-sm-12 col-lg-4 col-xl-3 d-flex justify-content-center">
                    <h1 class="form-title d-flex align-items-center">PROJECT ONE</h1>
                </div>
                <div class="col-sm-8 col-md-6 col-lg-3 col-xl-2">
                    <form id="form-login" action="#">
                        <div class="form-group">
                            <label for="input-username">Usuário</label>
                            <input id="input-username" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="input-password">Senha</label>
                            <input id="input-password"type="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-login" form="form-login">Entrar</button>
                    </form>
                </div>
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

        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/index.js"></script>
    </body>
</html>