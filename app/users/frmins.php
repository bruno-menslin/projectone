<?php include "../../security/authentication/validationapp.php"; ?>
<div class="col-sm-12 col-lg-6">
    <h2>Cadastro de Usuário</h2>
    <form id="form-insuser" name="insuser" action="#">
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
        <button type="reset" class="btn btn-secondary">Limpar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <div id="alert" class="alert" role="alert"></div>
    <br>
    <a href="main.php">Voltar</a>
</div>
<div class="col-sm-12 col-lg-6">
    <h2>Usuários Cadastrados</h2>
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
            <tbody id="tbody-users">
            </tbody>
        </table>
    </div>
</div>