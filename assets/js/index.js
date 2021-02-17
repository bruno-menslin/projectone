$('#form-login').submit(() => {

    const username = $('#input-username').val()
    const password = $('#input-password').val()

    $.ajax({
        method: 'POST',
        url: 'security/authentication/login.php',
        data: {username: username, password: password}

    }).done(function(result) {
        if (result.includes('/')) {
            window.location.href = result
        } else {
            showMessagesModal('Atenção!', result)
        }
    })
})