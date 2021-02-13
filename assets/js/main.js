$(document).ready(() => { //quando o documento for carregado
    loadUsers();
    $("#alert").fadeToggle(0); //começar não ocupando espaço
    
    $('form').submit(function(e) { //remover comportamento padrão dos formulários
        e.preventDefault(); //'e' de evento
    });
});

// PAGE - USERS
$("#btn-add-user").click(() => {
    $("#add-user-modal").modal('show');
});

$('#btn-submit-form-insuser').click(() => { //quando o botão 'cadastrar' for clicado
    
    var email = $('#idemail').val(); //armazenando as entradas do usuário
    var usuario = $('#idusuario').val();
    var senha = $('#idsenha').val();

    $.ajax({
        method: 'POST',
        url: 'users/ins.php',
        data: {email: email, usuario: usuario, senha: senha}
    }).done(function(result) {
        loadUsers();
        $("#alert").removeClass(); //remove todas as classes

        if (result == "Cadastro efetuado com sucesso!") {
            $("#form-insuser").trigger("reset"); //limpa os inputs do formulário
            var status = "success";
        } else {
            var status = "danger";
        }

        $("#alert").addClass("alert alert-" + status).html(result).fadeIn(300); //apresenta o alerta

        setTimeout(() => { //remove o alerta
            $("#alert").fadeOut(300);
        }, 3000);
    });
});

function loadUsers() {
    $.ajax({
        method: 'GET',
        url: 'users/load.php',
        dataType: 'json'
    }).done(function(users) {
        $("#tbody-users").html(""); //limpar a tabela antes de exibir

        for (var i = 0; i < users.length; i++) {
            $("#tbody-users").prepend(`
                <tr>
                    <th scope="row">` + users[i].id + `</th>
                    <td>` + users[i].email + `</td>
                    <td>` + users[i].usuario + `</td>
                    <td>` + users[i].senha + `</td>
                    <td>` + users[i].permissao + `</td>
                    <td>` + users[i].ativo + `</td>
                    <td><button class="btn btn-warning" onclick="updateUser(` + users[i].id + `)"><img src="../assets/images/editar.png" height="20px" width="20px"></button></td>
                    <td><button class="btn btn-danger" onclick="return valDel('usuário', '` + users[i].usuario + `', ` + users[i].id + `)"><img src="../assets/images/excluir.png" height="20px" width="20px"></button></td>
                </tr>
            `);
        }
    });
};

function updateUser(userId) {
    $.ajax({
        method: 'POST',
        url: 'users/load.php',
        data: {id: userId}
    }).done((result) => {
        var user = JSON.parse(result);
        $("#upd-idemail").val(user.email);
        $("#upd-idusuario").val(user.usuario);
    })

    $("#upd-user-modal").modal('show');

    $("#btn-submit-form-upduser").click(() => {

        var email = $('#upd-idemail').val(); //armazenando as entradas do usuário
        var usuario = $('#upd-idusuario').val();
        var senha = $('#upd-idsenha').val();
    
        $.ajax({
            method: 'POST',
            url: 'users/upd.php',
            data: {id: userId, email: email, usuario: usuario, senha: senha}
        }).done(function(result) {
            loadUsers();
            $("#upd-alert").removeClass(); //remove todas as classes
    
            if (result == "Alteração efetuada com sucesso!") {
                $("#form-upduser").trigger("reset"); //limpa os inputs do formulário
                var status = "success";
            } else {
                var status = "danger";
            }
    
            $("#upd-alert").addClass("alert alert-" + status).html(result).fadeIn(300); //apresenta o alerta
    
            setTimeout(() => { //remove o alerta
                $("#upd-alert").fadeOut(300);
            }, 3000);
        });
    })
}

function deleteUser(userId) {
    $.ajax({
        method: 'POST',
        url: 'users/del.php',
        data: {id: userId}
    }).done(function(result) {
        loadUsers();
        showMessagesModal('Atenção!', result)
    });
}
// PAGE - USERS

$(".btn-close-form-modal").click(() => {
    $('form').trigger("reset"); //limpa os inputs do formulário
});

function showMessagesModal(title, message) {
    $("#messages-modal-title").html(title);
    $("#messages-modal-body").html(message);
    $("#messages-modal").modal('show');
}

function showConfirmModal(title, message) {
    $("#confirm-modal-title").html(title);
    $("#confirm-modal-body").html(message);
    $("#confirm-modal").modal('show');
}

function valDel(what, which, id) {
    showConfirmModal('Atenção!', 'Deseja excluir o(a) ' + what + ': ' + which + '?');

    $("#confirm-modal-btn-confirm").click(()=> {
        switch (what) {
            case 'usuário':
                deleteUser(id);
                break;
        }   
    });    
}