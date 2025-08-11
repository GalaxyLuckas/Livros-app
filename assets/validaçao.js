function validarCampoTexto(input) {
    // Permite apenas letras, números, espaços e alguns caracteres comuns
    input.value = input.value.replace(/[^a-zA-Z0-9áàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ\s.,-]/g, '');
}

function validarISBN(input) {
    // Permite números e hífen para ISBN
    input.value = input.value.replace(/[^0-9-]/g, '');
}
