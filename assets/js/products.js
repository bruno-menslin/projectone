function loadProducts() {
    $.ajax({
        method: 'GET',
        url: 'products/load.php',
        dataType: 'json'

    }).done((products) => {
        $('#tbody-products').html('')

        for (i = 0; i < products.length; i++) {
            let description = (products[i].descricao == null) ? '-' : products[i].descricao
            $('#tbody-products').prepend(`

                <tr>
                    <th scope="row">` + products[i].codigo + `</th>
                    <td>` + products[i].nome + `</td>
                    <td>` + products[i].modelo + `</td>
                    <td>` + products[i].valor + `</td>
                    <td>` + description + `</td>
                    <td><button onclick="updateProduct(` + products[i].codigo + `)" class="btn btn-warning" ><img src="../assets/images/editar.png" height="20px" width="20px"></button></td>
                    <td><button onclick="confirmDelete('produto', ` + products[i].codigo + `)" class="btn btn-danger"><img src="../assets/images/excluir.png" height="20px" width="20px"></button></td>
                </tr>

            `)
        }
    })
}

$(document).ready(() => {
    loadProducts()
})

function insertProduct() {
    $('#form-modal-title').html('Cadastrar novo produto')   
    $('#form-modal-form').html(`

        <div class="form-group">
            <label for="input-category">Categoria</label>
            <select id="input-category" class="form-control">
                <option value="" selected>Selecione</option>
            </select>
        </div>
        <div class="form-group">
            <label for="input-model">Modelo</label>
            <input id="input-model" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-value">Valor</label>
            <input id="input-value" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-description">Descrição</label>
            <textarea id="input-description" class="form-control" rows="3"></textarea>
        </div>

    `)
    
    $.ajax({ //popular select de categoria
        method: 'POST',
        url: 'products/load.php',
        data: {code: 'categories'},
        dataType: 'json'

    }).done((categories) => {
        for (i = 0; i < categories.length; i++) {
            $('#input-category').prepend(`
                <option value="` + categories[i].id + `">` + categories[i].nome + `</option>
            `)
        }
    })

    $('#form-modal-submit').html('Cadastrar')
    $('#form-modal').modal('show')
}

function updateProduct(productCode) {
    $('#form-modal-title').html('Atualizar cadastro de produto')   
    $('#form-modal-form').html(`

        <input id="input-code" type="hidden" value="` + productCode + `">
        <div class="form-group">
            <label for="input-category">Categoria</label>
            <select id="input-category" class="form-control">
                <option value="">Selecione</option>
            </select>
        </div>
        <div class="form-group">
            <label for="input-model">Modelo</label>
            <input id="input-model" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-value">Valor</label>
            <input id="input-value" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-description">Descrição</label>
            <textarea id="input-description" class="form-control" rows="3"></textarea>
        </div>

    `)
    
    $.ajax({
        method: 'POST',
        url: 'products/load.php',
        data: {code: productCode},
        dataType: 'json'

    }).done((product) => {

        $.ajax({ //popular select de categoria
            method: 'POST',
            url: 'products/load.php',
            data: {code: 'categories'},
            dataType: 'json'
    
        }).done((categories) => {
            
            let selected = '';
    
            for (i = 0; i < categories.length; i++) {
                selected = (categories[i].id == product.categorias_id) ? 'selected' : '';
                $('#input-category').prepend(`
                    <option value="` + categories[i].id + `" ` + selected + `>` + categories[i].nome + `</option>
                `)
            }
        })

        $('#input-model').val(product.modelo)
        $('#input-value').val(product.valor)
        $('#input-description').val(product.descricao)
    })

    $('#form-modal-submit').html('Atualizar')
    $('#form-modal').modal('show')
}

$('#form-modal-form').submit(() => {

    const code = $('#input-code').val()
    const category_id = $('#input-category').val()
    const model = $('#input-model').val()
    const value = $('#input-value').val()
    const description = $('#input-description').val()

    if (code == undefined) {

        $.ajax({
            method: 'POST',
            url: 'products/ins.php',
            data: {category_id: category_id, model: model, value: value, description: description}

        }).done((result) => {
            $('#form-modal-alert').removeClass()

            if (result == 'Cadastro efetuado com sucesso!') {
                loadProducts()
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
            url: 'products/upd.php',
            data: {code: code, category_id: category_id, model: model, value: value, description: description}
        
        }).done((result) => {
            $('#form-modal-alert').removeClass()

            if (result == 'Alteração efetuada com sucesso!') {
                loadProducts()
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

function deleteProduct(productCode) {
    $.ajax({
        method: 'POST',
        url: 'products/del.php',
        data: {code: productCode}

    }).done((result) => {
        loadProducts()
        showMessagesModal('Atenção!', result)
    })
}