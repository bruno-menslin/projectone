<?php include "../../security/authentication/validation.php";?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
        <script src="../../assets/js/main.js"></script>
    </head>
    <body>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="frmins.php">Usuários</a></li>
            <li><a href="../categories/frmins.php">Categorias</a></li>
            <li><a href="../products/frmins.php">Produtos</a></li>
            <li><a href="../../security/authentication/logout.php">Sair</a></li>
        </ul>
        <h2>Cadastro de Usuário</h2>
        <form action="ins.php" method="post" name="insuser"> <!-- método post -->
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <button type="reset">Limpar</button>
            <button type="submit">Enviar</button>
        </form>
        <h2>Usuários Cadastrados</h2>
        <?php
            include "../../security/database/connection.php";

            $stm_sql = $db_connection -> prepare("SELECT * FROM usuarios"); // transforma a sintaxe em intrução e armazena na variável $stm_sql
            $stm_sql -> execute(); // executa a instrução

            $users = $stm_sql -> fetchAll(PDO::FETCH_ASSOC); // busca todo o retorno da execução, de maneira nominal, e armazena na variável users
        ?>
        <table border=1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>E-mail</th>
                    <th>Permissão</th>
                    <th>Ativo</th>
                    <th>Alterar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $user) { // para cada usuário ($user) de usuários ($users)

                        if ($user['permissao'] == 0) {
                            $permissao = 'Adm';
                        } else if ($user['permissao'] == 1) {
                            $permissao = 'Comum';
                        } else {
                            $permissao = 'Erro';
                        }

                        $ativo = ($user['ativo'] == 0) ? "Sim" : "Não";
                ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['usuario']; ?></td>
                            <td><?php echo $user['senha']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $permissao; ?></td>
                            <td><?php echo $ativo; ?></td>
                            <td><a href="frmupd.php?id=<?php echo $user['id'];?>">A</a></td>
                            <td><a href="del.php?id=<?php echo $user['id'];?>" onclick="return valDel('usuário', '<?php echo $user['usuario']; ?>')">X</a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <a href="../main.php">Voltar</a>
    </body>
</html>