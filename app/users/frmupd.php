<?php
    include "../../security/authentication/validationapp.php";
    
    $id = $_GET['id'];

    $sql = "SELECT email, usuario FROM usuarios WHERE id = :id";
    
    $stm_sql = $db_connection -> prepare($sql);
    $stm_sql -> bindParam(':id', $id);
    $stm_sql -> execute();

    $user = $stm_sql -> fetch(PDO::FETCH_ASSOC); // o resultado da busca será apenas um resultado, por isso fetch, não fetchAll
?>
<div class="col-sm-12 col-lg-6">
    <h2>Alteração de Usuário</h2>
    <form name="upduser" action="main.php?folder=users/&file=upd.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="idemail">E-mail</label>
            <input type="text" class="form-control" id="idemail" name="email" value="<?php echo $user['email']; ?>">
        </div>
        <div class="form-group">
            <label for="idusuario">Usuário</label>
            <input type="text" class="form-control" id="idusuario" name="usuario" value="<?php echo $user['usuario']; ?>">
        </div>
        <div class="form-group">
            <label for="idsenha">Senha</label>
            <input type="password" class="form-control" id="idsenha" name="senha">
        </div>
        <button type="reset" class="btn btn-warning">Desfazer</button>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <br>
    <a href="main.php?folder=users/&file=frmins.php">Voltar</a>
</div>