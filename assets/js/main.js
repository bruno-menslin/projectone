$(document).ready(() => {
    $('#form-modal-alert').fadeToggle(0) //começar não ocupando espaço
})

$('form').submit(function(e) { //remover comportamento padrão dos formulários
    e.preventDefault(); //'e' de evento
});

// ---- MODALS ----
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

function showFormModal(title, form) {
    $("#form-modal-title").html(title);
    $("#form-modal-form").html(form);

    if (title.includes("Cadastro")) {
        $("#form-modal-submit").html("Cadastrar");
    } else {
        $("#form-modal-submit").html("Alterar");
    }

    $("#form-modal").modal('show');
}

$('#form-modal').on('hidden.bs.modal', () => { //quando o formulario for fechado
    $('form').trigger("reset"); //limpa os inputs do formulário
    $('#form-modal-alert').removeClass()
    $('#form-modal-alert').html('')
})
// ---- MODALS ----

function confirmDelete(what, id) { //antes o nome era 'valDel'
    showConfirmModal('Atenção!', 'Deseja excluir o(a) ' + what + ' com ID ' + id + '?');

    $("#confirm-modal-btn-confirm").click(()=> {
        switch (what) {
            case 'usuário':
                deleteUser(id)
                break
            case 'categoria':
                deleteCategory(id)
                break
        }   
    });    
}