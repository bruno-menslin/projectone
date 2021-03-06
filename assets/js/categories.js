function loadCategories() {
    $.ajax({
        method: 'GET',
        url: 'categories/load.php',
        dataType: 'json'

    }).done((categories) => {
        $('#tbody-categories').html('');

        for (i = 0; i < categories.length; i++) {
            let description = (categories[i].description == null) ? '-' : categories[i].description
            $('#tbody-categories').prepend(`
                <tr>
                    <th scope="row">` + categories[i].id + `</th>
                    <td>` + categories[i].name + `</td>
                    <td>` + description + `</td>
                    <td><button onclick="updateCategory(` + categories[i].id + `)" class="btn btn-warning" ><img src="../assets/images/editar.png" height="20px" width="20px"></button></td>
                    <td><button onclick="confirmDelete('categoria', ` + categories[i].id + `)" class="btn btn-danger"><img src="../assets/images/excluir.png" height="20px" width="20px"></button></td>
                </tr>
            `)
        }
    })
}

$(document).ready(() => {
    loadCategories()
})

function insertCategory() {
    $('#form-modal-title').html('Cadastrar nova categoria')
    $('#form-modal-form').html(`

        <div class="form-group">
            <label for="input-name">Nome</label>
            <input id="input-name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-description">Descrição</label>
            <input id="input-description" type="text" class="form-control">
        </div>

    `)
    $('#form-modal-submit').html('Cadastrar')
    $('#form-modal').modal('show')
}

function updateCategory(categoryId) {
    $('#form-modal-title').html('Atualizar cadastro de categoria')
    $('#form-modal-form').html(`

        <input id="input-id" type="hidden" value="` + categoryId + `">
        <div class="form-group">
            <label for="input-name">Nome</label>
            <input id="input-name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-description">Descrição</label>
            <input id="input-description" type="text" class="form-control">
        </div>

    `)

    $.ajax({
        method: 'POST',
        url: 'categories/load.php',
        data: {id: categoryId},
        dataType: 'json'

    }).done((category) => {
        $('#input-name').val(category.name)
        $('#input-description').val(category.description)
    })

    $('#form-modal-submit').html('Atualizar')
    $('#form-modal').modal('show')
}

$('#form-modal-form').submit(() => {
    
    const id = $('#input-id').val()
    const name = $('#input-name').val()
    const description = $('#input-description').val()

    if (id == undefined) {

        $.ajax({
            method: 'POST',
            url: 'categories/ins.php',
            data: {name: name, description: description}

        }).done((result) => {
            $('#form-modal-alert').removeClass()

            if (result == 'Cadastro efetuado com sucesso!') {
                loadCategories()
                $('#form-modal-form').trigger('reset')
                var status = 'success'
            } else {
                var status = 'danger'
            }

            $('#form-modal-alert').addClass('alert alert-' + status).html(result).fadeIn(300)

            setTimeout(() => {
                $('#form-modal-alert').fadeOut(300)
            }, 3000)
        })
    } else {

        $.ajax({
            method: 'POST',
            url: 'categories/upd.php',
            data: {id: id, name: name, description: description}

        }).done((result) => {
            $('#form-modal-alert').removeClass()

            if (result == 'Alteração efetuada com sucesso!') {
                loadCategories()
                $('#form-modal-form').trigger('reset')
                $('#form-modal').modal('hide')
                showMessagesModal('Atenção!', result)
            } else {
                $('#form-modal-alert').addClass('alert alert-danger').html(result).fadeIn(300)

                setTimeout(() => {
                    $('#form-modal-alert').fadeOut(300)
                }, 3000)
            }
        })
    }
})

function deleteCategory(categoryId) {
    $.ajax({
        method: 'POST',
        url: 'categories/del.php',
        data: {id: categoryId}

    }).done((result) => {
        loadCategories();
        showMessagesModal('Atenção!', result)
    })
}