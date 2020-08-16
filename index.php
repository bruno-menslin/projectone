<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
    </head>
    <body>
        <h1>PROJECT ONE</h1>
        <h2>Entrar - Autenticação de Usuário</h2>
        <form name="auth" action="security/authentication/login.php" method="POST">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <button type="submit">Entrar</button>
        </form>
    </body>
</html>