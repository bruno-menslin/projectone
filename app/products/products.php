<?php include "../../security/authentication/validationapp.php"; ?>

<div class="col-sm-12 col-lg-12">
    <div class="d-flex justify-content-between">
        <a href="main.php" class="btn btn-secondary">Voltar</a>
        <button onclick="insertProduct()" class="btn btn-primary">Cadastrar novo produto</button>
    </div>
    <br>    
    <h2>Produtos Cadastrados</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbody-products"></tbody>
        </table>
    </div>
</div>