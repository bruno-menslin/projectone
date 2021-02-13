$(document).ready(() => { //quando o documento for carregado
    loadUsers();

    $("#alert").fadeToggle(0); //começar não ocupando espaço
    
    $('form').submit(function(e) { //remover comportamento padrão dos formulários
        e.preventDefault(); //'e' de evento
    });
});

$('#form-insuser').submit(() => { //quando o botão 'enviar' for clicado
    
    var email = $('#idemail').val(); //armazenando as entradas do usuário
    var usuario = $('#idusuario').val();
    var senha = $('#idsenha').val();

    $.ajax({
        method: 'POST',
        url: 'users/ins.php',
        data: {email: email, usuario: usuario, senha: senha}
    }).done(function(result) {
        loadUsers();

        if (result == "Cadastro efetuado com sucesso!") {
            $('form').trigger("reset"); //limpa os inputs do formulário
            var status = "success";
        } else {
            var status = "danger";
        }

        $("#alert").addClass("alert-" + status).html(result).fadeIn(700); //apresenta o alerta

        setTimeout(() => { //remove o alerta
            $("#alert").fadeOut(700);
        }, 3000);

        setTimeout(() => { //remove a classe do alerta
            $("#alert").removeClass("alert-" + status);
        }, 3600);
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
                    <td><a href="main.php?folder=users/&file=frmupd.php&id=` + users[i].id + `"><img src="../assets/images/editar.png" height="20px" width="20px"></a></td>
                    <td><button onclick="return valDel('usuário', '` + users[i].usuario + `', ` + users[i].id + `)"><img src="../assets/images/excluir.png" height="20px" width="20px"></button></td>
                </tr>
            `);
        }
    });
};

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