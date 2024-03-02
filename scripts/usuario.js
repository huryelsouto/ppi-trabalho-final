function mostrarConteudo(conteudo) {
    var conteudoDiv = document.getElementById('conteudo');
    conteudoDiv.innerHTML = "Conteúdo da página " + conteudo;
}

function toggleMenu() {
    var menu = document.getElementById('menu');
    menu.classList.toggle('expandido');
}