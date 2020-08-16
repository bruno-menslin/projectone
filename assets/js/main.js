function valDel (oque, qual) {
    resp = confirm("Deseja excluir o(a) " + oque + ": " + qual)
    return resp // true (ok) | false (cancelar)
}