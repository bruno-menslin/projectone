<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
    </head>
    <body>
        <h1>PROJECT ONE</h1>
        <h2>Cadastro de Usuário</h2>
        <form action="ins.php" method="post" name="insuser"> <!-- método post -->
            <label for="email">E-Mail</label>
            <input type="text" name="email" id="email">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <button type="reset">Limpar</button>
            <button type="submit">Enviar</button>
        </form>
        <h2>Usuários Cadastrados</h2>
        <table border=1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>E-mail</th>
                    <th>Permissão</th>
                    <th>Ativo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "../../security/database/connection.php";
                    
                    $sql = "SELECT * FROM usuarios";
                    $stm_sql = $db_connection -> prepare($sql);
                    $stm_sql -> execute();

                    while ($data = $stm_sql -> fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['usuario']; ?></td>
                    <td><?php echo $data['senha']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['permissao']; ?></td>
                    <td><?php echo $data['ativo']; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>