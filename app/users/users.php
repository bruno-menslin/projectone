<?php include "../../security/authentication/validationapp.php"; ?>

<div class="col-sm-12 col-lg-12">
    <div class="d-flex justify-content-between">
        <a href="main.php" class="btn btn-secondary">Voltar</a>
        <button onclick="insertUser()" class="btn btn-primary">Cadastrar novo usuário</button>
    </div>
    <br>    
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