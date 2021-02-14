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

<!-- <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastro de Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                </form>
                <div id="alert" class="alert" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-form-modal" data-dismiss="modal">Fechar</button>
                <button id="btn-submit-form-insuser" type="button" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upd-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Alteração de Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-upduser" name="upduser" action="#">
                    <div class="form-group">
                        <label for="idemail">E-mail</label>
                        <input type="text" class="form-control" id="upd-idemail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="idusuario">Usuário</label>
                        <input type="text" class="form-control" id="upd-idusuario" name="usuario">
                    </div>
                    <div class="form-group">
                        <label for="idsenha">Senha</label>
                        <input type="password" class="form-control" id="upd-idsenha" name="senha">
                    </div>
                </form>
                <div id="upd-alert" class="alert" role="alert"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close-form-modal" data-dismiss="modal">Fechar</button>
                <button id="btn-submit-form-upduser" type="button" class="btn btn-primary">Alterar</button>
            </div>
        </div>
    </div>
</div> -->

<!---->   

<!-- <form id="form-upduser" name="upduser" action="#">
    <div class="form-group">
        <label for="idemail">E-mail</label>
        <input type="text" class="form-control" id="upd-idemail" name="email">
    </div>
    <div class="form-group">
        <label for="idusuario">Usuário</label>
        <input type="text" class="form-control" id="upd-idusuario" name="usuario">
    </div>
    <div class="form-group">
        <label for="idsenha">Senha</label>
        <input type="password" class="form-control" id="upd-idsenha" name="senha">
    </div>
</form> -->