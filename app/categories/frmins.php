<?php include "../../security/authentication/validationapp.php"; ?>
<div class="col-6">
    <h2>Cadastro de Categorias</h2>   
    <form name="inscategory" action="main.php?folder=categories/&file=ins.php" method="POST">
        <div class="form-group">
            <label for="idnome">Nome</label>
            <input type="text" class="form-control" id="idnome" name="nome">
        </div>
        <div class="form-group">
            <label for="iddescricao">Descrição</label>
            <input type="text" class="form-control" id="iddescricao" name="descricao">
        </div>
        <button type="reset" class="btn btn-warning">Limpar</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php">Voltar</a>
</div>
<div class="col-6">
    <h2>Categorias Cadastradas</h2>
    <?php
        $sql = "SELECT id, nome, descricao FROM categorias";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> execute();

        $categories = $stm_sql -> fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($categories as $category) {
                        $description = ($category['descricao'] == null) ? "-" : $category['descricao'];
                ?>
                        <tr>
                            <th scope="row"><?php echo $category['id']; ?></th>
                            <td><?php echo $category['nome']; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><a href="main.php?folder=categories/&file=frmupd.php&id=<?php echo $category['id']; ?>"><img src="../assets/images/editar.png" height="20px" width="20px"></img></a></td>
                            <td><a href="main.php?folder=categories/&file=del.php&id=<?php echo $category['id']; ?>" onclick="return valDel('categoria', '<?php echo $category['nome']; ?>')"><img src="../assets/images/excluir.png" height="20px" width="20px"></a></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
