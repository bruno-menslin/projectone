<?php include "../../security/authentication/validationapp.php"; ?>

<div class="col-sm-12 col-lg-12">
    <div class="d-flex justify-content-between">
        <a href="main.php" class="btn btn-secondary">Voltar</a>
        <button onclick="insertCategory()" class="btn btn-primary">Cadastrar nova categoria</button>
    </div>
    <br>    
    <h2>Categorias Cadastradas</h2>
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
            <tbody id="tbody-categories"></tbody>
        </table>
    </div>
</div>
