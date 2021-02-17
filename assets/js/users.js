function loadUsers() {
    $.ajax({
        method: 'GET',
        url: 'users/load.php',
        dataType: 'json'

    }).done(function(users) {
        $('#tbody-users').html(''); //limpar a tabela antes de exibir

        for (var i = 0; i < users.length; i++) {
            let permission = (users[i].permissao == 1) ? 'Adm' : 'Comum'
            let active = (users[i].ativo == 0) ? 'Ativo' : 'Inativo'
            $('#tbody-users').prepend(`
                <tr>
                    <th scope="row">` + users[i].id + `</th>
                    <td>` + users[i].email + `</td>
                    <td>` + users[i].usuario + `</td>
                    <td>` + users[i].senha + `</td>
                    <td>` + permission + `</td>
                    <td>` + active + `</td>
                    <td><button onclick="updateUser(` + users[i].id + `)" class="btn btn-warning" ><img src="../assets/images/editar.png" height="20px" width="20px"></button></td>
                    <td><button onclick="confirmDelete('usuário', ` + users[i].id + `)" class="btn btn-danger"><img src="../assets/images/excluir.png" height="20px" width="20px"></button></td>
                </tr>
            `)
        }
    })
}

$(document).ready(() => { //quando o documento for carregado
    loadUsers()
})

function insertUser() {
    $('#form-modal-title').html('Cadastrar novo usuário')
    $('#form-modal-form').html(`

        <div class="form-group">
            <label for="input-email">E-mail</label>
            <input id="input-email" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-username">Usuário</label>
            <input id="input-username" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-password">Senha</label>
            <input id="input-password" type="password" class="form-control">
        </div>

    `)
    $('#form-modal-submit').html('Cadastrar')
    $('#form-modal').modal('show')
}

function updateUser(userId) {
    $('#form-modal-title').html('Atualizar cadastro de usuário');
    $('#form-modal-form').html(`

        <input id="input-id" type="hidden" value="` + userId + `">
        <div class="form-group">
            <label for="input-email">E-mail</label>
            <input id="input-email" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-username">Usuário</label>
            <input id="input-username" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-password">Senha</label>
            <input id="input-password" type="password" class="form-control">
        </div>

    `)
    
    //buscar os dados do usuário, para inserir no form
    $.ajax({
        method: 'POST',
        url: 'users/load.php',
        data: {id: userId},
        dataType: 'json'

    }).done((user) => {
        $('#input-email').val(user.email)
        $('#input-username').val(user.usuario)
    })    

    $('#form-modal-submit').html('Atualizar')
    $('#form-modal').modal('show')
}

$('#form-modal-form').submit(() => { //quando o formulario do modal for enviado

    const id = $('#input-id').val()
    const email = $('#input-email').val()
    const username = $('#input-username').val()
    const password = $('#input-password').val()
    
    if (id == undefined) { //cadastrar usuário
        
        $.ajax({
            method: 'POST',
            url: 'users/ins.php',
            data: {email: email, username: username, password: password}

        }).done(function(result) {
            $('#form-modal-alert').removeClass() //remove todas as classes

            if (result == 'Cadastro efetuado com sucesso!') {
                loadUsers()
                $('#form-modal-form').trigger('reset') //limpa os inputs do formulário
                var status = 'success'
            } else {
                var status = 'danger'
            }
    
            $('#form-modal-alert').addClass('alert alert-' + status).html(result).fadeIn(300) //apresenta o alerta
    
            setTimeout(() => { //remove o alerta
                $('#form-modal-alert').fadeOut(300)
            }, 3000)
        })

    } else { //atualizar usuário
        
        $.ajax({
            method: 'POST',
            url: 'users/upd.php',
            data: {id: id, email: email, username: username, password: password}

        }).done(function(result) {
            $('#form-modal-alert').removeClass()
    
            if (result == 'Atualização efetuada com sucesso!') {
                loadUsers()
                $('#form-modal').modal('hide')
                showMessagesModal('Atenção!', result)
            } else {
                $('#form-modal-alert').addClass('alert alert-danger').html(result).fadeIn(300)
    
                setTimeout(() => { //remove o alerta
                    $('#form-modal-alert').fadeOut(300)
                }, 3000)
            }   
        })
    }
})

function deleteUser(userId) {
    $.ajax({
        method: 'POST',
        url: 'users/del.php',
        data: {id: userId}

    }).done((result) => {
        loadUsers()
        showMessagesModal('Atenção!', result)
    })
}