<?php include "../../security/authentication/validation.php";?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Bruno Menslin">
        <title>Project One</title>
    </head>
    <body>
        <?php
            include "../../security/database/connection.php";

            $id = $_GET['id'];

            $sql = "SELECT email, usuario FROM usuarios WHERE id = :id";
            
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> execute();

            $user = $stm_sql -> fetch(PDO::FETCH_ASSOC); // o resultado da busca será apenas um resultado, por isso fetch, não fetchAll
        ?>
        <h1>PROJECT ONE</h1>
        <ul>
            <li><a href="frmins.php">Usuários</a></li>
            <li><a href="../categories/frmins.php">Categorias</a></li>
            <li><a href="../products/frmins.php">Produtos</a></li>
            <li><a href="../../security/authentication/logout.php">Sair</a></li>
        </ul>
        <h2>Alteração de Usuário</h2>
        <form action="upd.php" method="post" name="upduser">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo $user['usuario']; ?>">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha">
            <button type="reset">Desfazer</button>
            <button type="submit">Enviar</button>
        </form>
        <a href="frmins.php">Voltar</a>
    </body>
</html>