<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <script href="assets/js/bootstrap.js"></script>
    </head>
    <body>
        <h1>PROJECT ONE</h1>
        <h2>Entrar</h2>
        <form name="auth" action="security/authentication/login.php" method="POST">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <button type="submit">Entrar</button>
        </form>
        <?php if (isset($_GET['mensagem'])) { ?>
            <div>
                <?php echo "! " . $_GET['mensagem']; ?>
            </div>
        <?php } ?>
    </body>
</html>