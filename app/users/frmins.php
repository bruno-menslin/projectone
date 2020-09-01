<?php include "../../security/authentication/validationapp.php"; ?>
<div class="col-sm-12 col-lg-6">
    <h2>Cadastro de Usuário</h2>
    <form name="insuser" action="main.php?folder=users/&file=ins.php" method="POST">
        <div class="form-group">
            <label for="idemail">E-mail</label>
            <input type="text" class="form-control" id="idemail" name="email">
        </div>
        <div class="form-group">
            <label for="idusuario">Usuário</label>
            <input type="text" class="form-control" id="idusuario" name="usuario">
        </div>
        <div class="form-group">
            <label for="idsenha">Senha</label>
            <input type="password" class="form-control" id="idsenha" name="senha">
        </div>
        <button type="reset" class="btn btn-warning">Limpar</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php">Voltar</a>
</div>
<div class="col-sm-12 col-lg-6">
    <h2>Usuários Cadastrados</h2>
    <?php
        $sql = "SELECT * FROM usuarios"; // sintaxe sql

        $stm_sql = $db_connection -> prepare($sql); // transforma a sintaxe em intrução e armazena na variável $stm_sql

        $stm_sql -> execute(); // executa a instrução

        $users = $stm_sql -> fetchAll(PDO::FETCH_ASSOC); // busca todo o retorno da execução, de maneira nominal, e armazena na variável users
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Senha</th>
                    <th scope="col">Permissão</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $user) { // para cada usuário ($user) de usuários ($users)
                        
                        if ($user['permissao'] == 0) {
                            $permission = 'Adm';
                        } else if ($user['permissao'] == 1) {
                            $permission = 'Comum';
                        } else {
                            $permission = 'Erro';
                        }

                        $active = ($user['ativo'] == 0) ? "Sim" : "Não";
                ?>
                        <tr>
                            <th scope="row"><?php echo $user['id']; ?></th>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['usuario']; ?></td>
                            <td><?php echo $user['senha']; ?></td>
                            <td><?php echo $permission; ?></td>
                            <td><?php echo $active; ?></td>
                            <td><a href="main.php?folder=users/&file=frmupd.php&id=<?php echo $user['id'];?>"><img src="../assets/images/editar.png" height="20px" width="20px"></a></td>
                            <td><a href="main.php?folder=users/&file=del.php&id=<?php echo $user['id'];?>" onclick="return valDel('usuário', '<?php echo $user['usuario']; ?>')"><img src="../assets/images/excluir.png" height="20px" width="20px"></a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>